<?php

namespace Database\Seeders;

use App\Models\ChildRecord;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ChildsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createStudentRecord();
        $this->createManyStudentRecords(3);
    }

    protected function createManyStudentRecords(int $count)
    {
        // $sections = Section::all();

        // foreach ($sections as $section){
          User::factory()
                ->has(
                    ChildRecord::factory()
                    ->state([
                    // 'section_id' => $section->id,
                    // 'my_class_id' => $section->my_class_id,
                    'user_id' => function(User $user){
                        return ['user_id' => $user->id];
                    },
                ]), 'child_record')
                ->count($count)
                ->create([
                    'user_type' => 'child',
                    'password' => Hash::make('123'),
                ]);
        // }

    }

    protected function createStudentRecord()
    {
        // $section = Section::first();

        $user = User::factory()->create([
            'name' => 'Child CJ',
            'user_type' => 'child',
            'username' => 'childstudent',
            'password' => Hash::make('123'),
            'email' => 'child3@child3.com',

        ]);

        ChildRecord::factory()->create([
            // 'my_income_id' => $income->id,
            'user_id' => $user->id,
            // 'my_expense_id' => $expense->id
        ]);
    }
}
