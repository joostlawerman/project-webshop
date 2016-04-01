<?php

namespace App\Core\Gate;

class Gate {
	public static function check($name) {
		$gates = include __projectRoot__."/app/Gates.php";
	}
}