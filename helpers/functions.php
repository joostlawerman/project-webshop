<?php

use App\Core\Response;
use App\Core\Exceptions\NotAllowed;
use App\Core\Exceptions\PageNotFound;

function response() {
	return new Response();	
}

function abort($code) {
	if ($code == 403) {
		throw new NotAllowed("test");	
	}
	if ($code == 404) {
		throw new PageNotFound("test");
	}
	die("Exit status: $code");
}
