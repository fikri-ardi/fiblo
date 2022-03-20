<?php

namespace Database\Factories;

use App\Models\{Category, User};
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function getCategories()
    {
        return count(Category::get(["id"]));
    }

    public function getUsers()
    {
        return count(User::get(["id"]));
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => mt_rand(1, $this->getCategories()),
            'user_id' => mt_rand(1, $this->getUsers()),
            'title' => $this->faker->sentence(mt_rand(2, 9)),
            'slug' => $this->faker->unique()->slug(),
            'excerpt' => $this->faker->paragraph(),
            'body' => collect($this->faker->paragraphs(mt_rand(5, 9)))->map(fn ($paragraph) => "<p>$paragraph</p>")->implode(''),
            'status' => collect(['draft', 'published'])->random()
        ];
    }
}