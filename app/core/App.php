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

		// it gets/checks if the class in the controller and a method exists
		if(isset($request[1]) && method_exists($controller, $request[1])){
			$method = $request[1];
			//remove the request[1] element
			unset($request[1]);
		}

		$params = array_values($request);

		// before we want to let user have access, have filtering 
		// This is the right place for access filtering  
		if($this->filter($controller, $method, $params))
			return;  // deny access to method call
		
												//$controller->index(); // this is to test if the method works 

												// improve this to include parameters
												//$controller->$method();
		// Call the controller method with paramters, it directs to the method in the Main class.
		call_user_func_array([$controller, $method], $params);
	}

	public function filter($controller, $method, $params){
		// we want to read the class and method attributes
		// build the reflection object to read the methods, properties, attruibutes
		$reflection = new \ReflectionObject($controller);
		$classAttributes = $reflection->getAttributes(
			\app\core\AccessFilter::class, // base class
			\ReflectionAttribute::IS_INSTANCEOF // checking if it is an instance
		);
		$methodAttributes = $reflection->getMethod($method)->getAttributes(
			\app\core\AccessFilter::class,
			\ReflectionAttribute::IS_INSTANCEOF
		);
		$attributes = array_values(array_merge($classAttributes, $methodAttributes)); // putting all attributes in one single list
		// run through all the conditions
		foreach ($attributes as $attribute) {
			// for an attribute, get the class instance (object)
		 	// take the attiribute and the take the instance of a class and then use it
			$filter = $attribute->newInstance();
			if($filter->execute())
				return true;
		}
		return false; 
	}

	function parseUrl($url) {
		return explode('/', trim($url, '/'));
	}
}