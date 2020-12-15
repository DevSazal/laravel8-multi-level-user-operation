<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // add default comment for post by Seeder
      DB::table('comments')->insert([
        [
          'comment' => 'Everyone should do this',
          'user_id' => 3,
          'commentable_type' => 'Post',
          'commentable_id' => 4,
          'created_at' => '2020-12-15 22:43:06',
          'updated_at' => '2020-12-15 22:43:06'
        ],[
          'comment' => 'I like it',
          'user_id' => 4,
          'commentable_type' => 'Comment',
          'commentable_id' => 1,
          'created_at' => '2020-12-15 22:43:06',
          'updated_at' => '2020-12-15 22:43:06'
        ],[
          'comment' => 'Thank You',
          'user_id' => 2,
          'commentable_type' => 'Comment',
          'commentable_id' => 1,
          'created_at' => '2020-12-15 22:43:06',
          'updated_at' => '2020-12-15 22:43:06'
        ],[
          'comment' => 'Some people do not understand this thing',
          'user_id' => 4,
          'commentable_type' => 'Post',
          'commentable_id' => 4,
          'created_at' => '2020-12-15 22:43:06',
          'updated_at' => '2020-12-15 22:43:06'
        ]
      ]);
    }
}
