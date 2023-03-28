<?php 
namespace app\core;

use PDO;

class Model{
	// ?PDO is for nullables
	public static ?PDO $connection = null;
	public function __construct(){

		if (self::$connection == null){
			$host = 'localhost';
			$dbname = 'webapplication';
			$user = 'root';
			$pass = '';
			$charset ='utf8mb4';
			try {
			 # MySQL with PDO_MYSQL
			 	// $DBH = new \PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
			 	// self::$connection = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
			 	self::$connection = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $user, $pass);
			 	self::$connection->query("SET NAMES $charset");

			}
			catch(PDOException $e) {
				echo $e->getMessage();
			}
		}
	}
}