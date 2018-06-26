<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
    	'id', 'latitude', 'longitude', 'comment', 'user_created', 'active', 'confirm', 'image', 'type_id', 'ward_id', 'district_id',
    ];

    public function type()
    {
    	return $this->belongsTo(ReportType::class);
    }
}
