<?php

class Admin_Model_Order extends Zend_Db_Table
{
    protected $_name = 'orderbh';
    protected $_primary = 'id';

    protected $_referenceMap = array(

    'Order' => array(
        'referenceMap' => array(
            'Product' => array(
                'columns' => 'product_id',
                'refTableClass' => 'Admin_Model_Product',
                'refColumns' => 'id'
                ),
            'Transition' => array(
                'columns' => 'transition_id',
                'refTableClass' => 'Admin_Model_Transition',
                'refColumns' => 'id'
                )
        )
    ));


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
        $row->transaction_id=$arrParam['transaction_id'];
        $row->product_id=$arrParam['product_id'];
        $row->amount=$arrParam['amount'];
        $row->data=$arrParam['data'];
        $row->status=$arrParam['status'];
        $row->save();


    }
    public function editItem($array_param = null)
    {
        $where = 'id ='. $array_param['id'];
        $row = $this->FetchRow($where);
        $row->transaction_id=$array_param['transaction_id'];
        $row->product_id=$array_param['product_id'];
        $row->amount=$array_param['amount'];
        $row->data=$array_param['data'];
        $row->status=$array_param['status'];
        $row->save();

    }

}


