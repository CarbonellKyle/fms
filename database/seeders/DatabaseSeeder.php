<?php
namespace Database\Seeders;

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
        $this->call(LaratrustSeeder::class); //Required for user roles and permission
        $this->call([UsersTableSeeder::class]); //Required to create default admin account
        $this->call(DummySeeder::class); //Optional. Dummy data composed of 4 seasons and respective info
    }
}
