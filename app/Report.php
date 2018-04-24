<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
    	'id', 'latitude', 'longitude', 'notes', 'type_id', 'user_created', 'active',
    ];

    public function type()
    {
    	return $this->belongsTo(ReportType::class);
    }
    
    public function userCreated()
    {
    	return $this->belongsTo(User::class);
    }
}
