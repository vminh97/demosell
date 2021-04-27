<?php 

class indexController extends Zend_Controller_Action
{
        //Mang tham so nhan duoc o moi Action
        protected $_arrParam;
        //Duong dan cua Controller
        protected $_currentController;
        //Duong dan cua Action chinh
        protected $_actionMain;
    public function init()
    {
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


        $guestbook = new Admin_Model_Category();
        $this->view->Items = $guestbook->listItem($this->_arrParam);



    }
    public function indexAction()
    {
         $template_path = TEMPLATE_PATH . "/default/system";
		 $this->loadTemplate($template_path,'template.ini','template');


        $guestbook = new Admin_Model_Category();
        $this->view->Items = $guestbook->listItem($this->_arrParam);

        $productsnew = new Admin_Model_Product();
        $this->view->News = $productsnew->NewProduct($this->_arrParam);

        $productsnew = new Admin_Model_Product();
        $this->view->hightlight = $productsnew->HlProduct($this->_arrParam);


    }
    public function prbycateAction()
    {

        $template_path = TEMPLATE_PATH . "/default/system";
		$this->loadTemplate($template_path,'template.ini','template');

        $data = new Admin_Model_Product();
        $this->view->Product = $data->ProductbyCategory($this->_arrParam);


    }
    public function detailprAction()
    {
        $template_path = TEMPLATE_PATH . "/default/system";
        $this->loadTemplate($template_path,'template.ini','template');

        $detailpr = new Admin_Model_Product();
        $this->view->detailpro2 = $detailpr->infoItem($this->_arrParam);

        $detailpr = new Admin_Model_Product();
        $this->view->simalar = $detailpr->ProductbyCategory($this->view->detailpro2);
        
    }
    public function contactAction()
    {
        $template_path = TEMPLATE_PATH . "/default/system";
        $this->loadTemplate($template_path,'template.ini','template');
    }
    public function tutorialAction()
    {
        $template_path = TEMPLATE_PATH . "/default/system";
        $this->loadTemplate($template_path,'template.ini','template');
    }
    
}