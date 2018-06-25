<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listRole = [
        	'Quản trị viên',
        	'Kiểm duyệt báo cáo',
        	'Bác sĩ'
        ];
        foreach ($listRole as $item) {
        	if (Role::where('title', $item)->first() === null) {
        		Role::create(['title' => $item]);
        	}
        }

        $roleAdmin = Role::find(1);
        $listPermissions = Permission::all();
        foreach ($listPermissions as $perm) {
            $roleAdmin->permissions()->save($perm);
        }

    }
}
