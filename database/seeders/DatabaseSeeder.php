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
        $this->call(RoleSeeder::class);
        User::factory(3)->create();
        $this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        Post::factory(20)->create();
        // $this->call(UserSeeder::class);
        // $this->call(PostSeeder::class);
    }
}