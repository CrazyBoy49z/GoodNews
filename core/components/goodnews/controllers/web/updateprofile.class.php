<?php
/**
 * GoodNews
 *
 * Copyright 2012 by bitego <office@bitego.com>
 * Based on code from Login add-on
 * Copyright 2010 by Shaun McCormick <shaun@modx.com>
 * Modified by bitego - 10/2013
 *
 * GoodNews is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * GoodNews is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * this software; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 */

/**
 * Class which handles updating the subscription profile of a user.
 *
 * @package goodnews
 * @subpackage controllers
 */

class GoodNewsSubscriptionUpdateProfileController extends GoodNewsSubscriptionController {

    /**
     * Load default properties for this controller.
     *
     * @return void
     */
    public function initialize() {
        $this->modx->lexicon->load('goodnews:frontend');
        $this->setDefaultProperties(array(
            'errTpl'                => '<span class="error">[[+error]]</span>',
            'useExtended'           => false,
            'excludeExtended'       => '',
            'emailField'            => 'email',
            'preHooks'              => '',
            'postHooks'             => '',
            'sendUnauthorizedPage'  => false,
            'reloadOnSuccess'       => true,
            'submitVar'             => 'goodnews-updateprofile-btn',
            'successKey'            => 'updsuccess',
            'successMsg'            => $this->modx->lexicon('goodnews.profile_updated'),
            'validate'              => '',
            'grpFieldsetTpl'        => 'sample.GoodNewsGrpFieldsetTpl',
            'grpFieldTpl'           => 'sample.GoodNewsGrpFieldTpl',
            'grpNameTpl'            => 'sample.GoodNewsGrpNameTpl',
            'grpFieldHiddenTpl'     => 'sample.GoodNewsGrpFieldHiddenTpl',
            'catFieldTpl'           => 'sample.GoodNewsCatFieldTpl',
            'catFieldHiddenTpl'     => 'sample.GoodNewsCatFieldHiddenTpl',
            'groupsOnly'            => false,
            'includeGroups'         => '',
            'defaultGroups'         => '',
            'defaultCategories'     => '',
            'sort'                  => 'name',
            'dir'                   => 'ASC',
            'grpCatPlaceholder'     => 'grpcatfieldsets',
            'placeholderPrefix'     => '',
        ));
    }

    /**
     * Handle the GoodNewsUpdateProfile snippet business logic.
     *
     * @return string
     */
    public function process() {
        $placeholderPrefix = $this->getProperty('placeholderPrefix', '');
        $reloadOnSuccess   = $this->getProperty('reloadOnSuccess', true, 'isset');
        $successKey        = $this->getProperty('successKey', 'updsuccess');
        $groupsOnly        = $this->getProperty('groupsOnly', false, 'isset');
        
        // Verifies a subscriber by its sid and loads user + profile + meta
        if (!$this->verifyAuthentication()) {
            // this is only executed if sendUnauthorizedPage property is set to false
            $this->modx->setPlaceholder($placeholderPrefix.'authorization_failed', true);
            return '';
        } else {
            $this->modx->setPlaceholder($placeholderPrefix.'sid', $this->sid);
            $this->modx->setPlaceholder($placeholderPrefix.'authorization_success', true);
        }

        $this->setFieldPlaceholders();

        $memberGroups = $this->collectGoodNewsGroupMembers($this->user->get('id'));
        $memberCategories = $this->collectGoodNewsCategoryMembers($this->user->get('id'));
        $this->generateGrpCatFields($memberGroups, $memberCategories);

        $this->checkForSuccessMessage();
                
        if ($this->hasPost()) {
            
            $this->loadDictionary();
            
            // Synchronize categories with groups
            // (A category cant be selected without its parent group!)
            if (!$groupsOnly) { $this->selectParentGroupsByCategories(); }
            
            if ($this->validate()) {

                if ($this->runPreHooks()) {
                
                    // Update the profile
                    $result = $this->runProcessor('UpdateProfile');
                    if ($result !== true) {
                        $this->modx->setPlaceholder($placeholderPrefix.'error.message', $result);
                    } elseif ($reloadOnSuccess) {
                        $url = $this->modx->makeUrl($this->modx->resource->get('id'), '', array(
                            $successKey => 1,
                            'sid' => $this->sid,
                        ), 'full');
                        $this->modx->sendRedirect($url);
                    } else {
                        $this->modx->setPlaceholder($placeholderPrefix.'update_success', true);
                    }
                }
            }
        }
        return '';
    }

    /**
     * Read the subscribers data from db an set as placeholders.
     *
     * @return void
     */
    public function setFieldPlaceholders() {
        $placeholderPrefix = $this->getProperty('placeholderPrefix', '');
        $useExtended       = $this->getProperty('useExtended', false, 'isset');
        
        $placeholders = $this->profile->toArray();
        // Add extended fields to placeholders
        if ($useExtended) {
            $extended = $this->profile->get('extended');
            if (!empty($extended) && is_array($extended)) {
                $placeholders = array_merge($extended, $placeholders);
            }
        }
        $this->modx->toPlaceholders($placeholders, $placeholderPrefix);
    }

    /**
     * Look for a success message by the previous reload.
     *
     * @return void
     */
    public function checkForSuccessMessage() {
        $placeholderPrefix = $this->getProperty('placeholderPrefix', '');
        $successKey        = $this->getProperty('successKey', 'updsuccess');
        
        if (!empty($_REQUEST[$successKey])) {
            $this->modx->setPlaceholder($placeholderPrefix.'update_success', true);
        }
    }

    /**
     * Validate the form submission.
     * 
     * @return boolean
     */
    public function validate() {
        $placeholderPrefix = $this->getProperty('placeholderPrefix', '');
        $validate          = $this->getProperty('validate', '');
        
        $validated = false;
        
        $this->loadValidator();
        
        $fields = $this->validator->validateFields($this->dictionary, $validate);
        
        foreach ($fields as $k => $v) {
            $fields[$k] = str_replace(array('[',']'), array('&#91;','&#93;'), $v);
        }
        $this->dictionary->reset();
        $this->dictionary->fromArray($fields);

        $this->removeSubmitVar();
        $this->preventDuplicateEmails();

        if ($this->validator->hasErrors()) {
            $this->modx->toPlaceholders($this->validator->getErrors(), $placeholderPrefix.'error');
            $this->modx->toPlaceholders($this->dictionary->toArray(), $placeholderPrefix);
        } else {
            $validated = true;
        }
        return $validated;
    }

    /**
     * Remove the submitVar from the field list.
     * @return void
     */
    public function removeSubmitVar() {
        $submitVar = $this->getProperty('submitVar');
        if (!empty($submitVar)) {
            $this->dictionary->remove($submitVar);
        }
    }

    /**
     * Prevent duplicate emails.
     * MODx allow_multiple_emails setting is ignored -> we never let subscribe an email address more then once!
     *
     * @return void
     */
    public function preventDuplicateEmails() {
        $emailField = $this->getProperty('emailField', 'email');
        
        $email = $this->dictionary->get($emailField);
        if (!empty($email)) {
            $emailTaken = $this->modx->getObject('modUserProfile', array(
                'email' => $email,
                'internalKey:!=' => $this->user->get('id'),
            ));
            if ($emailTaken) {
                $this->validator->addError($emailField, $this->modx->lexicon('goodnews.validator_email_taken', array('email' => $email)));
            }
        }
    }

    /**
     * Run any preHooks for this snippet, that allow it to stop the form as submitted.
     * @return boolean
     */
    public function runPreHooks() {
        $placeholderPrefix    = $this->getProperty('placeholderPrefix', '');
        $submitVar            = $this->getProperty('submitVar', 'goodnews-updateprofile-btn');
        $preHooks             = $this->getProperty('preHooks', '');
        $sendUnauthorizedPage = $this->getProperty('sendUnauthorizedPage', true, 'isset');
        $reloadOnSuccess      = $this->getProperty('reloadOnSuccess', true, 'isset');
        
        $validated = true;
        if (!empty($preHooks)) {
            $this->loadHooks('preHooks');
            $this->preHooks->loadMultiple($preHooks, $this->dictionary->toArray(), array(
                'submitVar' => $submitVar,
                'sendUnauthorizedPage' => $sendUnauthorizedPage,
                'reloadOnSuccess' => $reloadOnSuccess,
            ));
            $values = $this->preHooks->getValues();
            if (!empty($values)) {
                $this->dictionary->fromArray($values);
            }

            if ($this->preHooks->hasErrors()) {
                $errors = array();
                $es = $this->preHooks->getErrors();
                $errTpl = $this->getProperty('errTpl');
                foreach ($es as $key => $error) {
                    $errors[$key] = str_replace('[[+error]]', $error, $errTpl);
                }
                $this->modx->toPlaceholders($errors, $placeholderPrefix.'error');

                $errorMsg = $this->preHooks->getErrorMessage();
                $this->modx->toPlaceholder('message', $errorMsg, $placeholderPrefix.'error');
                $validated = false;
            }
        }
        return $validated;
    }
}
return 'GoodNewsSubscriptionUpdateProfileController';