<?php
namespace app\controllers;

class Main extends \app\core\Controller{

	function index(){
		// echo "This is the Main index";
		$this->view('Main/index');
	}

	function index2(){
		// echo "This is the Main index2";
		$this->view('Main/index2');
	}

	function greetings($name = "miso"){ // optional parameter:$name
		// echo "Haluuuu $name!";
		$this->view('Main/greetings', $name);
	}

	function logUser(){
		if(isset($_POST['action'])) {
			// data is sent 
						// var_dump($_POST);
			// open the log.txt file for appending
			// TODO: lock the file for reserved access
			$fh = fopen('log.txt', 'a');
			fwrite($fh, "$_POST[name] has visited!\n");
			fclose($fh);
			header('location/Main/logUser');

		} else {
			// no data is submitted: the user needs to see the form
			$this->view('Main/logUser');
		}
	}

}