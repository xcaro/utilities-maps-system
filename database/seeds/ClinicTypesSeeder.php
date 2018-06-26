<?php

use Illuminate\Database\Seeder;
use App\ClinicType;

class ClinicTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
        	[
        		'name' => 'Nha khoa', 
        	],
        	[
        		'name' => 'Khoa nhi',
        	],
        	[
        		'name' => 'Răng Hàm Mặt',
        	],
        	[
        		'name' => 'Khoa mắt',
        	],
        	[
        		'name' => 'Tai - Mũi - Họng',
        	],
        	[
        		'name' => 'Tim mạch',
        	],
        	[
        		'name' => 'Nội tiết',
        	],
        	[
        		'name' => 'Xương khớp',
        	],
        	[
        		'name' => 'Tâm lý',
        	],
        	[
        		'name' => 'Vật lý trị liệu',
        	]
        ];
        foreach ($types as $item) {
        	if (ClinicType::where('name', $item['name'])->first() === null) {
        		ClinicType::firstOrCreate($item);
        	}
        }
    }
}
