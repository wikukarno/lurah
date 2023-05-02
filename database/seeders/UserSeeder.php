<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
                'id' => '169a222e-5eeb-414e-9765-59c94e186168',
                'nama' => 'Lurah',
                'email' => 'lurah@gmail.com',
                'nik' => '1234567890123456',
                'no_telepon' => '081234567890',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1990-01-01',
                'pekerjaan' => 'PNS',
                'rtrw' => '001/001',
                'kelurahan' => 'Sorek Satu',
                'kecamatan' => 'Sorek',
                'agama' => 'Islam',
                'status_perkawinan' => 'Kawin',
                'alamat' => 'Jl. Raya Bogor Km. 46, Cibinong, Bogor',
                'password' => bcrypt('123456'),
                'roles' => 'Lurah',
                'status_account' => 'verifikasi',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '169a123e-7jkb-414e-9765-59c94e186169',
                'nama' => 'Staff',
                'email' => 'staff@gmail.com',
                'nik' => '1234567890123454',
                'no_telepon' => '081234567890',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1990-01-01',
                'pekerjaan' => 'PNS',
                'rtrw' => '001/001',
                'kelurahan' => 'Sorek Satu',
                'kecamatan' => 'Sorek',
                'agama' => 'Islam',
                'status_perkawinan' => 'Kawin',
                'alamat' => 'Jl. Raya Bogor Km. 46, Cibinong, Bogor',
                'password' => bcrypt('123456'),
                'roles' => 'Staff',
                'status_account' => 'verifikasi',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id' => '169a111e-7jkb-414e-9765-59c94e186170',
                'nama' => 'Normansyah',
                'email' => 'norman@gmail.com',
                'nik' => '1234567890123455',
                'no_telepon' => '081234567890',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1990-01-01',
                'pekerjaan' => 'PNS',
                'rtrw' => '001/001',
                'kelurahan' => 'Sorek Satu',
                'kecamatan' => 'Sorek',
                'agama' => 'Islam',
                'status_perkawinan' => 'Kawin',
                'alamat' => 'Jl. Raya Bogor Km. 46, Cibinong, Bogor',
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
