<?php

/**
 * 权限控制插件
 * @author xuweiming
 *
 */

class xwm_Controller_Plugin_Acl extends Zend_Controller_Plugin_Abstract
{
	public function preDispatch(Zend_Controller_Request_Abstract $request)
	{
		$acl = new Zend_Acl();
		//添加角色
		$acl->addRole('guest');
		$acl->addRole('user','guest');
		$acl->addRole('admin','user');
		$acl->addResource('hc');
		$acl->addResource('index');
		$acl->addResource('login');
		
		//匿名用户权限
		$acl->deny('guest',null,null);
		$acl->allow('guest',array('login','hc'),array('index'));
		$acl->allow('guest','hc','padd');
		
		//客服权限
		//todo
		//经销商权限
		
		//管理员权限
		$acl->allow('admin',null,null);
		
		//当前用户
		$auth = Zend_Auth::getInstance();
		if($auth->hasIdentity()){
			$identity = $auth->getIdentity();
			$role = strtolower($identity->role);
		}else{
			$role = 'guest';
		}
		/*测试时开放所有
		$controller = $request->getControllerName();
		$action = $request->getActionName();
		try {
			if(!$acl->isAllowed($role,$controller,$action)){
				if($role == 'guest'){
					$request->setControllerName('login');
					$request->setActionName('index');
				}else{
					$request->setControllerName('error');
					$request->setActionName('error');
				}
			}
		}catch (Exception $e) {   
			$request->setControllerName('error');
			$request->setActionName('pagenotfound');
		}
		*/
	}
}