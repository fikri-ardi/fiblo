<?php

namespace Database\Seeders;

use App\Models\{User, Post, Category};
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
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            LinkSeeder::class
        ]);

        User::factory()->hasPosts(10)->count(5)->create();
    }
}