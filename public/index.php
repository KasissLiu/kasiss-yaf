<?php
//错误输出控制
error_reporting(E_ERROR);

define("APP_PATH",  realpath(dirname(__DIR__) ));


try {
    $app  = new \Yaf\Application(APP_PATH . "/conf/application.ini");

    //设定默认路径
    $config = \Yaf\Application::app()->getConfig();
    define('APP_APPLICATION', $config->application->directory);
    define('APP_LIBRARY', \Yaf\Loader::getInstance()->getLibraryPath(true));

    //加载通用类
    include_once(APP_LIBRARY.'/inc.php');

    $app->bootstrap()->run();

} catch(\Exception $e) {

}