<?php 

class indexController extends Zend_Controller_Action
{
    public function init()
    {
        parent::init(); //gọi đến hàm của class cha
    }
    public function indexAction()
    {
        $template_path = TEMPLATE_PATH . "/admin/system";
		$this->loadTemplate($template_path,'template.ini','template');
		
        // $a= $this->_request;
        // echo '<pre>';
        // print_r($a); 
        // echo '</pre>';
        // $array_param= $this->_request->getParams();
        // echo '<pre>';
        //  print_r($array_param); 
        // echo '</pre>';

        // echo '<br>' .$array_param['minh'];

    }
}