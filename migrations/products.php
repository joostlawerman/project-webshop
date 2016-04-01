<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use App\Models\Product;

Capsule::statement("drop table if exists products");

Capsule::schema()->create("products", function($table) {
	$table->increments("id");
	
	$table->string("name");
	$table->text("info");

	$table->float("price");
	$table->integer("category_id")->nullable();

	$table->timestamps();
});

$product = new Product();
$product->name = "GTX 960";
$product->info = "Some info";
$product->price = 239.99;
$product->save();

$product = new Product();
$product->name = "GTX 970";
$product->info = "Some info";
$product->price = 319.99;
$product->save();

$product = new Product();
$product->name = "GTX 980";
$product->info = "Some info";
$product->price = 429.99;
$product->save();
