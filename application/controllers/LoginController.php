<?php

class LoginController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    	//采用login的layout
    	$this->_helper->layout()->setLayout('login');
    }

    public function indexAction()
    {
       $formlogin = new Application_Form_Hc();
       $formlogin->removeElement('mobile');
       
       if($this->getRequest()->isPost()){
           if($formlogin->isValid($_POST)){
			  $data = $formlogin->getValues();
			  //取得默认数据库适配器
			  $db = Zend_Db_Table::getDefaultAdapter();
			  //实例化一个auth适配器
			  $authAdapter = new Zend_Auth_Adapter_DbTable($db,'userinfo','username','password');
			  //设置用户名 密码
			  $authAdapter->setIdentity($data['username']);
			  $authAdapter->setCredential(md5($data['password']));
			  //认证
			  $result = $authAdapter->authenticate();
			  if($result->isValid()){
			  	$auth = Zend_Auth::getInstance();
			  	//存储用户信息
			  	$storge = $auth->getStorage();
			  	$storge->write($authAdapter->getResultRowObject(
			  			array('id','username','role')
			  			));
			  }
           	$this->_redirect('/login/panel');
           }else{
           	$this->view->loginMessage="用户名或者密码不符合";
           }
       }
       
       
       $this->view->formlogin = $formlogin;
    }

    public function panelAction()
    {
        $auth = Zend_Auth::getInstance();
        if($auth->hasIdentity()){
        	$this->view->identity = $auth->getIdentity();
        }
    }


}



