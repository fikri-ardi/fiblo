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
        $categories = collect(['Web Design', 'Life Style', 'Football', 'Film', 'Kitchen', 'Nature', 'Night Sky']);

        $categories->each(function ($category) {
            Category::create([
                'name' => $category,
                'slug' => strtolower(str_replace(' ', '-', $category)),
            ]);
        });
    }
}