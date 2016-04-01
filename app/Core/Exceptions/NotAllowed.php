<?php

namespace App\Core\Exceptions;

use \Exception;

class NotAllowed extends Exception {
	public function __construct($errors = ["Access denied"]) {
		parent::__construct("Access denied");
		header("HTTP/1.0 403 Forbidden - Access denied");
		$this->errors = $errors;
	}
}
