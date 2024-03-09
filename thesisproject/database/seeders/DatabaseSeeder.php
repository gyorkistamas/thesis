<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'SuperAdmin',
            'email' => 'superadmin@presencetracker.com',
            'password' => bcrypt('superadmin'),
            'neptun' => 'SADMIN',
        ]);

        $user->roles()->updateOrCreate(['role' => 'superadmin']);

        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@presencetracker.com',
            'password' => bcrypt('admin'),
            'neptun' => 'ADMIN0',
        ]);
        $user->roles()->updateOrCreate(['role' => 'admin']);

        $user = User::create([
            'name' => 'Teacher',
            'email' => 'teacher@presencetracker.com',
            'password' => bcrypt('teacher'),
            'neptun' => 'TEACHE',
        ]);
        $user->roles()->updateOrCreate(['role' => 'teacher']);

        $user = User::create([
            'name' => 'Student',
            'email' => 'student@presencetracker.com',
            'password' => bcrypt('student'),
            'neptun' => 'STUDEN',
        ]);
        $user->roles()->updateOrCreate(['role' => 'student']);
    }
}
