<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	 protected function _initAutoload()
	 {
		  $arrConfig=array('namespace'=>'','basePath'=> APPLICATION_PATH);
		  $autoload = new Zend_Application_Module_Autoloader($arrConfig);
		  return $autoload;
	 }
    protected function _initSession(){
        Zend_Session::start();
    }
   
	  protected function _initView()
	  {
		  $view = new Zend_View();
		  $view->headTitle()->setSeparator(' - ')->append('Minh');
		  $view->headMeta()->appendHttpEquiv('Content-Type',
											   'text/html; charset=utf-8');
		 
	  }
	protected function _initConfigs()
	{
		$config = new Zend_Config($this->getOptions(), true);
		Zend_Registry::set('config', $config);
		return $config;
	}
	protected function _initDb(){
		
	$optionResources = $this->getOption('resources');
	$dbOption = $optionResources['db'];
	$dbOption['params']['username'] = 'root';
	$dbOption['params']['password'] = 'minh1997';
	$dbOption['params']['dbname'] = 'banhang';


	$config = $dbOption['params'];

	$db = Zend_Db::factory('Pdo_Mysql',$config);
	$db->setFetchMode(Zend_Db::FETCH_ASSOC);
	$db->query("SET NAMES 'utf8'");
	$db->query("SET CHARACTER SET 'utf8'");

	Zend_Registry::set('connectDb',$db);

	Zend_Db_Table::setDefaultAdapter($db);

	return $db;

	}

}

