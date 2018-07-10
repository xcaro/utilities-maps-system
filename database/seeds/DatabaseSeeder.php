<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         
         $this->call(ClinicTypesSeeder::class);
         $this->call(ReportTypesSeeder::class);
         $this->call(PermissionsTableSeeder::class);
         $this->call(RolesTableSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(SettingsTableSeeder::class);
         $this->call(CitiesTableSeeder::class);
    }
}
