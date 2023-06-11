<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['title' => 'child', 'name' => 'Child', 'level' => 3],
            ['title' => 'parent', 'name' => 'Parent', 'level' => 2],
            // ['title' => 'teacher', 'name' => 'Teacher', 'level' => 3],
            ['title' => 'admin', 'name' => 'Admin', 'level' => 1],
            // ['title' => 'super_admin', 'name' => 'Super Admin', 'level' => 1],
           // ['title' => 'librarian', 'name' => 'librarian', 'level' => 6],
        ];
        DB::table('user_types')->insert($data);
    }
}
