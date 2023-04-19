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
					$_SESSION['username'] = $user->username;
					$_SESSION['secret_key'] = $user->secret_key;
					// $this->view('location:/User/setup2fa');

					if(!$user->secret_key){
						header('location:/User/profile?error=Your Account is not safe, please make your 2 factor authentication');
					} else {
						header('location:/User/profile');
					}
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

	// Use: /Default/makeQRCode?data=protoco://address
	public function makeQRCode(){
		$data = $_GET['data'];
		\QRCOde::png($data);
	}

	#[\app\filters\Login]
	public function setup2fa(){
		if(isset($_POST['action'])) {
			$currentcode = $_POST['currentCode'];
			if(\app\core\TokenAuth6238::verify(
				$_SESSION['secretkey'], $currentcode)) {
				// the user has verified their proper 2-factor authentication setup
				$user = new \app\models\User();
				$user->user_id = $_SESSION['user_id'];
				$user->secret_key = $_SESSION['secretkey'];
				$user->update2fa();
				header('location:/setup2fa?success=Authentication works');
			} else {
				header('location:/User/setup2fa?error=token not verrified!'); // reload
			}
		} else {
			$secretkey = \app\core\TokenAuth6238::generateRandomClue();
			$_SESSION['secretkey'] = $secretkey; 
			$url = \app\core\TokenAuth6238::getLocalCodeUrl(
				$_SESSION['username'],
				'Awesome.com',
				$secretkey,
				'Awesome App');
			$this->view('User/twofasetup', $url);
		}
	}

	#[\app\filters\Login]
	public function verify2fa(){
		if(isset($_POST['action'])) {
			$currentcode = $_POST['currentCode'];
			if(\app\core\TokenAuth6238::verify(
				$_SESSION['secretkey'], $currentcode)) {
				// the user has verified their proper 2-factor authentication setup
				$user = new \app\models\User();
				$user->user_id = $_SESSION['user_id'];
				$user->secret_key = $_SESSION['secretkey'];
				$user->update2fa();
				header('location:/User/?success=Authentication works');
			} else {
				header('location:/User/setup2fa?error=Wrong token or empty token'); // reload
			}

	}
}