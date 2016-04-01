<?php

use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::statement("drop table if exists tokens");

Capsule::schema()->create("tokens", function($table) {
	$table->increments("id");

	$table->string("token");
	$table->integer("user_id");
	$table->integer("expire");
});