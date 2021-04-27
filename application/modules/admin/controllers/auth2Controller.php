<?php
class auth2Controller extends Zend_Controller_Action{

//Mang tham so nhan duoc o moi Action
    protected $_arrParam;

    //Duong dan cua Controller
    protected $_currentController;

    //Duong dan cua Action chinh
    protected $_actionMain;

    protected $_namespace;

    public function init(){
        //Mang tham so nhan duoc o moi Action
        $this->_arrParam = $this->_request->getParams();
        
        $this->_currentModules = '/' . $this->_arrParam['module']
        . '/';

        //Duong dan cua Controller
        $this->_currentController = '/' . $this->_arrParam['module']
            . '/' . $this->_arrParam['controller'];

        //Duong dan cua Action chinh
        $this->_actionMain = '/' . $this->_arrParam['module']
            . '/' . $this->_arrParam['controller']	. '/index';


        ;

        //Truyen ra view
        $this->view->arrParam = $this->_arrParam;
        $this->view->currentController = $this->_currentController;
        $this->view->actionMain = $this->_actionMain;
        $this->view->currentModules= $this->_currentModules;

        $template_path = TEMPLATE_PATH . "/admin/system";
        $this->loadTemplate($template_path,'template.ini','template');
    }

    public function indexAction(){
        $auth = Zend_Auth::getInstance();
        if($auth->hasIdentity()){
//            $link = $this->view->baseUrl('/admin/auth2/logout');
//            $this->view->auth = 'Ban dang o trong tai khoan cua ban.
//								<a href="' . $link . '">Thoat.</a>
//								';
            $this->redirect()->toUrl(BaseUrl('admin/index'));
        }else{
//            $link = $this->view->baseUrl('/admin/auth2/login');
//            $this->view->auth = 'Xin vui long dang nhap vao tai khoan cua ban.
//								<a href="' . $link . '">Nhan vao day de dang nhap.</a>
//								 ';
            $this->redirect()->toUrl(BaseUrl('default/index'));
        }

    }

    public function loginAction(){
        if($this->_request->isPost()){
            $auth = new Zend_System_Auth();
            if($auth->login($this->_arrParam)){
                $this->redirect('/admin/user/index');
            }else{
                echo $auth->getError();
            }
        }
    }

    public function logoutAction()
    {
        $auth = new Zend_System_Auth();
        $auth->logout();
        $this->redirect($this->_actionMain.'/admin/auth2/login');
        $this->_helper->viewRenderer->setNoRender();

    }
}