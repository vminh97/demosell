<?php

class Admin_Model_Category extends Zend_Db_Table
{
    protected $_name = 'category';
    protected $_primary = 'id';

    protected $_dependentTables = array('Admin_Model_Product');

    	
	public function itemInSelectbox($arrParam = null, $options = null){
		$db = Zend_Registry::get('connectDb');
		//$db = Zend_Db::factory($adapter,$config);
		if($options == null){
			$select = $db->select()
						 ->from('category', array('id','name'));
			$result = $db->fetchPairs($select)	;
			$result[0] = ' -- Select an Item -- ';
            ksort($result);
            
        }
       
    }
    public function ListItem()
    {
        $result = $this->fetchAll();
        return $result;	
        echo '<pre>';
        print_r($result);	
        echo '<pre>';			 
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
    public function infoItem2($array_param=null)
    {

        $where = 'id ='. $array_param;
        echo $where;
        $result= $this->fetchRow($where)->toArray();
        return $result;

    }

    public function addItem($arrParam = null)
    {
        $row = $this->fetchNew();
        $row->name=$arrParam['name'];
        $row->description=$arrParam['description'];
        $row->save();
    }
    public function editItem($array_param = null)
    {
        $where = 'id ='. $array_param['id'];
        $row = $this->FetchRow($where);
        $row->name=$array_param['name'];
        $row->description=$array_param['description'];
        $row->save();

    }

}


