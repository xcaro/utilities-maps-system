<?php

use Illuminate\Database\Seeder;
use App\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $options = [
        	[
        		'name' => 'Số ngày đăng ký phòng khám',
        		'key' => 'default_clinic_expire',
        		'value' => 30,
        	],
        ];

        foreach ($options as $key => $rel) 
        {

        	if (!(Setting::where('key', $rel['key'])->exists())) 
        	{
        		Setting::create($rel);
        	}
        }
    }
}
