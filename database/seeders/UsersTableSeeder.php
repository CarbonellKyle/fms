<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Creates the first account
        DB::table('users')->insert([
            'name' => 'Admin Admin',
            'email' => 'admin@mail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //Added role 'administrator' to the first account
        DB::table('role_user')->insert([
            'role_id' => 2,
            'user_id' => 1,
            'user_type' => 'App\Models\User'
        ]);
    }
}
