<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Core\Validator;
use App\Core\Exceptions\PageNotFound;
use App\Core\Exceptions\NotAllowed;
use App\Core\Auth\Auth;

class ProductsController {
	public function index($request) {
		$products = Product::select("id", "name")->get();
		return response()->json($products);
	}
	public function show($request, $id) {
		$product = Product::where("id", $id)->first();
		return response()->json($product);	
	}
}