<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listPerms = [
        	[
        		'title' => 'Admin Control',
        		'name' => 'admin-control',
        	],
        	[
        		'title' => 'Report Control',
        		'name' => 'report-control',
        	],
        	[
        		'title' => 'Clinic Control',
        		'name' => 'clinic-control',
        	],
        	[
        		'title' => 'User Control',
        		'name' => 'user-control',
        	],
        ];
        foreach ($listPerms as $perm) {
        	if (Permission::where('name', $perm['name'])->first() === null) {
        		Permission::firstOrCreate($perm);
        	}
        }
    }
}
