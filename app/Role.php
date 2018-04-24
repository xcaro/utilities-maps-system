<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $fillable = [
		'id', 'title',
	];
    public function permissions()
    {
    	return $this->belongsToMany(Permission::class, 'role_permission');
    }
}
