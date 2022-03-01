<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = collect(['admin', 'author', 'user']);

        $roles->each(function ($role) {
            Role::create([
                'name' => $role
            ]);
        });
    }
}