<?php
namespace app\filters;

// define this class as an attribute
#[\Attribute]
class Login implements \app\core\AccessFilter{
	public function execute(){
		if(!isset($_SESSION['user_id'])){
			header('location:/User/index');
			return true; // not enough, we have to tell the router to do something
		}
		return false;
	}
}