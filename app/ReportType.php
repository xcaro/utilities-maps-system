<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportType extends Model
{
    protected $fillable = [
    	'id', 'name', 'confirmed_icon', 'unconfirmed_icon', 'menu_icon', 'active',
    ];

    public function reports()
    {
    	return $this->hasMany(Report::class, 'type_id');
    }
}
