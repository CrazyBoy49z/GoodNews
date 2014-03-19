<?php
/**
 * GoodNews
 *
 * Copyright 2012 by bitego <office@bitego.com>
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
 * Properties for the GoodNewsSubscription snippet.
 *
 * @package goodnews
 * @subpackage build
 */

$properties = array(
    array(
        'name'    => 'activation',
        'desc'    => 'prop_goodnewssubscription.activation_desc',
        'type'    => 'combo-boolean',
        'options' => '',
        'value'   => true,
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'activationttl',
        'desc'    => 'prop_goodnewssubscription.activationttl_desc',
        'type'    => 'textfield',
        'options' => '',
        'value'   => 180,
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'activationEmail',
        'desc'    => 'prop_goodnewssubscription.activationemail_desc',
        'type'    => 'textfield',
        'options' => '',
        'value'   => '',
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'activationEmailSubject',
        'desc'    => 'prop_goodnewssubscription.activationemailsubject_desc',
        'type'    => 'textfield',
        'options' => '',
        'value'   => '',
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'activationEmailTpl',
        'desc'    => 'prop_goodnewssubscription.activationemailtpl_desc',
        'type'    => 'textfield',
        'options' => '',
        'value'   => 'sample.GoodNewsActivationEmailTpl',
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'activationEmailTplAlt',
        'desc'    => 'prop_goodnewssubscription.activationemailtplalt_desc',
        'type'    => 'textfield',
        'options' => '',
        'value'   => '',
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'activationEmailTplType',
        'desc'    => 'prop_goodnewssubscription.activationemailtpltype_desc',
        'type'    => 'list',
        'options' => array(
            array('name' => 'opt_goodnews.chunk','value'    => 'modChunk'),
            array('name' => 'opt_goodnews.file','value'     => 'file'),
            array('name' => 'opt_goodnews.inline','value'   => 'inline'),
            array('name' => 'opt_goodnews.embedded','value' => 'embedded'),
        ),
        'value'   => 'modChunk',
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'activationResourceId',
        'desc'    => 'prop_goodnewssubscription.activationresourceid_desc',
        'type'    => 'textfield',
        'options' => '',
        'value'   => '',
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'submittedResourceId',
        'desc'    => 'prop_goodnewssubscription.submittedresourceid_desc',
        'type'    => 'textfield',
        'options' => '',
        'value'   => '',
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'sendSubscriptionEmail',
        'desc'    => 'prop_goodnewssubscription.sendsubscriptionemail_desc',
        'type'    => 'combo-boolean',
        'options' => '',
        'value'   => false,
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'subscriptionEmailSubject',
        'desc'    => 'prop_goodnewssubscription.subscriptionemailsubject_desc',
        'type'    => 'textfield',
        'options' => '',
        'value'   => '',
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'subscriptionEmailTpl',
        'desc'    => 'prop_goodnewssubscription.subscriptionemailtpl_desc',
        'type'    => 'textfield',
        'options' => '',
        'value'   => 'sample.GoodNewsSubscriptionEmailTpl',
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'subscriptionEmailTplAlt',
        'desc'    => 'prop_goodnewssubscription.subscriptionemailtplalt_desc',
        'type'    => 'textfield',
        'options' => '',
        'value'   => '',
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'subscriptionEmailTplType',
        'desc'    => 'prop_goodnewssubscription.subscriptionemailtpltype_desc',
        'type'    => 'list',
        'options' => array(
            array('name' => 'opt_goodnews.chunk','value'    => 'modChunk'),
            array('name' => 'opt_goodnews.file','value'     => 'file'),
            array('name' => 'opt_goodnews.inline','value'   => 'inline'),
            array('name' => 'opt_goodnews.embedded','value' => 'embedded'),
        ),
        'value'   => 'modChunk',
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'errTpl',
        'desc'    => 'prop_goodnewssubscription.errtpl_desc',
        'type'    => 'textfield',
        'options' => '',
        'value'   => '<span class="error">[[+error]]</span>',
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'useExtended',
        'desc'    => 'prop_goodnewssubscription.useextended_desc',
        'type'    => 'combo-boolean',
        'options' => '',
        'value'   => false,
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'excludeExtended',
        'desc'    => 'prop_goodnewssubscription.excludeextended_desc',
        'type'    => 'textfield',
        'options' => '',
        'value'   => '',
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'emailField',
        'desc'    => 'prop_goodnewssubscription.emailfield_desc',
        'type'    => 'textfield',
        'options' => '',
        'value'   => 'email',
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'persistParams',
        'desc'    => 'prop_goodnewssubscription.persistparams_desc',
        'type'    => 'textfield',
        'options' => '',
        'value'   => '',
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'preHooks',
        'desc'    => 'prop_goodnewssubscription.prehooks_desc',
        'type'    => 'textfield',
        'options' => '',
        'value'   => '',
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'postHooks',
        'desc'    => 'prop_goodnewssubscription.posthooks_desc',
        'type'    => 'textfield',
        'options' => '',
        'value'   => '',
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'redirectBack',
        'desc'    => 'prop_goodnewssubscription.redirectback_desc',
        'type'    => 'textfield',
        'options' => '',
        'value'   => '',
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'redirectBackParams',
        'desc'    => 'prop_goodnewssubscription.redirectbackparams_desc',
        'type'    => 'textfield',
        'options' => '',
        'value'   => '',
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'submitVar',
        'desc'    => 'prop_goodnewssubscription.submitvar_desc',
        'type'    => 'textfield',
        'options' => '',
        'value'   => 'goodnews-subscription-btn',
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'successMsg',
        'desc'    => 'prop_goodnewssubscription.successmsg_desc',
        'type'    => 'textfield',
        'options' => '',
        'value'   => '',
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'usergroups',
        'desc'    => 'prop_goodnewssubscription.usergroups_desc',
        'type'    => 'textfield',
        'options' => '',
        'value'   => '',
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'usergroupsField',
        'desc'    => 'prop_goodnewssubscription.usergroupsfield_desc',
        'type'    => 'textfield',
        'options' => '',
        'value'   => '',
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'validate',
        'desc'    => 'prop_goodnewssubscription.validate_desc',
        'type'    => 'textfield',
        'options' => '',
        'value'   => '',
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'grpFieldsetTpl',
        'desc'    => 'prop_goodnewssubscription.grpfieldsettpl_desc',
        'type'    => 'textfield',
        'options' => '',
        'value'   => 'sample.GoodNewsGrpFieldsetTpl',
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'grpNameTpl',
        'desc'    => 'prop_goodnewssubscription.grpnametpl_desc',
        'type'    => 'textfield',
        'options' => '',
        'value'   => 'sample.GoodNewsGrpNameTpl',
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'grpFieldTpl',
        'desc'    => 'prop_goodnewssubscription.grpfieldtpl_desc',
        'type'    => 'textfield',
        'options' => '',
        'value'   => 'sample.GoodNewsGrpFieldTpl',
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'grpFieldHiddenTpl',
        'desc'    => 'prop_goodnewssubscription.grpfieldhiddentpl_desc',
        'type'    => 'textfield',
        'options' => '',
        'value'   => 'sample.GoodNewsGrpFieldHiddenTpl',
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'catFieldTpl',
        'desc'    => 'prop_goodnewssubscription.catfieldtpl_desc',
        'type'    => 'textfield',
        'options' => '',
        'value'   => 'sample.GoodNewsCatFieldTpl',
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'catFieldHiddenTpl',
        'desc'    => 'prop_goodnewssubscription.catfieldhiddentpl_desc',
        'type'    => 'textfield',
        'options' => '',
        'value'   => 'sample.GoodNewsCatFieldHiddenTpl',
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'groupsOnly',
        'desc'    => 'prop_goodnewssubscription.groupsonly_desc',
        'type'    => 'combo-boolean',
        'options' => '',
        'value'   => false,
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'includeGroups',
        'desc'    => 'prop_goodnewssubscription.includegroups_desc',
        'type'    => 'textfield',
        'options' => '',
        'value'   => '',
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'defaultGroups',
        'desc'    => 'prop_goodnewssubscription.defaultgroups_desc',
        'type'    => 'textfield',
        'options' => '',
        'value'   => '',
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'defaultCategories',
        'desc'    => 'prop_goodnewssubscription.defaultcategories_desc',
        'type'    => 'textfield',
        'options' => '',
        'value'   => '',
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'sort',
        'desc'    => 'prop_goodnewssubscription.sort_desc',
        'type'    => 'textfield',
        'options' => '',
        'value'   => 'name',
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'dir',
        'desc'    => 'prop_goodnewssubscription.dir_desc',
        'type'    => 'list',
        'options' => array(
            array('name' => 'opt_goodnews.asc','value'  => 'ASC'),
            array('name' => 'opt_goodnews.desc','value' => 'DESC'),
        ),
        'value'   => 'ASC',
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'grpCatPlaceholder',
        'desc'    => 'prop_goodnewssubscription.grpcatplaceholder_desc',
        'type'    => 'textfield',
        'options' => '',
        'value'   => 'grpcatfieldsets',
        'lexicon' => 'goodnews:properties',
    ),
    array(
        'name'    => 'placeholderPrefix',
        'desc'    => 'prop_goodnewssubscription.placeholderprefix_desc',
        'type'    => 'textfield',
        'options' => '',
        'value'   => '',
        'lexicon' => 'goodnews:properties',
    ),
);

return $properties;