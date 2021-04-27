<?php

class categoryController extends Zend_Controller_Action
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
            . '/' . $this->_arrParam['controller'] . '/index';


        $this->view->arrParam = $this->_arrParam;
        $this->view->currentController = $this->_currentController;
        $this->view->actionMain = $this->_actionMain;

    }

    public function indexAction()
    {

        $template_path = TEMPLATE_PATH . "/admin/system";
        $this->loadTemplate($template_path, 'template.ini', 'template');


        $categoryindex = new Admin_Model_Category();
        $this->view->cateindex = $categoryindex->listItem($this->_arrParam);

    }

    public function addAction()
    {
        $template_path = TEMPLATE_PATH . "/admin/system";
        $this->loadTemplate($template_path, 'template.ini', 'template');
        if ($this->_request->isPost()) {
            $input = $this->_request->getParam('name', '');
            $input2 = $this->_request->getParam('description', '');

            $options = array('table' => 'user', 'field' => 'name', 'description');

            $validator = new Zend_Validate();

            $validator->addValidator(new Zend_Validate_NotEmpty(), true)
                ->addValidator(new Zend_Validate_StringLength(5, 32), true)
                ->addValidator(new Zend_Validate_Db_NoRecordExists($options), true);
            $validator2 = new Zend_Validate();
            $validator2->addValidator(new Zend_Validate_NotEmpty(), true)
                ->addValidator(new Zend_Validate_StringLength(5, 32), true)
                ->addValidator(new Zend_Validate_Db_NoRecordExists($options), true);


            if (!$validator->isValid($input)) {
                $messages = $validator->getMessages();
                echo current($messages) . '</br>';
                if (!$validator2->isValid($input2)) {
                    $messages = $validator2->getMessages();
                    echo current($messages);

                }
            } else {
                $guestbookend = new Admin_Model_Category();
                $this->view->Items = $guestbookend->addItem($this->_arrParam);
                $this->redirect('admin/category/index');
            }
        }

    }

    public function infoAction()
    {

        $template_path = TEMPLATE_PATH . "/admin/system";
        $this->loadTemplate($template_path, 'template.ini', 'template');

        $guestbook = new Admin_Model_Category();
        $this->view->Items = $guestbook->infoItem($this->_arrParam);

    }

    public function editAction()
    {
        $template_path = TEMPLATE_PATH . "/admin/system";
        $this->loadTemplate($template_path, 'template.ini', 'template');

        $guestbook = new Admin_Model_Category();
        $this->view->Items = $guestbook->infoItem($this->_arrParam);

        if ($this->_request->isPost()) {
            $input = $this->_request->getParam('name', '');
            $input2 = $this->_request->getParam('description', '');

            $options = array('table' => 'user', 'field' => 'name', 'description');

            $validator = new Zend_Validate();

            $validator->addValidator(new Zend_Validate_NotEmpty(), true)
                ->addValidator(new Zend_Validate_StringLength(5, 32), true);
            $validator2 = new Zend_Validate();
            $validator2->addValidator(new Zend_Validate_NotEmpty(), true)
                ->addValidator(new Zend_Validate_StringLength(5, 32), true);


            if (!$validator->isValid($input)) {
                $messages = $validator->getMessages();
                echo current($messages) . '</br>';
                if (!$validator2->isValid($input2)) {
                    $messages = $validator2->getMessages();
                    echo current($messages);

                }
            } else {
                $guestbook2 = new Admin_Model_Category();
                $this->view->Items = $guestbook2->editItem($this->_arrParam);
                $this->redirect('/admin/category/index');
            }
        }

    }

    public function deleteAction()
    {
        $template_path = TEMPLATE_PATH . "/admin/system";
        $this->loadTemplate($template_path, 'template.ini', 'template');
        if ($this->_request->isPost()) {
            {
                $guestbook = new Admin_Model_Category();
                $this->view->Items = $guestbook->deleteItem($this->_arrParam);
                $this->redirect('/admin/category/index');
            }

        }


    }
}

