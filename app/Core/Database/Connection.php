<?php

namespace App\Core\Database;

use \PDO;

class Connection {
	const dsn = "mysql:host=localhost;dbname=school";

	public static function connection() {
		$pdo = new PDO(static::dsn, "homestead", "secret");
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $pdo;
	}

	public static function rawQuery($query) {
		$conn = static::connection();
		$results = $conn->query($query);;
		if ($results) {
			return $results->fetchAll(PDO::FETCH_ASSOC);
		}
		return $conn->errorInfo();
	}
	
}
