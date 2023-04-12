<?php
namespace app\validators;

use Attribute; // to remove \Attribute
use app\core\Validator;

#[Attribute]
class DateTime implements Validator{ //\app\core\Validator
	public function isValid($data) : bool{
		try {
			new \DateTime($data); // \DateTime to show it is not the same and from another location
			// var_dump($date);
			return true;
		} catch(Exception $e) {
			return false;
		}		
	}
}