<?php
namespace app\models;

class User extends \app\core\Model{
	public $user_id;
	public $username;
	public $password_hash;
	public $secret_key;

	public function getByUsername($username){
		$SQL = 'SELECT * FROM User WHERE username = :username';
		$STH = self::$connection->prepare($SQL);

		$STH->execute(['username'=>$username]);
		$STH->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\User');
		return $STH->fetch();
	}

	public function insert(){
		$SQL = 'INSERT INTO User(username, password_hash) VALUES (:username, :password_hash)';
		$STH = self::$connection->prepare($SQL);

		$STH->execute(['username'=>$this->username,
						'password_hash'=>$this->password_hash]);
		//$STH->setFetchMode(\PDO::FETCH_CLASS, 'app\\models\\User');
		return self::$connection->lastInsertId(); // return the value of the new PK
	}

	public function update2fa() {
		$SQL = 'UPDATE User SET secret_key=:secret_key WHERE user_id=:user_id';
		$STH = self::$connection->prepare($SQL);
		$data = [
			'secret_key'=>$this->secret_key,
			'user_id'=>$this->user_id
		];
		$STH->execute($data);
		return $STH->rowCount();

	}
}