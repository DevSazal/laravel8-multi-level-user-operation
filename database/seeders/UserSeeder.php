<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// add user for Authenticate
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // add default user and admin and staff by Seeder
      DB::table('users')->insert([
        [
          'name' => 'Maliha Mou',
          'email' => 'maliha@gmail.com',
          'password' => Hash::make('123456'),
          'role' => 0,
          'role_type' => 'user',
          'deleted_at' => '2020-12-15 11:59:28'
        ],[
          'name' => 'Sazal Ahamed',
          'email' => 'sazal@gmail.com',
          'password' => Hash::make('123456'),
          'role' => 0,
          'role_type' => 'user',
          'deleted_at' => NULL
        ],[
          'name' => 'Mr Admin',
          'email' => 'admin@gmail.com',
          'password' => Hash::make('123456'),
          'role' => 2,
          'role_type' => 'admin',
          'deleted_at' => NULL
        ],[
          'name' => 'Mr Staff',
          'email' => 'staff@gmail.com',
          'password' => Hash::make('123456'),
          'role' => 1,
          'role_type' => 'staff',
          'deleted_at' => NULL
        ]
      ]);
    }
}
