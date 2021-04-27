<?php
class Default_Bootstrap extends Zend_Application_Module_Bootstrap{
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