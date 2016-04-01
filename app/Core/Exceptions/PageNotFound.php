<?php

namespace App\Core\Exceptions;

use \Exception;

class PageNotFound extends Exception {
	public function __construct() {
		parent::__construct("Page not found");
		header("HTTP/1.0 404 Not Found - Archive Empty");
	}
}
