<?php

$router->get("/", "HomeController@index");

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

////////////////////
// Product Routes //
////////////////////
$router->get("/api/products", "ProductsController@index");
$router->get("/api/products/{id}", "ProductsController@show");
