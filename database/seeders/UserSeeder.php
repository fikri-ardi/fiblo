<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'role_id' => 1,
            'name' => 'Fikri',
            'username' => 'fikri',
            'email' => 'fikri@gmail.com',
            'bio' => 'Seorang IT antusias yang suka main gitar, nyanyi. Hobi futsal, ngoding, bikin eksperimen, dan suka mencoba hal yang jarang dilakukan orang lain.',
            'password' => 'password',
        ]);
    }
}