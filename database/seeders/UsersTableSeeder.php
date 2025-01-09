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
        $users = DB::table('users')->get();
        foreach ($users as $user) {
            DB::table('users')->where('id', $user->id)->update(['department_id' => $this->getRandomDepartmentId()]);
        }
    }

    private function getRandomDepartmentId()
    {
        $departments = DB::table('departments')->pluck('id');
        return $departments->random();
    }
}
