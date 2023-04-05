<?php 
namespace app\controllers;

use DateTime;
use IntlDateFormatter;
use \app\core\TimeHepler;

class Client extends \app\core\Controller{
	public function index(){
		$client = new \app\models\Client();
		$clients = $client->getAll();
		$this->view('Client/index', $clients);
	}

	public function create(){
		if(isset($_POST['action'])){
			// make new client
			$client = new \app\models\Client();

			// populate the client
			$client->first_name = $_POST['first_name'];
			$client->last_name = $_POST['last_name'];
			$client->middle_name = $_POST['middle_name'];

			// invoke the insert method
			$client->insert();

			//back to the list of clients
			header('location:/Client/index');
		}else{
			$this->view('Client/create');
		}
	}

	public function delete($client_id){
		$client = new \app\models\Client();
		$client->delete($client_id); // deletes
		header('location:/Client/index');
	}

	public function edit($client_id){
		// modify a client record
		$client = new \app\models\Client();
		$client = $client->get($client_id);

		// form is submitted
		if(isset($_POST['action'])){
			// TODO: save the data
			$client->first_name = $_POST['first_name'];
			$client->last_name = $_POST['last_name'];
			$client->middle_name = $_POST['middle_name'];
			// save the changes to the database
			$client->update();
			header('location:/Client/index');
		}else {
			$this->view('Client/edit', $client);
		}
	}

	public function date(){
		// $date = new DateTime();

		//TODO: get the user timezone choice (get this from the browser) 
		$date = new DateTime('Tuesday, April 5, 2023, 15:23:01');
		global $lang;
		echo TimeHepler::DTOutput($date,$lang,'America/Toronto');

		// echo $date->format('l, F j, Y, G:i:s');
		// global $lang;
		// echo $lang;
		// $fmt = new IntlDateFormatter(
		// 	$lang,
		// 	// IntlDateFormatter::LONG, // IntlDateFormatter::MEDIUM, // IntlDateFormatter::SHORT
		// 	IntlDateFormatter::MEDIUM, // date format
		// 	IntlDateFormatter::SHORT // time format
		// );
		// echo '<br>', $fmt->format($date);
	}
}