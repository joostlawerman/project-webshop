<?php

namespace App\Http\Middleware;

use App\Core\Auth\Auth;
use App\Core\Exceptions\NotAllowed;

class Authenticate {
	public function handle($request) {
		if (isset($_SERVER["HTTP_AUTHORIZATION"])) {
			$token = $_SERVER["HTTP_AUTHORIZATION"];
			if (Auth::check($token)) {
				return;
			}
		}
		throw new NotAllowed();
	}
}