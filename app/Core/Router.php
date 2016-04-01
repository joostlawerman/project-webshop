<?php
/*
	©Joost Lawerman
*/

namespace App\Core;

use \Exception;
use App\Core\Exceptions\PageNotFound;

class Router {
	protected $routes = [];

	public static function start($request) {
		$router = new static();
		
		require __DIR__ . "/../Http/routes.php";
		$router->handle($request);
	}

	/**
	 * Add a get route
	 *
	 * @param  string $uri
	 * @param  string $action
	 * @return void
	 */
	public function get($uri, $action) {
		$this->addRoute("GET", $uri, $action);
	}

	/**
	 * Add a post route
	 *
	 * @param  string $uri
	 * @param  string $action
	 * @return void
	 */
	public function post($uri, $action) {
		$this->addRoute("POST", $uri, $action);
	}
	
	/**
	 * Add a patch route
	 *
	 * @param  string $uri
	 * @param  string $action
	 * @return void
	 */
	public function patch($uri, $action) {
		$this->addRoute("PATCH", $uri, $action);
	}	

	/**
	 * Add route to routes array
	 *
	 * @param  string $method
	 * @param  string $uri   
	 * @param  string $action
	 * @return void
	 */
	protected function addRoute($method, $uri, $action) {
		if (!isset($this->routes[$uri])) {
			$this->routes[$uri] = [];
		}
		$this->routes[$uri][$method] = $action;
	}

	/**
	 * Compare a uri string
	 *
	 * @param  string $routeUri
	 * @param  string $requestUri
	 * @return boolean
	 */
	protected function compareUri($routeUri, $requestUri) {
		if (strpos($routeUri, "{") !== false) {
			$routeUriWildcards = explode("/",preg_replace("/{.*?}/", "*", $routeUri));
			$requestUriArray = explode("/",$requestUri);

			// Check if same array length
			if (count($requestUriArray) == count($routeUriWildcards)) {
				$sections = [];
				// Loop
				foreach ($routeUriWildcards as $key => $value) {
					if (isset($requestUriArray[$key])) {
						// If the route matches the request or there is a wild card enter a true.
						if ($requestUriArray[$key] === $value || $value === "*") {
							$sections[] = false;
						} else {
							$sections[] = true;
						}
					} else {
						$sections[] = true;
					}
				}
				// If sections does contain a true return false
				if (implode("", $sections) > 0) {
					return false;
				}
				return true;
			}
			return false;
		}
		return $routeUri == $requestUri;
	}

	/**
	 * Handle the request
	 *
	 * @param  App\Core\Request $request
	 * @return void
	 * 
	 * @throws Exception
	 */
	public function handle($request) {
		// Loop trough routes
		foreach ($this->routes as $uri => $value) {
			// Compare uri
			if ($this->compareUri($uri, $request->uri)) {
				// Loop trough methods
				foreach ($value as $method => $action) {
					// Check method
					if ($method == $request->getMethod()) {
						// Check if action is closure
						if (is_object($action) && ($action instanceof \Closure)) {
							$this->handleClosure($action, $uri, $request);
							return;
						}

						if (is_string($action)) {
							$this->handleController($action, $uri, $request);
							return;
						}

						throw new Exception("Invalid Action description", 1);
					}
					$wrongMethod = true;
				}
			}
		}
		if ($wrongMethod) {
			throw new Exception("Invalid Method", 1);
		}
		throw new PageNotFound();
	}

	/**
	 * Handle a route call with a closure
	 *
	 * @param  string $action
	 * @param  string $uri   
	 * @param  App\Core\Request $request 
	 * @return void
	 */
	public function handleClosure($action, $uri, $request) {
		$action(...$this->variables($request,$uri));
	}
	
	/**
	 * Handle a route with a controller string
	 *
	 * @param  string $action 
	 * @param  string $uri    
	 * @param  App\Core\Request $request
	 * @return void
	 */
	public function handleController($action, $uri, $request) {
		list($controller, $method) = explode("@",$action);

		$controllerAdress = "App\Http\Controllers\\$controller";
		$controller = new $controllerAdress();
		if (isset($controller->middleware)) {
			$this->handleMiddleware($controller->middleware, $request, $method);
		}

		$controller->$method(...$this->variables($request,$uri));
	}

	public function handleMiddleware($middlewares, $request, $method) {
		foreach ($middlewares as $middleware => $except) {
			if (!in_array($method, $except)) {
				$middleware = new $middleware();
				$middleware->handle($request);
			}
		}
	}

	/**
	 * Get variables from uri
	 *
	 * @param  App\Core\Request $request
	 * @return array
	 */
	public function variables($request,$routeUri) {
		$variables = [$request];
		// Explode the request
		$requestUriArray = explode("/", $request->uri);
		// Explode route uri
		foreach (explode("/", $routeUri) as $key => $value) {
			if (strpos($value, "{") !== false) {
				$variables[] = $requestUriArray[$key];
			}
		}
		return $variables;
	}


}
