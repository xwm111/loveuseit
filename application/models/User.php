<?php

class Application_Model_User extends Zend_Db_Table_Abstract
{

	protected $_name = 'userinfo';
	
	//获取用户列表
	public function getUserList($where = array(), $order = null, $limit = null)
	{
		$select = $this->select();
		if(count($where) > 0){
			foreach ($where as $key=>$value){
				$select->where($key.' = ?',$value);
			}
		}
		if($order){
			$select->order($order);
		}
		if($limit){
			$select->limit($limit);
		}
		$row = $this->fetchAll($select);
		if($row){
			return $row;
		}else{
			return null;
		}
	}
	
	//获取用户
	public function getUser($where = array())
	{
		$select = $this->select();
		if(count($where) > 0){
			foreach ($where as $key=>$value){
				$select->where($key.' = ?',$value);
			}
		}
		$row = $this->fetchRow($select);
		if($row){
			return $row;
		}else{
			return null;
		}
	}
	
	//创建用户
	public function createUser($userData)
	{
		$row = $this->createRow();
		if(count($userData) > 0 ){
			foreach ($userData as $key=>$value){
				switch ($key){
					case 'password':
						$row->$key = md5($value);
						break;
					default:
						$row->$key = $value;
				}
			}
		date_default_timezone_set('PRC');
		
		$row->regist = date('Y-m-d H:i:s');
		$row->save();
		return $row->id;
		}else{
			return null;
		}
	}
}
