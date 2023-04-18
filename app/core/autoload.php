<?php
// it tells how to load the class 
spl_autoload_register(
	function($class_name){
		#app\models\ClassName
		// FOR Linux/unix/macOs compatibility...
		$class_name = str_replace('\\', DIRECTORY_SEPARATOR, $class_name);
		require_once($class_name . '.php');
	} 
);