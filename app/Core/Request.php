<?php
/*
	©Joost Lawerman
*/

namespace App\Core;

class Request {
	public function __construct() {
	}
	public function __get($name) {
		if (isset($_SERVER["REQUEST_".strtoupper($name)])) {
			return $_SERVER["REQUEST_".strtoupper($name)];
		}
		return null;
	}

	public function getMethod() {
		$input = $this->all();
		if (isset($input["method"])) {
			return strtoupper($input["method"]);
		}
		return $_SERVER["REQUEST_METHOD"];
	}

	public function input($name = true) {
		if ($name) {
			return $this;
		}
		if (explode(";",$_SERVER["CONTENT_TYPE"])[0] == "application/json") {
			$input = (array) json_decode(file_get_contents("php://input"));
			if(isset($input[$name])) {
				return $input[$name];
			}
		}
		if (isset($_POST[$name])) {
			return $_POST[$name];
		}
		if (isset($_GET[$name])) {
			return $_GET[$name];
		}
		return false;
	}
	public function all() {
		if (explode(";",$_SERVER["CONTENT_TYPE"])[0] == "application/json") {
			return (array) json_decode(file_get_contents("php://input"));
		}
		return array_merge($_POST,$_GET);
	}
	public static function isAjax() {
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
			if (strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == "xmlhttprequest") {
				return true;
			}
		}
		return false;
	}
	public static function get() {
		return new static();
	}
}
