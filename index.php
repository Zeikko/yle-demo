<?php

$production = false;

if ($production) {
    
} else {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

// change the following paths if necessary
    $yii = '/home/zeikko/yii-1.1.13/yii.php';
    $config = dirname(__FILE__) . '/protected/config/development.php';

// remove the following lines when in production mode
    defined('YII_DEBUG') or define('YII_DEBUG', true);
// specify how many levels of call stack should be shown in each log message
    defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);
}
require_once($yii);
require_once(dirname(__FILE__).'/protected/components/WebApplication.php');
$app = new WebApplication($config);
$app->run();
