<?php
namespace app\core;

class App {

	function __construct() {
		// this is where we want to route the requests to the appropriate classes/methods 
												//echo 'The constuctor for the App class has been called';
												//echo $_GET['url'] ?? 'No url provided<br>';

		// we wish to route requests to /controller/method
		$request = $this->parseUrl($_GET['url'] ?? '');
												//var_dump($request); // this is to method_exists

		// default controller and method, will go here
		$controller = 'Main';
		$method = 'index';
		$params = [];

		// is the requested controller in controllers folder?
		if(file_exists('app/controllers/' . $request[0] . '.php')) 
		{
			//echo "The $request[0] controller exixts"; this is just to check if the method worked
			$controller = $request[0];

			//$controller = new Main();

			//remove the $request[0] element
			unset($request[0]);
		}
		$controller = 'app\\controllers\\' . $controller;
		$controller = new $controller;

		// it gets the class in the controller and a method
		if(isset($request[1]) && method_exists($controller, $request[1])){
			$method = $request[1];
			//remove the request[1] element
			unset($request[1]);
		}

		$params = array_values($request);
		
												//$controller->index(); // this is to test if the method works 

												// improve this to include parameters
												//$controller->$method();
		// Call the controller method with paramters
		call_user_func_array([$controller, $method], $params);
	}

	function parseUrl($url) {
		return explode('/', trim($url, '/'));
	}
}