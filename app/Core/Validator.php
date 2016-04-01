<?php

namespace App\Core;

use \Exception;

class Validator {

	public $values;

	protected $errors = [];

	public function __construct($values) {
		$this->values = $values;
	}

	public function required($field) {
		if (isset($this->values[$field])) {
			if ($this->values[$field] != "") {
				return;
			}
		}
		$this->addError($field, "$field is required.");
	}

	public function confirmed($field) {
		if (isset($this->values["{$field}_confirm"])) {
			if ($this->values[$field] === $this->values["{$field}_confirm"]) {
				return;
			}
		}
		$this->addError($field, "$field is not confirmed.");
	}

	public function unique($field, $option) {
		try {
			$except = explode(",",$option);
			if (count($except) > 1) {
				$option = $except[0];
				if ($this->values[$field] == $except[1]) {
					return;
				}
			}

			$class = "App\Models\\".$option;

			$results = $class::where($field, $this->values[$field])->get();

			if (count($results) > 0) {
				$this->addError($field, "$field is not unique.");
			}
		} catch (Exception $e) {
			throw new Exception("$option Does not exist", 1);
		}
	}

	public function checked($field) {
		if (!(bool)$this->values[$field]) {
			$this->addError($field, "$field is not checked.");
		}
	}

	public function email($field) {
		if (filter_var($this->values[$field], FILTER_VALIDATE_EMAIL)) {
			return;
		}
		$this->addError($field, "$field is not an valid email adress.");
	}
	
	public function exists($method) {
		if (!method_exists($this, $method)) {
			throw new Exception("$method: Validator option does not exist", 1);
		}
	}

	protected function addError($field, $message) {
		if (!isset($this->error[$field])) {
			$this->errors[$field] = [];
		}
		$this->errors[$field][] = ucfirst($message);
	}

	public static function check($values, $fieldRules) {
		$validator = new static($values);

		foreach ($fieldRules as $field => $rules) {
			foreach (explode("|", $rules) as $value) {

				$rule = explode(":", $value);
				$method = $rule[0];

				$except = explode(",",$method);

				if (count($except) > 1) {
					$method = $except[0];
				}

				if (isset($rule[1])) {
					$validator->exists($method);
					$validator->$method($field, $rule[1]);
				} else {
					$validator->exists($method);
					$validator->$method($field);
				}
			}	
		}
		return $validator->errors;
	}
}