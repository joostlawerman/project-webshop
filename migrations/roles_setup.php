<?php


use Illuminate\Database\Capsule\Manager as Capsule;

Capsule::statement("drop table if exists permission_role");
Capsule::statement("drop table if exists permissions");
Capsule::statement("drop table if exists role_user");
Capsule::statement("drop table if exists roles");


// Create table for storing roles
Capsule::schema()->create('roles', function ($table) {
    $table->increments('id');
    $table->string('name')->unique();
    $table->string('display_name')->nullable();
    $table->string('description')->nullable();
    $table->timestamps();
});

// Create table for associating roles to users (Many-to-Many)
Capsule::schema()->create('role_user', function ($table) {
    $table->integer('user_id')->unsigned();
    $table->integer('role_id')->unsigned();

    $table->foreign('user_id')->references('id')->on('users')
        ->onUpdate('cascade')->onDelete('cascade');
    $table->foreign('role_id')->references('id')->on('roles')
        ->onUpdate('cascade')->onDelete('cascade');

    $table->primary(['user_id', 'role_id']);
});

// Create table for storing permissions
Capsule::schema()->create('permissions', function ($table) {
    $table->increments('id');
    $table->string('name')->unique();
    $table->string('display_name')->nullable();
    $table->string('description')->nullable();
    $table->timestamps();
});

// Create table for associating permissions to roles (Many-to-Many)
Capsule::schema()->create('permission_role', function ($table) {
    $table->integer('permission_id')->unsigned();
    $table->integer('role_id')->unsigned();

    $table->foreign('permission_id')->references('id')->on('permissions')
        ->onUpdate('cascade')->onDelete('cascade');
    $table->foreign('role_id')->references('id')->on('roles')
        ->onUpdate('cascade')->onDelete('cascade');

    $table->primary(['permission_id', 'role_id']);
});