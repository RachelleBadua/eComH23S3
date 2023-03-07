<?php
namespace app\controllers;

// These are class attributes, define on top on the class 
class User extends \app\core\Controller{

	// login page
	public function index(){
		if(isset($_POST['action'])){
			// process the input
			$user = new \app\models\User();
			$user = $user->getByUsername($_POST['username']);
			if($user){
				if(password_verify($_POST['password'], $user->password_hash)){
					// the user is correct!
					// user can login
					$_SESSION['user_id'] = $user->user_id;
					header('location:/User/profile');
				}else{
					// the user is no correct
					header('location:/User/index?error=Bad username/password combination');
				}
			}else{
				// no such user so redirect
				header('location:/User/index?error=Bad username/password combination');
			}
		}else{
			$this->view('User/index'); 		
		}
	}

	// registration page
	public function register(){
		if(isset($_POST['action'])){
			// process the input
			$user = new \app\models\User();
			$usercheck = $user->getByUsername($_POST['username']);
			if(!$usercheck){
				$user->username = $_POST['username'];
				// making the password a hash and stores it in password_hash
				$user->password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT); 
				$user->insert();
				header('location:/User/index');
			}else{
				header('location:/User/register?error=Username ' . $_POST['username'] . ' already in use. Choose another.');
			}
		}else{
			// display the form
			$this->view('User/register'); // TODO: add the new view file
		}
	}

	public function logout(){
		session_destroy();
		header('location:/User/index');
	}

	#[\app\filters\Login]
	public function profile(){
		// secure place
		// if(!isset($_SESSION['user_id'])){
		// 	header('location:/User/index');
		// 	return;
		// } // adding this code in the app\filters\Login file
		$message = new \app\models\Message();
		$messages = $message->getAllForUser($_SESSION['user_id']);
		$this->view('User/profile', $messages);
	}

	#[\app\filters\Login]
	public function somethingSecret(){
		echo "If you see this then you are logged in";
	}
}