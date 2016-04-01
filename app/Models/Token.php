<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

class Token extends Model {
	public $table = "tokens";

	public $timestamps = false;

	protected $fillable = ["token", "user_id", "expire"];

	protected $hidden = ["id"];

	public function user() {
		return $this->belongsTo("App\Models\User","user_id","id");
	}
}
