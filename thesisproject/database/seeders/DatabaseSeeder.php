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
        $user = User::firstOrCreate([
            'id' => 0,
            'name' => 'SuperAdmin',
            'email' => 'superadmin@presencetracker.com',
            'password' => bcrypt('superadmin'),
            'neptun' => 'SADMIN',
        ]);

        $user->roles()->updateOrCreate(['role' => 'superadmin']);

        $user = User::firstOrCreate([
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admin@presencetracker.com',
            'password' => bcrypt('admin'),
            'neptun' => 'ADMIN0',
        ]);
        $user->roles()->updateOrCreate(['role' => 'admin']);

        $user = User::firstOrCreate([
            'id' => 2,
            'name' => 'Teacher',
            'email' => 'teacher@presencetracker.com',
            'password' => bcrypt('teacher'),
            'neptun' => 'TEACHE',
        ]);
        $user->roles()->updateOrCreate(['role' => 'teacher']);

        $user = User::firstOrCreate([
            'id' => 2,
            'name' => 'Student',
            'email' => 'student@presencetracker.com',
            'password' => bcrypt('student'),
            'neptun' => 'STUDEN',
        ]);
        $user->roles()->updateOrCreate(['role' => 'student']);
    }
}
