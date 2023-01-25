<?php

class App {

	function __construct() {
		// this is where we want to route the requests to the appropriate classes/methods 
		//echo 'The constuctor for the App class has been called';

		echo $_GET['url'] ?? 'No url provided<br>';

		$request = $this->parseUrl($_GET['url'] ?? '');

		var_dump($request);
	}

	function parseUrl($url) {
		return explode('/', $url);
	}
}