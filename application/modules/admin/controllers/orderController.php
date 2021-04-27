<?php

class orderController extends Zend_Controller_Action
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
        // $headLink = $this->get('Pimcore\Templating\Helper\HeadLink');
        // $guestbook = new Application_Model_GuestbookMapper();
        // $this->view->entries = $guestbook->fetchAll();
        // $this->view->Title = __METHOD__;
        // $headLink->headLink()->appendStylesheet(PUBLIC_URL . '/css/blog.css','screen');
        $template_path = TEMPLATE_PATH . "/admin/system";
        $this->loadTemplate($template_path,'template.ini','template');

        $guestbook = new Admin_Model_Order();
        $this->view->Items = $guestbook->listItem($this->_arrParam);

    }

    public function addAction(){
        $template_path = TEMPLATE_PATH . "/admin/system";
        $this->loadTemplate($template_path,'template.ini','template');
        if($this->getRequest()->getPost())
        {
            $guestbook = new Admin_Model_Order();
            $this->view->Items = $guestbook->addItem($this->_arrParam);
        }
    }
    public function infoAction()
    {

        $template_path = TEMPLATE_PATH . "/admin/system";
        $this->loadTemplate($template_path,'template.ini','template');

        $guestbook = new Admin_Model_Order();
        $this->view->Items = $guestbook->infoItem($this->_arrParam);

    }
    public function editAction()
    {
        $template_path = TEMPLATE_PATH . "/admin/system";
        $this->loadTemplate($template_path,'template.ini','template');

        $guestbook = new Admin_Model_Order();
        $this->view->Items = $guestbook->infoItem($this->_arrParam);
        echo '<pre>';
        print_r($this->view->Items);
        echo '</pre>';
        if($this->getRequest()->getPost())
        {
            $guestbook = new Admin_Model_Order();
            $this->view->Items = $guestbook->editItem($this->_arrParam);
        }

    }

    public function deleteAction(){
        $template_path = TEMPLATE_PATH . "/admin/system";
        $this->loadTemplate($template_path,'template.ini','template');
        if($this->_request->getPost())
        {
            $guestbook = new Admin_Model_Order();
            $this->view->Items = $guestbook->deleteItem($this->_arrParam);
        }

    }


}

