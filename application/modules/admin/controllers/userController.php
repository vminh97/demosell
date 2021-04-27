<?php

class userController extends Zend_Controller_Action
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

        $guestbook = new Admin_Model_User();
        $this->view->Items = $guestbook->listItem($this->_arrParam);

    }

    public function addAction($arrParam = null)
    {
        $template_path = TEMPLATE_PATH . "/admin/system";
        $this->loadTemplate($template_path, 'template.ini', 'template');
            if($this->_request->isPost()){
                $input = $this->_request->getParam('user_name','');
                $input2 = $this->_request->getParam('email','');

                $options = array('table'=>'user','field'=>'user_name');

                $validator = new Zend_Validate();

                $validator->addValidator(new Zend_Validate_NotEmpty(),true)
                          ->addValidator(new Zend_Validate_StringLength(5,32),true)
                          ->addValidator(new Zend_Validate_Db_NoRecordExists($options),true);
                $validator2 = new Zend_Validate();
                $validator2->addValidator(new Zend_Validate_NotEmpty(),true)
                           ->addValidator(new Zend_Validate_EmailAddress());


                if(!$validator->isValid($input)){
                    $messages = $validator->getMessages();
                    echo current($messages).'</br>';
                    if(!$validator2->isValid($input2)){
                        $messages = $validator2->getMessages();
                        echo current($messages);

                    }
                }
                else
                {
                    $upload = new Admin_Model_User();
                    $this->view->Items = $upload->addItem($this->_arrParam);
                    $this->redirect('/admin/user/index');
                }



            }
        
    }

    public function editAction()
    {
        $template_path = TEMPLATE_PATH . "/admin/system";
        $this->loadTemplate($template_path, 'template.ini', 'template');

        $guestbook = new Admin_Model_User();
        $this->view->Items = $guestbook->infoItem($this->_arrParam);

        if($this->_request->isPost()){
            $input = $this->_request->getParam('user_name','');
            $input2 = $this->_request->getParam('email','');
            
            $options = array('table'=>'user','field'=>'user_name');
        
            $validator = new Zend_Validate();
            
            $validator->addValidator(new Zend_Validate_NotEmpty(),true)
                      ->addValidator(new Zend_Validate_StringLength(5,32),true);     
            $validator2 = new Zend_Validate(); 
            $validator2->addValidator(new Zend_Validate_NotEmpty(),true)
                       ->addValidator(new Zend_Validate_EmailAddress());    
                       
                
            if(!$validator->isValid($input)){
                $messages = $validator->getMessages();
                echo current($messages).'</br>';
                if(!$validator2->isValid($input2)){
                    $messages = $validator2->getMessages();
                    echo current($messages);
                     
                }
            }
            else
            {
                $User = new Admin_Model_User();
                $this->view->Items = $User->editItem($this->_arrParam);
                $this->redirect('/admin/user/index');
            }
                     
        }
    }

    public function infoAction()
    {

        $template_path = TEMPLATE_PATH . "/admin/system";
        $this->loadTemplate($template_path, 'template.ini', 'template');

        $guestbook = new Admin_Model_User();
        $this->view->Items = $guestbook->infoItem($this->_arrParam);

    }

    public function deleteAction()
    {
        $template_path = TEMPLATE_PATH . "/admin/system";
        $this->loadTemplate($template_path, 'template.ini', 'template');
        if ($this->_request->isPost()) {
            {
                $guestbook = new Admin_Model_User();
                $this->view->Items = $guestbook->deleteItem($this->_arrParam);
                $this->redirect('/admin/user/index');
            }

        }


    }

    public function fileAction(){

        if($this->_request->isPost()){
            $upload = new Zend_File_Transfer_Adapter_Http();
            $upload->setDestination(IMAGE_PATH. '/admin/system/images/user' ,'picture');
            $upload->receive('picture');

        }
    }

}
