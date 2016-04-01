<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Core\Validator;
use App\Core\Exceptions\PageNotFound;
use App\Core\Exceptions\NotAllowed;
use App\Core\Auth\Auth;

class UsersController {

	public $middleware = [
		"App\Http\Middleware\Authenticate" => ["login","create"]
	];

	public $rules = [
		"firstname" => "required",
		"secondname" => "required",
		"email" => "unique:User|required|email",
		"password" => "required|confirmed",
		"password_confirm" => "required",
		"adress" => "required",
		"zipcode" => "required",
		"conditions" => "required|checked"
	];

	public function login($request) {
		$errors = Validator::check($request->all(), ["email"=>"required|email", "password"=>"required"]);

		if (count($errors) == 0) {
			$input = $request->all();
			$result = Auth::attempt($input["email"], $input["password"], true);
			if (is_string($result)) {
				return response()->json(["token"=>$result]);
			}
			throw new NotAllowed(["errors"=>"Wrong password or email"]);
		}
		throw new NotAllowed(["errors"=>$errors]);
	}
	
	public function logout($request) {
		Auth::logout();
		return response()->json(true);
	}

	public function create($request) {
		$errors = Validator::check($request->all(), $this->rules);
		

		if (count($errors) == 0) {
			$input = $request->all();
			
			$input["password"] = password_hash($input["password"], PASSWORD_DEFAULT);

			User::create($input);

			return response()->json($request->all());
		}
		throw new NotAllowed(["errors"=>$errors]);
	}

	public function show($request, $id) {
		if ($id == 0) {
			return response()->json(Auth::user());
		}
		if (Auth::user()->id != $id) {
			throw new PageNotFound();
		}
		try {
			$user = User::where("id",$id)->first();	
		} catch (Exception $e) {
			throw new PageNotFound();
		}

		return response()->json($user);
	}

	public function index($request) {
		if ($user->can("index-users")) {
			return User::all();
		}
		throw new NotAllowed();
	}
}
