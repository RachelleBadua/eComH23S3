<?php

// classes
class Person{
	public $firstName;
	public $lastName;
	protected $age;
	protected $weight;
	private static $count = 0; // static is tied to the class, not the object

	function __construct($firstName, $lastName, $age, $weight){
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->age = $age;
		$this->weight = $weight;

		//wrong
		//$this->count++;
		self::$count++;  // self refers to class object
	}	

	function __toString(){
		return "$this->firstName $this->lastName is $this->age and weighs 
			in at $this->weight pounds.<br>";
	}

	public static function count() {
		//wrong
		// return $this-> count;
		return self::$count;
	}
}

echo "There are ", Person::count(), " people in the program.<br>";  

$person = new Person('Rachelle', 'Badua', 19, 115);

echo $person;

//wrong
//echo $person->count();
echo "There are ", Person::count(), (Person::count()==1?" person" : " people"), " in the program.<br>";


class Pugilist extends Person{
	public function fight($other)
	{
		return ($this->weight > $other->weight ? $this : $other);
	}
}

$pugilist1 = new Pugilist('Mubeen', 'Bing Chilling', 21, 150);
$pugilist2 = new Pugilist('Mert', 'raspberry Pie', 18, 160);

$winner = $pugilist1->fight($pugilist2);

echo "The winner is $winner";
