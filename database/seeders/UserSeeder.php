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
            'email' => 'fan10062003@gmail.com',
            'bio' => 'Seorang IT antusias yang suka main gitar, nyanyi. Hobi futsal, ngoding, bikin eksperimen, dan suka mencoba sesuatu yang beda.',
            'password' => 'password',
            'email_verified_at' => now(),
        ]);
    }
}