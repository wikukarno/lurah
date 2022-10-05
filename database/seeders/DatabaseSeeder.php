<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // buat akun admin
        User::create([
            'name' => 'Lurah',
            'email' => 'lurah@gmail.com',
            'password' => bcrypt('123456'),
            'roles' => 'Lurah',
            'phone' => '087823432323',
        ]);

        // buat akun staff
        User::create([
            'name' => 'Staff',
            'email' => 'staff@gmail.com',
            'password' => bcrypt('123456'),
            'roles' => 'Staff',
            'phone' => '087823432323',
        ]);

        // buat akun user
        User::create([
            'name' => 'Normansyah',
            'email' => 'norman@gmail.com',
            'password' => bcrypt('123456'),
            'roles' => 'User',
            'phone' => '087823432323',
        ]);
    }
}
