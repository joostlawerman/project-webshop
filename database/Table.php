<?php

namespace App\Les18;

use App\Les18\Database;
use App\Les18\TableInteractor;
use App\Les18\Blueprint;

class Table extends TableInteractor {
	
	public function __construct($name, $columns = false) {
		$this->conn();
		if ($columns) {
			$this->createTable($name, $columns(new Blueprint));
		}
		$this->table = $name;
		//return new TableInteractor($name);
	}

	protected function createTable($name, $columns) {
		$query = "CREATE TABLE $name(".implode(",",$columns).")";
		$this->conn->query($query);
	}
}
