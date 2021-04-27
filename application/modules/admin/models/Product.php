<?php

class Admin_Model_Product extends Zend_Db_Table
{
    protected $_name = 'product';
    protected $_primary = 'id';

    protected $_referenceMap = array(
            'referenceMap' => array(
                'Category' => array(
                    'columns' => 'category_id',
                    'refTableClass' => 'Admin_Model_Category',
                    'refColumns' => 'id'
                ),
        ));
    public function NewProduct($row= null)
    {
        $db=Zend_Registry::get('connectDb');
        $result1= $db->select()->from('product as p',array('id','name','content','brand','price',
        'category_id','ParameterPro','discount','image_list','created'))->order('created DESC')->limit(4,0);

        $row=$db->fetchAll($result1);
        return $row;

        
    }
    public function HlProduct($row= null)
    {
        $db=Zend_Registry::get('connectDb');
        $result1= $db->select()->from('product as p',array('id','name','content','brand','price',
            'category_id','ParameterPro','discount','image_list','created'))->order('price DESC')->limit(4,0);

        $row=$db->fetchAll($result1);
        return $row;


    }
    public function ListItem()
    {
        $result = $this->fetchAll()->toArray();
        return $result;
    }
    public function ProductbyCategory($array_param)
    {
        $where = 'category_id = '. $array_param['id'];
        $product = $this->fetchAll($where)->toArray();
        return $product;

    }
    public function deleteItem( $array_param= null)
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
        $website = $_REQUEST['category_id'];
        $row->category_id=$website;
        $row->name=$arrParam['name'];
        $row->brand=$arrParam['brand'];
        $row->skill=$arrParam['skill'];
        $row->price=$arrParam['price'];
        $row->content=$arrParam['content'];
        $row->ParameterPro=$arrParam['ParameterPro'];;
        $row->discount=$arrParam['discount'];
        $row->image_list=$arrParam['image_list'];
        $row->save();


    }
    public function editItem($array_param = null)
    {
        $where = 'id ='. $array_param['id'];
        $row = $this->FetchRow($where);
        $row->name=$array_param['name'];
        $row->brand=$array_param['brand'];
        $row->skill=$array_param['skill'];
        $row->price=$array_param['price'];
        $row->content=$array_param['content'];
        $row->ParameterPro=$array_param['ParameterPro'];;
        $row->discount=$array_param['discount'];
        $row->image_list=$array_param['image_list'];
        $row->save();

    }

}


