<?php
namespace app\models;

class ProfileInformation extends \app\core\Model{
	public $user_id;
	public $first_name;
	public $last_name;
	public $middle_name;
	public $picture;

	public function getByUserId($user_id){
		$SQL = "SELECT * FROM profile_information WHERE user_id=:user_id"; // : is a place holder to use in execute method so that u can put the value from $user_id
		$STH = self::$connection->prepare($SQL);
		$STH->execute(['user_id'=>$user_id]);	
		$STH->setFetchMode(\PDO::FETCH_CLASS,'app\\models\\ProfileInformation');
		return $STH->fetch();
	}

	public function insert(){
		$SQL = "INSERT INTO profile_information(user_id,first_name,last_name,middle_name,picture) VALUE (:user_id,:first_name,:last_name,:middle_name,:picture)"; // : is a place holder to use in execute method so that u can put the value from $user_id
		$STH = self::$connection->prepare($SQL);
		$data = ['user_id'=>$this->user_id,
				'first_name'=>$this->first_name,
				'last_name'=>$this->last_name,
				'middle_name'=>$this->middle_name,
				'picture'=>$this->picture];
		$STH->execute($data);
		return $STH->rowCount();	
	}

	public function update(){
		$SQL = "UPDATE `profile_information` SET `first_name`=:first_name,`last_name`=:last_name,`middle_name`=:middle_name, `picture`=:picture WHERE user_id=:user_id"; // : is a place holder to use in execute method so that u can put the value from $user_id
		$STH = self::$connection->prepare($SQL);
		$data = ['user_id'=>$this->user_id,
				'first_name'=>$this->first_name,
				'last_name'=>$this->last_name,
				'middle_name'=>$this->middle_name,
			    'picture'=>$this->picture];
		$STH->execute($data);
		return $STH->rowCount();	
	}
}