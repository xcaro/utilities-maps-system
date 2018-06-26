<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
    	'name', 'image', 'description'
    ];
    public function clinic()
    {
    	return $this->belongsTo(Clinic::class);
    }
}
