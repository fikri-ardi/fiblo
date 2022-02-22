<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = collect(['Programming', 'Web Design', 'Life Hack']);

        $categories->each(function ($category) {
            Category::create([
                'name' => $category,
                'slug' => strtolower(str_replace(' ', '-', $category)),
            ]);
        });
    }
}