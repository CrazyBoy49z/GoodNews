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
 * GoodNews Manager controller (index)
 *
 * @package goodnews
 */

require_once dirname(__FILE__) . '/model/goodnews/goodnews.class.php';

abstract class GoodNewsManagerController extends modExtraManagerController {

    /** @var GoodNews $goodnews */
    public $goodnews;
    
    public function initialize() {
        $this->goodnews = new GoodNews($this->modx);
        $container = $this->modx->getObject('modResource', $this->goodnews->userCurrentContainer);
        
        // Normally should not happen here (but we stay secure)
        if (!is_object($container)) {
            $this->goodnews->addSetupError('503 Service Unavailable', $this->modx->lexicon('goodnews.error_message_no_container_available'), false);
        }

        // Security ceck: is user entitled to manage the requested GoodNews container?
        if (!$this->goodnews->isEditor($container)) {
            $this->goodnews->addSetupError('401 Unauthorized', $this->modx->lexicon('goodnews.error_message_unauthorized'), false);
        }
        
        // Add custom css file to manager-page header based on Revo version
        if (!$this->goodnews->legacyMode) {
            // We are on Revo >= 2.3.0
            $cssFile = $this->goodnews->config['cssUrl'].'mgr23.css';
        } else {
            // We are on Revo < 2.3.0
            $cssFile = $this->goodnews->config['cssUrl'].'mgr.css';
        }

        $this->addCss($cssFile);
        
        // initialize GoodNews Js
        $this->addJavascript($this->goodnews->config['jsUrl'].'mgr/goodnews.js');
        
        return parent::initialize();
    }
    
    public function getLanguageTopics() {
        return array('goodnews:default');
    }
    
    public function checkPermissions() {
        return true;
    }
    
}

class IndexManagerController extends GoodNewsManagerController {
    public static function getDefaultController() {
        return 'home';
    }
}
