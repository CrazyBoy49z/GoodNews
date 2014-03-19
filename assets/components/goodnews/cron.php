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
 * cron.php is the Cron connector and GoodNews process manager
 *
 * @package goodnews
 */

set_time_limit(0);

// Fetch params of CLI calls and merge with URL params (for universal usage)
if(isset($_SERVER['argc'])) {
    if ($argc > 0) {
        for ($i=1; $i < $argc; $i++) {
            parse_str($argv[$i], $tmp);
            $_GET = array_merge($_GET, $tmp);
        }
    }
}

define('MODX_API_MODE', true);
require_once dirname(dirname(dirname(dirname(__FILE__)))).'/config.core.php';
require_once MODX_CORE_PATH.'model/modx/modx.class.php';
$modx = new modX();
$modx->initialize('mgr');

// If set - connector script may only be continued if the correct security key is provided by cron (@param sid)
$securityKey = $modx->getOption('goodnews.cron_security_key', null, '');
if (isset($securityKey) && $_GET['sid'] !== $securityKey) {
    exit('[GoodNews] cron.php: Missing or wrong authentification! Sorry Dude!');
}

$debug = $modx->getOption('goodnews.debug', null, false) ? true : false;

$workerProcessActive = $modx->getOption('goodnews.worker_process_active', null, 0);
if (!$workerProcessActive) { exit(); }

$corePath  = $modx->getOption('goodnews.core_path', null, $modx->getOption('core_path').'components/goodnews/');
$assetsUrl = $modx->getOption('goodnews.assets_url', null, $modx->getOption('assets_url').'components/goodnews/');
require_once $corePath.'model/goodnews/goodnews.class.php';
$modx->goodnews = new GoodNews($modx);
if (!($modx->goodnews instanceof GoodNews)) { exit(); }


// If multi processing isn't available we directly send mails without a worker process
if (!$modx->goodnews->isMultiProcessing) {

    require_once $corePath.'model/goodnews/goodnewsmailing.class.php';
    $modx->goodnewsmailing = new GoodNewsMailing($modx);
    if (!($modx->goodnewsmailing instanceof GoodNewsMailing)) { exit(); }
    
    $mailingsToSend = $modx->goodnewsmailing->getMailingsToSend();
    foreach ($mailingsToSend as $mailingid){
        $modx->goodnewsmailing->processMailing($mailingid);
    }

// Otherwise start multiple worker processes
} else {

    require_once $corePath.'model/goodnews/goodnewsprocesshandler.class.php';
    $modx->goodnewsprocesshandler = new GoodNewsProcessHandler($modx);
    if (!($modx->goodnewsprocesshandler instanceof GoodNewsProcessHandler)) { exit(); }

    // Cleanup old processes and get count of actual running processes
    $actualProcessCount = $modx->goodnewsprocesshandler->cleanupProcessStatuses();
    if ($debug) { $modx->log(modX::LOG_LEVEL_INFO, '[GoodNews] cron.php: Actual process count: '.$actualProcessCount); }
        
    $workerProcessLimit = $modx->getOption('goodnews.worker_process_limit', null, 1);
    
    while ($actualProcessCount < $workerProcessLimit) {
            
        $actualProcessCount++;
        $modx->goodnewsprocesshandler->setCommand('php '.rtrim(MODX_BASE_PATH, '/').$assetsUrl.'cron.worker.php sid='.$_GET['sid']);
        if (!$modx->goodnewsprocesshandler->start()) {
            if ($debug) { $modx->log(modX::LOG_LEVEL_INFO, '[GoodNews] cron.php: No worker started.'); }
            break;
        } else {
            if ($debug) { $modx->log(modX::LOG_LEVEL_INFO, '[GoodNews] cron.php: New worker started with pid: '.$modx->goodnewsprocesshandler->getPid().' | Start-time: '.$modx->goodnewsprocesshandler->getProcessStartTime()); }
        }
        // Wait a little before letting start another process
        // If after this time a process is still running -> it seems there is more work to do
        sleep(2);
        if (!$modx->goodnewsprocesshandler->status()) {
            break;
        }
    }
}