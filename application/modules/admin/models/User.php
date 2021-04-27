<?php

class Admin_Model_User extends Zend_Db_Table
{
    protected $_name = 'user';
    protected $_primary = 'id';

    protected $_dependentTables = array('Admin_Model_Transition');


    public function ListItem()
    {
        $result = $this->fetchAll();
        return $result;
    }
    public function deleteItem($array_param = null)
    {
        $where = 'id ='. $array_param['id'];
        $this->delete($where);
    }
    public function infoItem($array_param=null)
    {

        $where = 'id ='. $array_param['id'];
        $result= $this->fetchRow($where)->toArray();
        return $result;
    }
    public function addItem($arrParam = null)
    {
        $encode  = new Zend_Encode();
        $row = $this->fetchNew();
        $row->user_name=$arrParam['user_name'];
        $row->password=$encode->password($arrParam['password']);
        $row->email=$arrParam['email'];
        $row->save();
    }
    public function editItem($array_param = null)
    {
        $encode  = new Zend_Encode();

        $where = 'id ='. $array_param['id'];
        $row = $this->FetchRow($where);
        $row->user_name=$array_param['user_name'];
        $row->password= $encode->password($array_param['password']);
        $row->email=$array_param['email'];
        $row->save();

    }

}


