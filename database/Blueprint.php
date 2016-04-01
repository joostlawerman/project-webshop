<?php

namespace App\Les18;

class Blueprint {

	protected $line;

	public function integer($name, $lenght = 30) {
		return new BlueprintFactory("$name INT($length)");
	}
	public function varchar($name, $length = 256) {
		return new BlueprintFactory("$name INT($length)");
	}
	public function double($name, $length = 256) {
		return new BlueprintFactory("$name DOUBLE($length)");
	}
	public function timestamp($name, $length = 256) {
		return new BlueprintFactory("$name TIMESTAMP($length)");
	}
	public function increments($name, $length = 30) {
		return new BlueprintFactory("$name INT($length) AUTO_INCREMENT");
	}
}
