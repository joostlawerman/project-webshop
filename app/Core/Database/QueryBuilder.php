<?php

namespace App\Core\Database;

use QueryResult;

class QueryBuilder {
	private $queryBindings = [
		"select" => [],
		"join" => [],
		"where" => [],
		"order" => []
	];

	public $columns;

	private $query;

	public function select($columns = ["*"]) {
		if (is_array($columns)) {
			$this->columns = $columns;
		}
		$this->columns = func_get_args();
		return $this;
	}

	public function addBinding($type, $value) {
		$this->queryBinding[$type] = $value;
	}

	public function where($column, $way, $value, $bool = "and") {
		if (count($this->queryBindings["where"]) > 0) {
			$this->addWhere("$bool {$column}{$way}'{$value}'");
		}
		return $this;
	}

	

	public function raw($value) {
		$this->query .= $value;
	}
	public function orderBy($column) {
		$this->query .= "order by $column";
	}
	public function get() {
		return $this->execute();
	}
	public function save() {
		return $this->execute();
	}
	protected function execute() {
		return new QueryResult();
	}	
}
