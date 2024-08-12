<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class System extends Model
{
	use HasFactory, SoftDeletes;

	const INIT = 1;

	// SCOPES
	public function scopeGetPublish(Builder $query)
	{
		return $query->where('id', '!=', System::INIT)->where('is_publish', 1)->get();
	}

	public function scopePublish(Builder $query)
	{
		return $query->where('is_publish', 1);
	}
}
