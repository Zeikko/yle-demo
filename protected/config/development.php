<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Game Dev Test',
    'preload' => array(
	'log',
	'bootstrap',
    ),
    // autoloading model and component classes
    'import' => array(
	'application.models.*',
	'application.components.*',
	'application.components.table.*',
    ),
    'modules' => array(
	'gii' => array(
	    'class' => 'system.gii.GiiModule',
	    'password' => 'yledashboard67',
	    'ipFilters' => array('212.89.234.35', '::1'),
	    'generatorPaths' => array(
		'bootstrap.gii'
	    ),
	),
	'usergroup' => array(
	    'usergroupTable' => 'user_group',
	    'usergroupMessagesTable' => 'user_group_message',
	),
	'membership' => array(
	    'membershipTable' => 'membership',
	    'paymentTable' => 'payment',
	),
	'friendship' => array(
	    'friendshipTable' => 'friendship',
	),
	'profile' => array(
	    'privacySettingTable' => 'privacysetting',
	    'profileFieldTable' => 'profile_field',
	    'profileTable' => 'profile',
	    'profileCommentTable' => 'profile_comment',
	    'profileVisitTable' => 'profile_visit',
	),
	'role' => array(
	    'roleTable' => 'role',
	    'userRoleTable' => 'user_role',
	    'actionTable' => 'action',
	    'permissionTable' => 'permission',
	),
	'message' => array(
	    'messageTable' => 'message',
	),
	'registration' => array(
	),
    ),
    // application components
    'components' => array(
	'cache' => array(
	    'class' => 'CDummyCache',
	),
	'bootstrap' => array(
	    'class' => 'ext.bootstrap.components.Bootstrap',
	    'responsiveCss' => true,
	    'fontAwesomeCss' => true,
	),
	'urlManager' => array(
	    'urlFormat' => 'path',
	    'rules' => array(
		'<controller:\w+>/<id:\d+>' => '<controller>/view',
		'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
		'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
	    ),
	    'showScriptName' => false,
	),
	'db' => array(
	    'connectionString' => 'mysql:host=localhost;dbname=yledashboard',
	    'emulatePrepare' => true,
	    'username' => 'yledashboard',
	    'password' => 'rNLj6xNaDr8Q5pxv',
	    'charset' => 'utf8',
	),
	'errorHandler' => array(
	    // use 'site/error' action to display errors
	    'errorAction' => 'site/error',
	),
	'log' => array(
	    'class' => 'CLogRouter',
	    'routes' => array(
		array(
		    'class' => 'CFileLogRoute',
		    'levels' => 'error, warning',
		),
	    // uncomment the following to show log messages on web pages
	    /*
	      array(
	      'class'=>'CWebLogRoute',
	      ),
	     */
	    ),
	),
    ),
    'params' => array(
    ),
);