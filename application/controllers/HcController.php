<?php
//Hotline Counseling  客服管理
class HcController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    //返回json
    public function jsonAction()
    {
    	$data = '{\'xwm\':123}';
    	$this->_helper->json($data,true,false,true);
    }
    
    // 显示所有客服列表
    public function indexAction()
    {
    	
        $user = new Application_Model_User();
        $userlist = $user->getUserList();
        $this->view->userlist = $userlist;
    }
    //增加
    public function addhcAction()
    {
    	$user = new Application_Model_User();
    	$formhc = new Application_Form_Hc();
    	$formhc->isValid($_POST);
    	$userData = $formhc->getValues();
    	$user->createUser($userData);
    	$this->redirect('/hc');
    	
    }

    //增加
    public function paddAction()
    {
        $formAdd =  new Application_Form_Hc();
        $this->view->formAdd = $formAdd;
    }


}



