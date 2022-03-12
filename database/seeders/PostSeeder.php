<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
            'category_id' => 1,
            'user_id' => 1,
            'title' => 'Ini Judul Post Pertama',
            'slug' => 'ini-judul-post-pertama',
            'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur voluptate fugiat nesciunt, corporis soluta incidunt dolor laudantium nulla fuga? At laudantium impedit quisquam incidunt suscipit unde recusandae natus libero nostrum.',
            'body' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Possimus laboriosam veritatis neque, nihil voluptas recusandae ex sunt, inventore officiis repellendus reprehenderit, quis fugiat perspiciatis. Eos neque inventore reprehenderit veritatis labore veniam? Quaerat, quis excepturi aliquid et repudiandae eos ipsam consequuntur, doloribus saepe minus ipsum officiis odio enim similique eveniet illum quos, numquam nulla laboriosam! Aliquid maiores animi officiis harum sed dignissimos ipsa, est veniam minus placeat earum accusantium sapiente numquam inventore eum sit. Necessitatibus, sed aliquam architecto modi enim dicta quisquam excepturi a, voluptatem hic perspiciatis aliquid optio amet maxime sint odit natus? Eos, cupiditate minima commodi quam pariatur atque?',
        ]);
    }
}