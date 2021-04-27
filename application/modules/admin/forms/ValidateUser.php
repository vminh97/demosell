<?php
class Admin_Form_ValidateUser{
	
	//CHUA NHUNG THONG BAO LOI CUA FORM
	protected $_messagesError = null;
	
	//MANG CHUA DU LIEU SAU KHI KIEM TRA
	protected $_arrData;
	
	public function __construct($arrParam = array(),$options = null){
		echo '<pre>';
		print_r($arrParam);
		echo '</pre>';
		//========================================
		// KIEM TRA user_name
		//========================================
		
		if($arrParam['action'] == 'add'){
			$options = array('table'=>'user','field'=>'user_name');
        }
        else if($arrParam['action'] == 'edit'){
			$clause = ' id !=' . $arrParam['id'];
			$options = array('table'=>'user','field'=>'user_name','exclude'=>$clause);
		}
		
		$validator = new Zend_Validate();
		
		
		$validator->addValidator(new Zend_Validate_NotEmpty(),true)
				  ->addValidator(new Zend_Validate_StringLength(3,32),true)
				  ->addValidator(new Zend_Validate_Regex('#^[a-zA-Z0-9\-_\.\s]+$#'),true)
				  ->addValidator(new Zend_Validate_Db_NoRecordExists($options),true);
		if(!$validator->isValid($arrParam['user_name'])){
			$message = $validator->getMessages();
			$this->_messagesError['user_name'] = 'User name: ' . current($message);
			$arrParam['user_name'] = '';
		}		

		//========================================
		// KIEM TRA user_avatar
		//========================================
		$upload = new Zend_File_Transfer_Adapter_Http();
		$fileInfo = $upload->getFileInfo('avatar');
		$fileName = $fileInfo['avatar']['name'];
		
		if(!empty($fileName)){
		
			$upload->addValidator('Extension',true,array('jpg','gif','png'),'avatar');
			$upload->addValidator('Size',true,array('min'=>'2KB','max'=>'1000KB'),'avatar');
			if(!$upload->isValid('avatar')){
				$message = $upload->getMessages();
				$this->_messagesError['avatar'] = 'Avatar: ' . current($message);
				
			}
		}
		
		//========================================
		// KIEM TRA password
		//========================================
		
		$flag = false;
		if($arrParam['action']== 'add'){
			$flag = true;
		}else if($arrParam['action']== 'edit'){
			if(!empty($arrParam['password'])){
				$flag = true;
			}
		}
		
		if($flag == true){
			$validator = new Zend_Validate();
			$validator->addValidator(new Zend_Validate_NotEmpty(),true)
					  ->addValidator(new Zend_Validate_StringLength(3,32),true)
					  ->addValidator(new Zend_Validate_Regex('#^[a-zA-Z0-9@\#\$%\^&\*\-\+]+$#'),true);
			if(!$validator->isValid($arrParam['password'])){
				$message = $validator->getMessages();
				$this->_messagesError['password'] = 'Password: ' . current($message);
			}	
		}
		//========================================
		// KIEM TRA email
		//========================================
		
		if($arrParam['action'] == 'add'){
			$options = array('table'=>'users','field'=>'email');
		}else if($arrParam['action'] == 'edit'){
			$clause = ' id !=' . $arrParam['id'];
			$options = array('table'=>'users','field'=>'email','exclude'=>$clause);
		}
		
		$validator = new Zend_Validate();
		
		$validator->addValidator(new Zend_Validate_NotEmpty(),true)
				  ->addValidator(new Zend_Validate_EmailAddress(),true)
				  ->addValidator(new Zend_Validate_Db_NoRecordExists($options),true);
		if(!$validator->isValid($arrParam['email'])){
			$message = $validator->getMessages();
			$this->_messagesError['email'] = 'Email: ' . current($message);
			$arrParam['email'] = '';
		}

		//========================================
		// KIEM TRA group_id
		//========================================
		if($arrParam['group_id'] == 0){
			$this->_messagesError['group_id'] = 'Group: Please select a group';
		}
		
		//========================================
		// KIEM TRA first_name
		//========================================
		
		$validator = new Zend_Validate();
		$validator->addValidator(new Zend_Validate_NotEmpty(),true)
				  ->addValidator(new Zend_Validate_StringLength(2),true);
		if(!$validator->isValid($arrParam['first_name'])){
			$message = $validator->getMessages();
			$this->_messagesError['first_name'] = 'First name: ' . current($message);
			$arrParam['first_name'] = '';
		}	
		
		//========================================
		// KIEM TRA last_name
		//========================================
		
		$validator = new Zend_Validate();
		$validator->addValidator(new Zend_Validate_NotEmpty(),true)
				  ->addValidator(new Zend_Validate_StringLength(2),true);
		if(!$validator->isValid($arrParam['last_name'])){
			$message = $validator->getMessages();
			$this->_messagesError['last_name'] = 'Last name: ' . current($message);
			$arrParam['last_name'] = '';
		}	
		
		//========================================
		// KIEM TRA birthday
		//========================================
		$validator = new Zend_Validate();
		$validator->addValidator(new Zend_Validate_NotEmpty(),true)
				 ->addValidator(new Zend_Validate_Date(array('format'=>'YYYY-mm-dd')),true);
		if(!$validator->isValid($arrParam['birthday'])){
			$message = $validator->getMessages();
			$this->_messagesError['birthday'] = 'Birthday: ' . current($message);
			$arrParam['birthday'] = '';
		}		

		//========================================
		// KIEM TRA status
		//========================================
		if(empty($arrParam['status']) || !isset($arrParam['status'])){
			$arrParam['status'] = 0;
		}
		
		//========================================
		// KIEM TRA sign
		//========================================
		$validator = new Zend_Validate();
		$validator->addValidator(new Zend_Validate_NotEmpty(),true)
				  ->addValidator(new Zend_Validate_StringLength(10),true);
		if(!$validator->isValid($arrParam['sign'])){
			$message = $validator->getMessages();
			$this->_messagesError['sign'] = 'Sign: ' . current($message);
			$arrParam['sign'] = '';
		}	
		
		//========================================
		// TRUYEN CAC GIA TRI DUNG VAO MANG $_arrData
		//========================================
		$this->_arrData = $arrParam;
	}
	
	//Kiem tra Error 
	//return true neu co loi xuat hien
	public function isError(){		
		if(count($this->_messagesError)>0){
			return true;
		}else{
			return false;
		}
	}
	
	//Tra ve mot mang cac loi
	public function getMessageError(){
		return $this->_messagesError;
	}
	//Tra ve 1 mang du lieu sau khi kiem tra
	public function getData(){
		return $this->_messagesError;
	}
	


	
	
	
}