<?php
namespace app\filters;

class verify2fa implements \app\core\AccessFilter(){
	public function execute(){
		if(isset(!$_SESSION['secret_key'] && !empty($_SESSION['secret_key']))){
			header('location:/User/setup2fa');
		}
	}
}