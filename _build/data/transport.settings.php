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
 * Add system settings to package.
 *
 * @package goodnews
 * @subpackage build
 */

$settings = array();

$settings['goodnews.test_subject_prefix'] = $modx->newObject('modSystemSetting');
$settings['goodnews.test_subject_prefix']->fromArray(array(
    'key'       => 'goodnews.test_subject_prefix',
    'value'     => '[TESTMAILING] ',
    'xtype'     => 'textfield',
    'namespace' => 'goodnews',
    'area'      => '',
), '', true, true);

$settings['goodnews.mailing_bulk_size'] = $modx->newObject('modSystemSetting');
$settings['goodnews.mailing_bulk_size']->fromArray(array(
    'key'       => 'goodnews.mailing_bulk_size',
    'value'     => '30',
    'xtype'     => 'numberfield',
    'namespace' => 'goodnews',
    'area'      => '',
), '', true, true);

$settings['goodnews.worker_process_active'] = $modx->newObject('modSystemSetting');
$settings['goodnews.worker_process_active']->fromArray(array(
    'key'       => 'goodnews.worker_process_active',
    'value'     => '0',
    'xtype'     => 'combo-boolean',
    'namespace' => 'goodnews',
    'area'      => '',
), '', true, true);

$settings['goodnews.worker_process_limit'] = $modx->newObject('modSystemSetting');
$settings['goodnews.worker_process_limit']->fromArray(array(
    'key'       => 'goodnews.worker_process_limit',
    'value'     => '4',
    'xtype'     => 'numberfield',
    'namespace' => 'goodnews',
    'area'      => '',
), '', true, true);

$settings['goodnews.admin_groups'] = $modx->newObject('modSystemSetting');
$settings['goodnews.admin_groups']->fromArray(array(
    'key'       => 'goodnews.admin_groups',
    'value'     => 'Administrator',
    'xtype'     => 'textfield',
    'namespace' => 'goodnews',
    'area'      => '',
), '', true, true);

$settings['goodnews.cron_security_key'] = $modx->newObject('modSystemSetting');
$settings['goodnews.cron_security_key']->fromArray(array(
    'key'       => 'goodnews.cron_security_key',
    'value'     => '',
    'xtype'     => 'textfield',
    'namespace' => 'goodnews',
    'area'      => '',
), '', true, true);

$settings['goodnews.default_container_template'] = $modx->newObject('modSystemSetting');
$settings['goodnews.default_container_template']->fromArray(array(
    'key'       => 'goodnews.default_container_template',
    'value'     => '0',
    'xtype'     => 'modx-combo-template',
    'namespace' => 'goodnews',
    'area'      => '',
), '', true, true);

$settings['goodnews.debug'] = $modx->newObject('modSystemSetting');
$settings['goodnews.debug']->fromArray(array(
    'key'       => 'goodnews.debug',
    'value'     => '0',
    'xtype'     => 'combo-boolean',
    'namespace' => 'goodnews',
    'area'      => '',
), '', true, true);

return $settings;