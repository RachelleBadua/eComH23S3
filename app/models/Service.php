<?php
namespace app\models;

use app\core\TimeHelper;

class Service extends \app\core\Model{
	public $service_id;
	#[\app\validators\NonEmpty]
	#[\app\validators\NonNull]
	protected $description;
	#[\app\validators\DateTime]
	#[\app\validators\NonNull]
	protected $datetime; // protected to force the execution of __set and __get in Model
	public $client_id;


	// build a setter
	protected function setdatetime($value){
		// $service->datetime = TimeHelper::DTInput($_POST['datetime']); // we want to make it like this
		// in setting change the timezone
		$this->datetime = TimeHelper::DTInput($value);
	}

	protected function setdescription($value){
		// in setting change the timezone
		$this->description = htmlentities($value, ENT_QUOTES);
	}

	// protected so they cannot be access through the controller
	// protected to force execution the execution of __call in Model
	protected function insert(){
		$SQL = "INSERT INTO service (description, datetime, client_id) value (:description, :datetime, :client_id)";
		$STH = self::$connection->prepare($SQL);
		$data = [
					'description'=>$this->description, 
					'datetime'=>$this->datetime,
					'client_id'=>$this->client_id
				];
		$STH->execute($data);
		$this->service_id = self::$connection->lastInsertId();
	}

	protected function update(){
		$SQL = "UPDATE service SET description=:description, datetime=:datetime WHERE service_id=:service_id";
		$STH = self::$connection->prepare($SQL);
		$data = [
					'description'=>$this->description, 
					'datetime'=>$this->datetime,
					'service_id'=>$this->service_id
				];
		$STH->execute($data);
		return $STH->rowCount();
	}


	public function delete(){
		$SQL = "DELETE FROM service WHERE service_id=:service_id"; // :service_id can have a different name but have to be the same in $data
		$STH = self::$connection->prepare($SQL);
		$data = ['service_id'=>$this->service_id];
		$STH->execute($data);
		return $STH->rowCount();
	}

	public function getAllForClient($client_id){
		$SQL = "SELECT * FROM service WHERE client_id=:client_id";
		$STH = self::$connection->prepare($SQL);
		$STH->execute(['client_id'=>$client_id]);
		$STH->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Service');
		return $STH->fetchAll(); // gets the clients from database with an array
	}

	public function get($service_id){
		$SQL = 'SELECT * FROM service WHERE service_id=:service_id';
		$STH = self::$connection->prepare($SQL);
		$STH->execute(['service_id' => $service_id]);
		$STH->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Service');
		return $STH->fetch(); // gets the client specified from database with an array
	}

	public function getClient(){
		$SQL = "SELECT * FROM client WHERE client_id=:client_id";
		$STH = self::$connection->prepare($SQL);
		$STH-> execute(['client_id'=>$this->client_id]);
		$STH->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Client');
		return $STH->fetch();
	}
}