<?php

namespace App\Core\Handler;

use App\Core\Exceptions\PageNotFound;
use App\Core\Exceptions\NotAllowed;
use App\Core\Request;

class ExceptionHandler {

	function __construct() {
		set_exception_handler(["App\Core\Handler\ExceptionHandler","process"]);
	}

	public static function process($e) {
		if ($e instanceof PageNotFound) {
			if (Request::isAjax()) {
				return response()->json("Page Not Found - 404");
			}
			echo "
				<title>Page Not Found - 404</title>
				<h2>Page Not Found - 404</h2>
			";
			return;
		}
		if ($e instanceof NotAllowed) {
			if (Request::isAjax()) {
				return response()->json($e->errors);
			}
			echo "
				<title>Access denied - 403</title>
				<h2>Access denied - 403</h2>
			";
			return;
		}
		self::render($e);
	}

	public static function render($e) {
		echo
		"<!DOCTYPE html>
		<html>
			<head>
				<title>".$e->getMessage()."</title>
				<style>
					
				</style>
			</head>
			<body>
				<h2>".$e->getMessage()." on line ".$e->getLine()." in ".$e->getFile()."</h2>
				<ul>
					";

		if (count($e->getTrace()) > 0) {
			foreach($e->getTrace() as $line) {
				echo "<li>". $line["class"] . $line["type"] . $line["function"] ." in " . $line["file"] . "</li>";
			}
		}

		echo
		"		</ul>
			</body>
		</html>";
	}
}
