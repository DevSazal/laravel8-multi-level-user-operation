<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // add default user and admin and staff by Seeder
      DB::table('posts')->insert([
        [
          'message' => 'I hate this app',
          'user_id' => 2,
          'active' => 1,
          'created_at' => '2020-12-13 19:16:40',
          'updated_at' => '2020-12-13 19:16:40',
          'deleted_at' => '2020-12-15 11:59:28'
        ],[
          'message' => 'I love this app',
          'user_id' => 2,
          'active' => 1,
          'created_at' => '2020-12-13 19:16:40',
          'updated_at' => '2020-12-13 19:16:40',
          'deleted_at' => NULL
        ],[
          'message' => 'I like my attitude and want to be with this',
          'user_id' => 2,
          'active' => 0,
          'created_at' => '2020-12-14 19:16:40',
          'updated_at' => '2020-12-14 19:16:40',
          'deleted_at' => NULL
        ],[
          'message' => 'I don\'t like to compromise with character to reach my goal',
          'user_id' => 2,
          'active' => 1,
          'created_at' => '2020-12-15 02:45:40',
          'updated_at' => '2020-12-15 02:45:40',
          'deleted_at' => NULL
        ]
      ]);

    }
}
