<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTurn extends Model
{
    protected $fillable = [
    	'confirm', 'register_day', 'description',
    ];

}
