<?php
namespace app\core;

class Controller {

	// including a file so it can be displayed on the end user, so it can be outputted.
	function view($name, $data = []){
		include('app/views/' . $name  . '.php');
	}

}