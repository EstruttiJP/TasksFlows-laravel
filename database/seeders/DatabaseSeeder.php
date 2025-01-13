<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(30)->create();

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => 'admin123'
        ]);

        for ($userId = 1; $userId <= 30; $userId++) {
            DB::table('role_user')->insert(['role_id' => 3, 'user_id' => $userId,]);
        }
        // Atribuir o cargo de admin (id 1) ao usuário com id 31 
        DB::table('role_user')->insert(['role_id' => 1, 'user_id' => 31,]);
    }
}
