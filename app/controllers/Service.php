<?php 
namespace app\controllers;

// use DateTime;
// use IntlDateFormatter;
use \app\core\TimeHelper;

class Service extends \app\core\Controller{ // parent id
	public function index($client_id){
		$client = new \app\models\Client();
		$client = $client->get($client_id);
		// plan: get the service records from that client
		$this->view('Service/index', $client);
	}

	public function create($client_id){ // parent id

		if(isset($_POST['action'])){
			// make new service
			$service = new \app\models\Service();

			// populate the service
			$service->description = htmlentities($_POST['description']);
			$service->datetime = TimeHepler::DTInput($_POST['datetime']);
			$service->client_id = $client_id;

			// invoke the insert method
			$service->insert();

			//back to the list of clients
			header('location:/Service/index/'.$client_id);
		}else{
			$client = new \app\models\Client();
			$client = $client->get($client_id);
			$this->view('Service/create', $client);
		}
	}

	public function delete($service_id){ // PK value
		$service = new \app\models\Service();
		$service = $service->get($service_id); //get id
		// $client = $service->getClient(); // do this in the view
		if(isset($_POST['action'])){
			// proceed with deletion
			$client_id = $service->client_id;
			$service->delete(); // deletes
			header('location:/Client/index/'.$client_id);
		} else {
			$this->view('Service/delete', $service);
		}
	}

	public function edit($service_id){
		// modify a client record
		$service = new \app\models\Service();
		$service = $service->get($service_id);
	

		// form is submitted
		if(isset($_POST['action'])){
			// TODO: save the data
			$service->description = htmlentities($_POST['description']);
			$service->datetime = TimeHepler::DTInput($_POST['datetime']);
			// we do not change key values

			// save the changes to the database
			$service->update();
			$client_id = $service->client_id;
			header('location:/Service/index/'.$client_id);
		}else {
			$this->view('Service/edit', $service);
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