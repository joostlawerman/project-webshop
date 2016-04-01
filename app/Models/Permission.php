<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

class Permission extends Model {
	public $table = "permissions";

	protected $fillable = ["display_name","name"];

}
