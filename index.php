<?php
include_once('define.php');



require_once 'Zend/Application.php';

$environment = APPLICATION_ENV;
$options = APPLICATION_PATH . '/configs/application.ini';
$application = new Zend_Application($environment, $options);
$application->bootstrap()->run();


// $frontController->setParam('useDefaultControllerAlways', true);
// $frontController->dispatch();