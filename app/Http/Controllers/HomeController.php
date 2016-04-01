<?php

namespace App\Http\Controllers;

class HomeController {
	
	public function index($request) {
		return response()->view("layouts.main",compact($request));
	}
}
