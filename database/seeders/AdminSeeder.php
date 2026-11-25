<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'rashed@gmail.com',
            ],
            [
                'name' => 'Rashedul',
                'password' => '12345678',
                'role' => 'admin',
            ]
        );
    }
}