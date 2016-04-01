<?php

namespace App\Les18;

use \PDO;

use App\Les18\Table;

class Database {
	const dsn = "mysql:host=localhost;dbname=project";

	public static function connection() {
		return new PDO(self::dsn, "homestead", "secret");
	}

	public static function recreate($name) {
		$pdo = new PDO("mysql:host=localhost", "homestead", "secret");
		$pdo->query("DROP DATABASE IF EXISTS $name");
		$pdo->query("CREATE DATABASE $name");
	}

	public static function rawQuery($query) {
		return self::connection()->query($query)->fetchAll(PDO::FETCH_ASSOC);
	}

	public static function fill() {
		$users = new Table("users", function ($table) {
			return [
				$table->increments("id")->unsigned()->primary(),
				$table->varchar("email"),
				$table->varchar("password"),
				$table->varchar("first_name"),
				$table->varchar("second_name"),
				$table->varchar("insertion"),
				$table->varchar("address"),
				$table->varchar("postal"),
				$table->varchar("country"),
				$table->timestamp("created_at"),
				$table->timestamp("updated_at")];
		});
		$messages = new Table("messages", function ($table) {
			return [
				$table->increments("id")->unsigned()->primary(),
				$table->varchar("title"),
				$table->varchar("memo"),
				$table->timestamp("created_at"),
				$table->timestamp("updated_at")];
		});
		$products = new Table("products", function ($table) {
			return [
				$table->increments("id")->unsigned()->primary(),
				$table->varchar("name"),
				$table->varchar("description"),
				$table->varchar("category_id"),
				$table->double("price"),
				$table->timestamp("created_at"),
				$table->timestamp("updated_at")];
		});
		$categories = new Table("categories", function ($table) {
			return [
				$table->increments("id")->unsigned()->primary(),
				$table->varchar("name"),
				$table->varchar("description"),
				$table->timestamp("created_at"),
				$table->timestamp("updated_at")];
		});
	}
}
