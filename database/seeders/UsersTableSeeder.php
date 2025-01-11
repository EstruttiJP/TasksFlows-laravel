<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = DB::table('departments')->pluck('id');
        // Atualizar o `department_id` dos usuários 
        DB::table('users')->orderBy('id')->chunk(100, function ($users) use ($departments) {
            foreach ($users as $user) {
                $randomDepartmentId = $departments->random();
                DB::table('users')->where('id', $user->id)->update(['department_id' => $randomDepartmentId]); } });
    }
}
