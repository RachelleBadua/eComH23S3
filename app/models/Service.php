<?php
namespace app\models;

class Service extends \app\core\Model{
	public $service_id;
	public $description;
	public $datetime;
	public $client_id;

	public function insert(){
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

	public function update(){
		$SQL = "UPDTE service SET description=:description, datetime=:datetime, client_id=:client_id WHERE service_id=:service_id";
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
		$data = ['service_id'=>$service_id];
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