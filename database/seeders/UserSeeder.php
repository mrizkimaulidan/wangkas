<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administator',
            'email' => 'admin@mail.com',
            'password' => bcrypt('secret'),
        ]);

        User::factory()->count(20)->create();
    }
}
