<?php
class Zendvn_Plugin_Permission extends Zend_Controller_Plugin_Abstract{
 
	public function preDispatch(Zend_Controller_Request_Abstract $request){
		//echo '<br>' . __METHOD__;
		
		
		$auth = Zend_Auth::getInstance();
		
		$moduleName = $this->_request->getModuleName();
		$controllerName  = $this->_request->getControllerName();
		
		if($moduleName != 'training'){
			//----------START-KIEM TRA QUYEN TRUY CAP VAO ADMIN -------------
			$flagAdmin = false;
			if($controllerName == 'admin'){
				$flagAdmin = true;
			}else{
				$tmp = explode('-',$controllerName);
				if($tmp[0] == 'admin'){
					$flagAdmin = true;
				}
			}
			
			$flagPage = 'none';
			if($flagAdmin == true){
				if($auth->hasIdentity() == false){
					$flagPage = 'login';
				}else{
					$info = new Zendvn_System_Info();
					$group_acp = $info->getGroupInfo('group_acp');
					if($group_acp != 1){
						$flagPage = 'no-access';
					}else{
						$permission  = $info->getGroupInfo('permission');
						if($permission != 'Full Access'){
							$aclInfo  = $info->getAclInfo();
							$acl = new Zendvn_System_Acl($aclInfo);
							$arrParam = $this->_request->getParams();
							if($acl->isAllowed($arrParam) == false){
								$flagPage = 'no-access';
							}
						}
						
					}
				}
			}
			
			//----------END-KIEM TRA QUYEN TRUY CAP VAO ADMIN -------------
			//echo '<br>' . $flagPage;
			if($flagPage != 'none'){
				if($flagPage == 'login'){
					$this->_request->setModuleName('default');
					$this->_request->setControllerName('public');
					$this->_request->setActionName('login');
				}
				
				if($flagPage == 'no-access'){
					$this->_request->setModuleName('default');
					$this->_request->setControllerName('public');
					$this->_request->setActionName('no-access');
				}
			}
		}
    }
}

