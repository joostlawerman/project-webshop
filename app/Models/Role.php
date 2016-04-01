<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

class Role extends Model {
	public $table = "roles";

	protected $fillable = ["display_name","name"];

	public function permissions() {
        return $this->belongsToMany("App\Models\Permission", "permission_role", "permission_id", "role_id");
    }
}
