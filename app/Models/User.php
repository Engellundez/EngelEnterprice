<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
	use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array<int, string>
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
	];

	/**
	 * The attributes that should be hidden for serialization.
	 *
	 * @var array<int, string>
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast.
	 *
	 * @var array<string, string>
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
		'password' => 'hashed',
	];

	// ATTRIBUTES
	public function getFormattedCreatedAtAttribute()
	{
		return $this->created_at->format('H:i d-m-Y');
	}

	public function getFormattedUpdatedAtAttribute()
	{
		return $this->updated_at->format('H:i d-m-Y');
	}

	public function getSystemsOfMyRolesAttribute()
	{
		$systems = [];
		foreach ($this->allAccess as $access) {
			$system_id = Role::find($access->rol_id, ['system_id'])->system_id;
			if ($system_id == System::INIT) continue;
			$systems[$system_id] = System::find($system_id, ['url', 'name']);
		}
		return $systems;
	}

	public function getIsAdminAttribute()
	{
		foreach ($this->allAccess as $access) {
			if($access->rol_id == Role::ADMIN)
			{
				return true;
			}
		}
		return false;
	}

	// RELATIONS
	public function allAccess()
	{
		return $this->hasMany(RoleUser::class, 'user_id', 'id');
	}
}
