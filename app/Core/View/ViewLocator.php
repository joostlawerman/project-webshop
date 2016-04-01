<?php

namespace App\Core\View;

class ViewLocator {
	public function find($location) {
		return __projectRoot__ . "/assets/views/" . str_replace(".","/",$location) . ".php";
	}
}
