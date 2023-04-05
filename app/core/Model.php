<?php 
namespace app\core;

use PDO;

class Model{
	// ?PDO is for nullables
	public static ?PDO $connection = null;
	public function __construct(){

		if (self::$connection == null){

			// this is supposed to load the .env file from the given folder
			// put a .env in the parameter
			$env = \Dotenv\Dotenv::createImmutable(getcwd());
			// var_dump($env); // to check if it works
			// need to add autoload of the composer
			$env->load();
			$env->required(['db_host','db_user','db_pass','db_name','db_charset']);//->notEmpty();
			$host = $_ENV['db_host'];
			$dbname = $_ENV['db_name'];
			$user = $_ENV['db_user'];
			$pass = $_ENV['db_pass'];			
			$charset =$_ENV['db_charset'];
			try {
				$options = [
					PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
					PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_CLASS,
					PDO::ATTR_EMULATE_PREPARES => false
				];
			 # MySQL with PDO_MYSQL
			 	// $DBH = new \PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
			 	// self::$connection = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
			 	self::$connection = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $user, $pass, $options);
			 	self::$connection->query("SET NAMES $charset");

			}
			catch(PDOException $e) {
				echo $e->getMessage();
			}
		}
	}
}