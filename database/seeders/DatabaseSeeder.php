<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
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

        // User::truncate();
        // Post::truncate();
        // Category::truncate();

        $user = User::factory()->create([
            'name' => 'Daniel Mechenko'
        ]);

        Post::factory(5)->create([
            'user_id' => $user->id
        ]);
        
        // $user = User::factory()->create();

        // Category::create([
        //     'name' => 'Personal',
        //     'slug' => 'personal'
        // ]);

        // Category::create([
        //     'name' => 'Family',
        //     'slug' => 'family'
        // ]);

        // Category::create([
        //     'name' => 'Work',
        //     'slug' => 'work'
        // ]);

    }
}
