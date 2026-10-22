<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Default User
        User::create([
            'name' => 'Admin Woman',
            'email' => 'adminwoman@gmail.com',
            'password' => Hash::make('12345'),
        ]);

        // 2. Create Departments
        $mis = Department::create([
            'dept_name' => 'Management Information System', 
            'manager_id' => 1, 
            'location_id' => 101
        ]);
        
        $design = Department::create([
            'dept_name' => 'Design', 
            'manager_id' => 2, 
            'location_id' => 102
        ]);

        // 3. Create Sample Students
        Student::create([
            'student_name' => 'Kong Sopheak',
            'email' => 'kongsopheak@gmail.com',
            'gender' => 'Male',
            'enrollment_date' => '2022-01-01',
            'description' => null,
            'dept_id' => $mis->dept_id
        ]);

        Student::create([
            'student_name' => 'Ly Chhailin',
            'email' => 'lin@gmail.com',
            'gender' => 'Female',
            'enrollment_date' => '2022-01-01',
            'description' => null,
            'dept_id' => $design->dept_id
        ]);

        Student::create([
            'student_name' => 'Pov Nita',
            'email' => 'povnita@gmail.com',
            'gender' => 'Female',
            'enrollment_date' => '2023-04-11',
            'description' => 'OK',
            'dept_id' => $mis->dept_id
        ]);

        Student::create([
            'student_name' => 'Leng Makara',
            'email' => 'lengmakara@gmail.com',
            'gender' => 'Male',
            'enrollment_date' => '2024-11-01',
            'description' => null,
            'dept_id' => $design->dept_id
        ]);
    }
}