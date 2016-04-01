<?php

namespace App\Core;

class Session {
	public static $started = false;

	public static function start() {
		if (static::$started == false) {
			session_start();
			static::$started = true;
		}
	}
	public static function set($key, $value) {
		static::start();
		$_SESSION[$key] = $value;
	}
	public static function remove($key) {
		static::start();
		unset($_SESSION[$key]);
	}
	public static function get($key) {
		static::start();
		if (isset($_SESSION[$key])) {
			return $_SESSION[$key];
		}
		return null;
	}
}