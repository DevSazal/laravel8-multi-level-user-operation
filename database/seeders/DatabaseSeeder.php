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
        // \App\Models\User::factory(10)->create();

        // Calling Additional Seeders
        $this->call([
          UserSeeder::class,
          PostSeeder::class,
          CommentSeeder::class,

        ]);

        $this->command->info('User Post & Comment table seeded!');
    }
}
