<?php
namespace app\core;

interface Validator{
	public function isValid($data) : bool; // should return true for valid data
}