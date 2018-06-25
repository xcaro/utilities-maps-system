<?php

use Illuminate\Database\Seeder;
use App\City;
use App\District;
use App\Ward;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $city = City::firstOrCreate(['name' => 'Hồ Chí Minh']);
        $districts = file_get_contents('https://tiki.vn/api/v2/directory/districts?region_id=294');
        $districts = json_decode($districts, true);

        foreach ($districts['data'] as $dst) {
        	$district = new District;
        	$district->name = $dst['name'];

        	if ($city->districts()->save($district)) {
        		$wards = file_get_contents("https://tiki.vn/api/v2/directory/wards?district_id={$dst['id']}");
	    		$wards = json_decode($wards, true);

	    		foreach ($wards['data'] as $wrd) {
	    			$ward = new Ward;
	    			$ward->name = $wrd['name'];

	    			$district->wards()->save($ward);
	    		}
        	}
        }
    }
}
