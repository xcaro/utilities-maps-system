<?php

use Illuminate\Database\Seeder;
use App\ReportType;

class ReportTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listTypes = [
        	[
        		'name' => 'Kẹt xe',
        		'confirmed_icon' => 'https://i.imgur.com/0vahrGH.png',
        		'unconfirmed_icon' => 'https://i.imgur.com/nI6qzpi.png',
        		'menu_icon' => 'https://i.imgur.com/twyHlgc.png',
                'alive' => 3600,
        	],
        	[
        		'name' => 'Ngập nước',
        		'confirmed_icon' => 'https://i.imgur.com/2J0rCFT.png',
        		'unconfirmed_icon' => 'https://i.imgur.com/hh8dPhK.png',
        		'menu_icon' => 'https://i.imgur.com/RV3J9os.png',
                'alive' => 7200,
        	],
        	[
        		'name' => 'Tai nạn giao thông',
        		'confirmed_icon' => 'https://i.imgur.com/r1dzRrO.png',
        		'unconfirmed_icon' => 'https://i.imgur.com/g07gIy7.png',
        		'menu_icon' => 'https://i.imgur.com/sk8xfk9.png',
                'alive' => 7200,
        	],
            [
                'name' => 'Hư hỏng - Sửa chửa',
                'confirmed_icon' => 'https://i.imgur.com/r1dzRrO.png',
                'unconfirmed_icon' => 'https://i.imgur.com/g07gIy7.png',
                'menu_icon' => 'https://i.imgur.com/sk8xfk9.png',
                'alive' => 0,
            ],

        ];
        foreach ($listTypes as $key => $type) {
        	if (ReportType::where('name', $type['name'])->first() === null) {
        		ReportType::create($type);
        	}
        }
    }
}
