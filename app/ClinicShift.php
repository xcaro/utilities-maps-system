<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClinicShift extends Model
{
    protected $fillable = [
    	'name',
    	'start_shift',
    	'end_shift',
    	'active',
    ];
}
