<?php
namespace app\models;

class Client extends \app\core\Model{
	public $client_id;
	public $first_name;
	public $last_name;
	public $middle_name;

	public function insert(){
		$SQL = "INSERT INTO client (first_name, last_name, middle_name) value (:first_name, :last_name, :middle_name)";
		$STH = self::$connection->prepare($SQL);
		$data = ['first_name'=>$this->first_name, 
					'last_name'=>$this->last_name,
					'middle_name'=>$this->middle_name];
		$STH->execute($data);

		$this->client_id = self::$connection->lastInsertId();
	}

	public function update(){
		$SQL = "UPDTE client SET first_name=:first_name, last_name=:last_name, middle_name=:middle_name WHERE client_id=:client_id";
		$STH = self::$connection->prepare($SQL);
		$data = [
					'first_name'=>$this->first_name, 
					'last_name'=>$this->last_name,
					'middle_name'=>$this->middle_name,
					'client_id' =>$this->client_id
				];
		$STH->execute($data);
		return $STH->rowCount();
	}


	public function delete($client_id){
		$SQL = "DELETE FROM client WHERE client_id=:client_id"; // :client_id can have a different name but have to be the same in $data
		$STH = self::$connection->prepare($SQL);
		$data = ['client_id'=>$client_id];
		$STH->execute($data);
	}

	public function getAll(){
		$SQL = "SELECT * FROM client";
		$STH = self::$connection->prepare($SQL);
		$STH->execute();
		$STH->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Client');
		return $STH->fetchAll(); // gets the clients from database with an array
	}

	public function get($client_id){
		$SQL = 'SELECT * FROM client WHERE client_id=:client_id';
		$STH = self::$connection->prepare($SQL);
		$STH->execute(['client_id' => $client_id]);
		$STH->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Client');
		return $STH->fetch(); // gets the client specified from database with an array
	}

	// return service records for this client $services = client->getServices
	public function getServices(){
		$SQL = "SELECT * FROM service WHERE client_id=:client_id";
		$STH = self::$connection->prepare($SQL);
		$STH->execute(['client_id'=>$this->client_id]);
		$STH->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Sercvice');
		return $STH->fetchAll(); // gets the clients from database with an array
	}
}