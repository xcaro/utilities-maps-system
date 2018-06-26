<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
        	'name' => 'administrator',
        	'username' => 'admin',
        	'email' => 'admin@example.com',
        	'password' => bcrypt('123456'),
          'role_id' => 1,
       	];
       	if (User::where('username', $user['username'])->first() === null) {
       		User::firstOrCreate($user);
       	}
    }
}
