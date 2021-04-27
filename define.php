<?php
//Duong dan den thu muc chua ung dung
defined('APPLICATION_PATH')
	|| define('APPLICATION_PATH', 
			  realpath(dirname(__FILE__) . '/application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV',
              (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV')
                                         : 'production'));
			  
//Nap duong dan den cac thu vien se su dung trong ung dung
set_include_path(implode(PATH_SEPARATOR, array(
    dirname(__FILE__) . '/library',
    get_include_path(),
)));
require_once 'library/Zend/Application.php';                                       
//Duong dan den thu muc /public
define('PUBLIC_PATH', realpath(dirname(__FILE__) . '/public'));
//Duong dan den thu muc /templates
define('TEMPLATE_PATH', PUBLIC_PATH . '/templates');
define('IMAGE_PATH', PUBLIC_PATH . '/templates');

//Duong dan den thu muc /templates
define('TEMPLATE_URL', '/public/templates');
define('IMAGE_LINK', '/multi-zend/public/templates');

