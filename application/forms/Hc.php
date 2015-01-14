<?php

class Application_Form_Hc extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
    	$this->setMethod('post');
    	$userName = $this->createElement('text', 'username');
    	$userName->setLabel('用户：');
    	$userName->setRequired(TRUE);
    	$userName->addValidator('stringLength',false,array(5,20));
    	$userName->addErrorMessage('用户名要求英文5-20个字母或2-6个汉字');
    	$this->addElement($userName);
    	
    	
    	$password = $this->createElement('password', 'password');
    	$password->setLabel('密码：');
    	$password->setRequired(TRUE);
    	$this->addElement($password);
    	
    	$mobile = $this->createElement('text', 'mobile');
    	$mobile->setLabel('电话：');
    	$mobile->setRequired(TRUE);
    	$mobile->addValidator('stringLength',false,array(13));
    	$mobile->addErrorMessage('电话号码要求13位');
    	$this->addElement($mobile);
    	
    	$submit = $this->createElement('submit', '提交');
    	$this->addElement($submit);
    }


}

