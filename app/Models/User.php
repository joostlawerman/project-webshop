<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

class User extends Model {
	public $table = "users";

	protected $fillable = ["email","password","firstname","secondname","adress","zipcode","city"];

	protected $hidden = ["id","password"];

	public function giveToken() {
		if ($this->token()->count() > 0) {
			if ($this->token->expire > time()) {
				return $this->token->token;
			}
			$this->token->delete();
		}

		$data = [];

		$data["expire"] = strtotime('+1 week');
		$data["token"] = md5(rand() * time());

		$this->token()->create($data);

		return $data["token"];
	}

	public function token() {
		return $this->hasOne("App\Models\Token","user_id");
	}

	public function roles() {
        return $this->belongsToMany("App\Models\Role", "role_user", "user_id", "role_id");
    }

    public function can() {
    	foreach ($this->roles as $role) {
            // Validate against the Permission table
            foreach ($role->permissions as $perm) {
                if ($permission == $perm->name) {
                    return true;
                }
            }
        }
        return false;
    }
}
