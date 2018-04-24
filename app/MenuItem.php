<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    public function parent_menu()
    {
    	return $this->belongsTo(Menu::class, 'menu');
    }
}
