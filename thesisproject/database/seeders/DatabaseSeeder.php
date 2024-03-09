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
            'name' => 'Admin',
            'email' => 'basicadmin@basicadmin.com',
            'password' => bcrypt('admin'),
            'neptun' => '000000',
        ]);

        $user->roles()->updateOrCreate(['role' => 'superadmin']);
    }
}
