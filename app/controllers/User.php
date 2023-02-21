<?php
namespace app\controllers;

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

	public function profile(){
		// secure place
		if(!isset($_SESSION['user_id'])){
			header('location:/User/index');
			return;
		}
		$message = new \app\models\Message();
		$messages = $message->getAllForUser($_SESSION['user_id']);
		$this->view('User/profile', $messages);
	}

	public function sendMessage(){
		if(isset($_POST['action'])){
			$receiver = $_POST['receiver'] ?? '';
			$user = new \app\models\User();
			$user = $user->getByUsername($receiver);
			if($user){
				$message = new \app\models\Message();
				$message->receiver = $user->user_id; // set the FK to a PK value
				$message->sender = $_SESSION['user_id'];
				$message->message = $_POST['message'];
				$message->insert();
			}else{
				header('location:/User/profile?error=' . "$receiver is not a valid user. No message sent.");
			}
		}
			header('locaiton:/User/profile');
	}
}