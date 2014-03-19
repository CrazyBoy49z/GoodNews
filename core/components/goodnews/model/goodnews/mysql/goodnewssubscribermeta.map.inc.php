<?php
/**
 * @package goodnews
 */
$xpdo_meta_map['GoodNewsSubscriberMeta']= array (
  'package' => 'goodnews',
  'version' => NULL,
  'table' => 'goodnews_subscriber_meta',
  'extends' => 'xPDOSimpleObject',
  'fields' => 
  array (
    'subscriber_id' => NULL,
    'sid' => '',
    'createdon' => NULL,
    'testdummy' => 0,
    'ip' => '0',
  ),
  'fieldMeta' => 
  array (
    'subscriber_id' => 
    array (
      'dbtype' => 'int',
      'precision' => '10',
      'attributes' => 'unsigned',
      'phptype' => 'integer',
      'null' => false,
      'index' => 'unique',
    ),
    'sid' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '255',
      'phptype' => 'string',
      'null' => false,
      'default' => '',
    ),
    'createdon' => 
    array (
      'dbtype' => 'datetime',
      'phptype' => 'datetime',
      'null' => true,
    ),
    'testdummy' => 
    array (
      'dbtype' => 'int',
      'precision' => '1',
      'attributes' => 'unsigned',
      'phptype' => 'boolean',
      'null' => false,
      'default' => 0,
    ),
    'ip' => 
    array (
      'dbtype' => 'varchar',
      'precision' => '50',
      'phptype' => 'string',
      'null' => false,
      'default' => '0',
    ),
  ),
  'indexes' => 
  array (
    'subscriber_id' => 
    array (
      'alias' => 'subscriber_id',
      'primary' => false,
      'unique' => true,
      'type' => 'BTREE',
      'columns' => 
      array (
        'subscriber_id' => 
        array (
          'length' => '',
          'collation' => 'A',
          'null' => false,
        ),
      ),
    ),
  ),
  'aggregates' => 
  array (
    'User' => 
    array (
      'class' => 'modUser',
      'local' => 'subscriber_id',
      'foreign' => 'id',
      'cardinality' => 'one',
      'owner' => 'foreign',
    ),
  ),
);