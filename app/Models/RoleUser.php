<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RoleUser extends Model
{
	use HasFactory, SoftDeletes;
	protected $table = 'rol_users';

	// ATTRIBUTES
	public function getProgramsOfRolesAttribute()
	{
		foreach ($this->roles as $rol) {
			$systems[] = (object) [$rol->system_id];
		}
		return $systems;
	}

	public function getListOfRolesAttribute()
	{
		foreach ($this->roles as $rol) {
			$roles[] = $rol->name;
		}
		return $roles;
	}

	// RELATIONS
	public function roles()
	{
		return $this->belongsToMany(Role::class, 'rol_users', 'rol_id', 'id');
	}
}
