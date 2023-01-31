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

}