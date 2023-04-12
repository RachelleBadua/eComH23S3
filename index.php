<?php

//entry point to the application
//include the dependencies
require_once 'app/core/init.php';
//to include external files in PHP we can use 
//include, include_once, require, and require_once

// require is for stuff you need 
// inlcude can be less fatal
//_once is to ensure things only are included once

// try {
// 	new DateTime('2024/01/32');
// 	// var_dump($date);
// 	return true;
// } catch(Exception $e) {
// 	echo "bad thing happened: $e";
// }



new app\core\App;