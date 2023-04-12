<?php 
namespace app\core;

use PDO;
use ReflectionClass;

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

	public function isValid() : bool{
		// the goal of this function is to validate the data
		$reflection = new ReflectionClass($this);
		$properties = $reflection->getProperties();
		foreach ($properties as $property) {
			$attributes = $property->getAttributes(
				\app\core\Validator::class,
				\ReflectionAttribute::IS_INSTANCEOF
			); // go through property to get attributes
			$data = $property->getValue($this);
			foreach ($attributes as $attribute) {
				// create an object od that validator class
				$validator = $attribute->newInstance();
				// run the validation method on the data in the property
				if (!$validator->isValid($data)) 
					return false; // return false otherwise
			}
		}
		return true; // return true if all the data is valid
	}


	// triggered when invoking inaccessibe methods
	public function __call($method, $arguments){
		if ($this->isValid()) {
			call_user_func_array([$this, $method], $arguments);

			// $this->method(...$arguments);
			// $this->method($arguments[0], $arguments[1]); 
			// can use this too 
		}
		// echo $method;
		// die();
	}

	public function __set($name, $value){
		$method = "set$name"; 
		if(method_exists($this, $method)){
			$this->$method($value);
		}
		// echo "$name => $value"; // this is setting the value to the object
		// die();	
	}

	public function __get($name){
		if (isset($this->$name)) // this checks the value it is getting
			return $this->$name; 
		else 
			return '';
	}
}