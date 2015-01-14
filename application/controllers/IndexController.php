<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

	
    public function trydbAction(){
    	$usermodel = new Application_Model_User();
    	$username = array("username"=>"admin");
    	$users = $usermodel->getUser($username);
    	$this->view->users = $users;
    }
}

