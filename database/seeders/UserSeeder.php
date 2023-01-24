<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'id' => 1,
                'name' => 'Lurah',
                'email' => 'lurah@gmail.com',
                'password' => bcrypt('123456'),
                'roles' => 'Lurah',
                'status_account' => 'verifikasi',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 2,
                'name' => 'Staff',
                'email' => 'staff@gmail.com',
                'password' => bcrypt('123456'),
                'roles' => 'Staff',
                'status_account' => 'verifikasi',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => 3,
                'name' => 'Normansyah',
                'email' => 'norman@gmail.com',
                'password' => bcrypt('123456'),
                'roles' => 'User',
                'status_account' => 'verifikasi',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        User::insert($user);
    }
}
