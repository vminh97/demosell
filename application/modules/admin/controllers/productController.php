<?php

class productController extends Zend_Controller_Action
{

    //Mang tham so nhan duoc o moi Action
    protected $_arrParam;
    //Duong dan cua Controller
    protected $_currentController;
    //Duong dan cua Action chinh
    protected $_actionMain;

    public function init()
    {
        //Mang tham so nhan duoc o moi Action
        $this->_arrParam = $this->_request->getParams();

        //Duong dan cua Controller
        $this->_currentController = '/' . $this->_arrParam['module']
            . '/' . $this->_arrParam['controller'];

        //Duong dan cua Action chinh
        $this->_actionMain = '/' . $this->_arrParam['module']
            . '/' . $this->_arrParam['controller']	. '/index';


        $this->view->arrParam = $this->_arrParam;
        $this->view->currentController = $this->_currentController;
        $this->view->actionMain = $this->_actionMain;

    }
    public function indexAction()
    {

        $template_path = TEMPLATE_PATH . "/admin/system";
        $this->loadTemplate($template_path,'template.ini','template');
		
		
		$tblGroup = new Admin_Model_Category();
        $this->view->items = $tblGroup->itemInSelectbox();

        $hehe = new Admin_Model_Product();
        $this->view->proindex = $hehe->listItem($this->_arrParam);

    }

    public function addAction(){
        $template_path = TEMPLATE_PATH . "/admin/system";
        $this->loadTemplate($template_path,'template.ini','template');
		
		$tblGroup = new Admin_Model_Category();
        $this->view->category = $tblGroup->ListItem();
        if($this->_request->isPost())
        {
            $guestbook = new Admin_Model_Product();
            $this->view->Items = $guestbook->addItem($this->_arrParam);
            $this->redirect('/admin/product/index');
        }

    }
    public function infoAction()
    {

        $template_path = TEMPLATE_PATH . "/admin/system";
        $this->loadTemplate($template_path,'template.ini','template');
        	
        $guestbook = new Admin_Model_Product();
        $this->view->Items = $guestbook->infoItem($this->_arrParam);


    }
   
    public function editAction()
    {
        $template_path = TEMPLATE_PATH . "/admin/system";
        $this->loadTemplate($template_path,'template.ini','template');

        $guestbook = new Admin_Model_Product();
        $this->view->Items = $guestbook->infoItem($this->_arrParam);

		$tblGroup = new Admin_Model_Category();
		$this->view->CateOziona = $tblGroup->infoItem2($this->view->Items['category_id']);
        if($this->_request->isPost())
        {
            $guestbook = new Admin_Model_Product();
            $this->view->Items = $guestbook->editItem($this->_arrParam);
            $this->redirect('/admin/product/index');
        }
    }
    public function deleteAction()
    {
        $template_path = TEMPLATE_PATH . "/admin/system";
        $this->loadTemplate($template_path, 'template.ini', 'template');
        if ($this->_request->isPost()) {
            {
                $guestbook = new Admin_Model_Product();
                $this->view->Items = $guestbook->deleteItem($this->_arrParam);
                $this->redirect('/admin/product/index');
            }

        }


    }


}

