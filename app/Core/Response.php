<?php 

namespace App\Core;

use App\Core\View\ViewFactory;

class Response {

	/**
	 * Return View as response
	 *
	 * @return void
	 */
	public function view($location, $variables) {
		extract($variables);
		$view = new ViewFactory($location);

		ViewFactory::render($view);
	}

	/**
	 * Return Json as response
	 *
	 * @param  string $data
	 * @return void
	 */
	public function json($data) {
		header('Content-Type: application/json');
		echo(json_encode($data));
	}

	public function redirect($uri) {
		header("Location: $uri");
	}
}