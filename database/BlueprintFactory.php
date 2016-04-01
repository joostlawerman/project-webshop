<?php

class BlueprintFactory {
	public function __construct($string) {
		$this->query = $string;
	}
	public function __toString() {
		return $this->query;
	}
	public function unsigned() {
		$this->query = $this->query . " UNSIGNED";
		return $this;
	}
	public function primary() {
		$this->query = $this->query . " PRIMARY";
		return $this;
	}
}
