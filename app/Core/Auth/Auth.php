<?php

namespace App\Core\Auth;

use App\Models\User;
use App\Models\Token;
use App\Core\Session;

class Auth {
	public static $user = false;

	public static function attempt($user, $password, $token = false) {
		$user = User::where("email",$user)->first();
		if(password_verify($password, $user->password)) {
			if ($token) {
				return $user->giveToken();
			}
			return true;
		}
		return false;
	}	
	public static function check($token = false) {
		$dToken = Token::where("token",$token)->first();
		if (!is_null($dToken)) {
			if ($dToken->expire > time()) {
				return true;	
			}
		}
		return false;
	}
	public static function user() {
		return static::getUser();
	}
	public static function logout($token = false) {
		Token::where("token", $_SERVER["HTTP_AUTHORIZATION"])->delete();
	}
	protected static function getUser() {
		if (static::$user == false) {
			$token = Token::where("token", $_SERVER["HTTP_AUTHORIZATION"])->first();
			static::$user = $token->user;
		}
		return static::$user;

	}
}