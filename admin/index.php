<?php



//ini_set('display_errors', 1);
//error_reporting(E_ALL ^ E_NOTICE); 
ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_WARNING & ~E_STRICT & ~E_DEPRECATED);
ini_set('display_errors','Off');
define('APP_ROOT', dirname(__FILE__));         
define('ROOT_PATH', dirname(APP_ROOT));   
define('IN_BACKEND', true);
include(ROOT_PATH . '/eccore/ecmall.php');


ecm_define(ROOT_PATH . '/data/config.inc.php');


ECMall::startup(array(
    'default_app'   =>  'default',
    'default_act'   =>  'index',
    'app_root'      =>  APP_ROOT . '/app',
    'external_libs' =>  array(
        ROOT_PATH . '/includes/global.lib.php',
        ROOT_PATH . '/includes/libraries/time.lib.php',
        ROOT_PATH . '/includes/ecapp.base.php',
        ROOT_PATH . '/includes/plugin.base.php',
        APP_ROOT . '/app/backend.base.php',
    ),
));

?>