<?php

class Admin_Model_Transition extends Zend_Db_Table
{
    protected $_name = 'transition';
    protected $_primary = 'id';

    protected $_referenceMap = array(

            'referenceMap' => array(
                'User' => array(
                    'columns' => 'user_id',
                    'refTableClass' => 'Admin_Model_User',
                    'refColumns' => 'id'
                )
            )
        );


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
        $row->status=$arrParam['status'];
        $row->user_id=$arrParam['user_id'];
        $row->user_name=$arrParam['user_name'];
        $row->user_email=$arrParam['user_email'];
        $row->user_phone=$arrParam['user_phone'];
        $row->amount=$arrParam['amount'];
        $row->payment=$arrParam['payment'];
        $row->payment_info=$arrParam['payment_info'];
        $row->message=$arrParam['message'];
        $row->security=$arrParam['security'];
        $row->created=$arrParam['created'];
        $row->save();


    }
    public function editItem($array_param = null)
    {
        $where = 'id ='. $array_param['id'];
        $row = $this->FetchRow($where);
        $row->status=$array_param['status'];
        $row->user_id=$array_param['user_id'];
        $row->user_name=$array_param['user_name'];
        $row->user_email=$array_param['user_email'];
        $row->user_phone=$array_param['user_phone'];
        $row->amount=$array_param['amount'];
        $row->payment=$array_param['payment'];
        $row->payment_info=$array_param['payment_info'];
        $row->message=$array_param['message'];
        $row->security=$array_param['security'];
        $row->created=$array_param['created'];
        $row->save();

    }

}


