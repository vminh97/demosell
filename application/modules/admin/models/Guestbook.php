<?php

class Admin_Model_Guestbook extends Zend_Db_Table
{  
    protected $_name = 'guestbooks';
    protected $_primary = 'id';


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
     

      $row = $this->fetchNew();
      $row->email=$arrParam['email'];
      $row->comment=$arrParam['comment'];
      $row->save();
      
   
    }
    public function editItem($array_param = null)
    {
      $where = 'id ='. $array_param['id'];
      $row = $this->FetchRow($where);   
        $row->email  =$array_param['email'];
        $row->comment=$array_param['comment'];
        $row->save();
        
    }

}


