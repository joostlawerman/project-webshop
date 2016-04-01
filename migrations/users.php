<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use App\Models\User;

Capsule::statement("drop table if exists users");

Capsule::schema()->create("users", function($table) {
	$table->increments("id");
	
	$table->string("email")->unique();
	$table->string("password");

	$table->string("firstname");
	$table->string("secondname");
	
	$table->string("adress");
	$table->string("zipcode");
	$table->string("city");
	
	$table->timestamps();
});

$user = new User();
$user->email = "foo@bar.com";
$user->password = password_hash("test", PASSWORD_DEFAULT);
$user->firstname = "foo";
$user->secondname = "bar";
$user->adress = "street 11";
$user->zipcode = "2841QU";
$user->city = "foo city";
$user->save();
