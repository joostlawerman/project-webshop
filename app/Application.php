<?php

namespace App;

use App\Core\Request;
use App\Core\Router;
use App\Core\Handler\ExceptionHandler;
use \Exception;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

class Application {
	function __construct() {
		$this->request = new Request();
		new ExceptionHandler();

		$capsule = new Capsule();

		$capsule->addConnection([
		    'driver'    => 'mysql',
		    'host'      => '192.168.10.10',
		    'database'  => 'project_webshop',
		    'username'  => 'homestead',
		    'password'  => 'secret',
		    'charset'   => 'utf8',
		    'collation' => 'utf8_unicode_ci',
		    'prefix'    => '',
		]);

		$capsule->setAsGlobal();

		$capsule->bootEloquent();	
	}
	function handle($request) {
		Router::start($request);
	}
}
