<?php
namespace app\models;

class Branch extends \app\core\Model{
	public $branch_id;
	public $name;
	public $street;
	public $city;
	public $postal;
	public $province;

	public function getAll(){
		$SQL = "SELECT * FROM branch";
		$STH = self::$connection->prepare($SQL);
		$STH->execute();
		$STH->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\Branch');
		return $STH->fetchAll(); // gets the branches from database with an array
	}

}