<?php

use App\Models\User;

$router->get("/", "HomeController@index");
$router->get("/conditions", function() {
	echo "<h1>Conditions</h1>";
});

/////////////////
// Auth Routes //
/////////////////
$router->post("/api/login", "UsersController@login");
$router->get("/api/logout", "UsersController@logout");

/////////////////
// User Routes //
/////////////////
$router->get("/api/users", "UsersController@index");
$router->post("/api/users", "UsersController@create");

$router->get("/api/users/{id}", "UsersController@show");
$router->patch("/api/users/{id}", "UsersController@update");

////////////////////
// Product Routes //
////////////////////
$router->get("/api/products", "ProductsController@index");
$router->get("/api/products/{id}", "ProductsController@show");
