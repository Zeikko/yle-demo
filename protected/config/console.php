<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'My Console Application',
    // preloading 'log' component
    'preload' => array('log'),
    // application components
    'import' => array(
	'application.models.*',
	'application.components.*',
	'application.components.table.*',
    ),
    'components' => array(
	'db' => array(
	    'connectionString' => 'mysql:host=localhost;dbname=yledashboard',
	    'emulatePrepare' => true,
	    'username' => 'yledashboard',
	    'password' => 'rNLj6xNaDr8Q5pxv',
	    'charset' => 'utf8',
//            'table    Prefix' => '',
	),
	'log' => array(
	    'class' => 'CLogRouter',
	    'routes' => array(
		array(
		    'class' => 'CFileLogRoute',
		    'levels' => 'error, warning',
		),
	    ),
	),
    ),
    'params' => array(
	'dataSources' => array(
	    'survey' => 'https://docs.google.com/spreadsheet/pub?key=0Akc0L9drWLFldGNKVS1YNTBIbHA5cVNjOTJGMUpOdXc&output=csv&gid=2',
	    'traffic' => 'https://docs.google.com/spreadsheet/pub?key=0AopMV-5iQTgudGN2UmZfclB2UUh2T0Z6Z2VxczY4dEE&single=true&gid=0&output=csv',
	),
    ),	
);