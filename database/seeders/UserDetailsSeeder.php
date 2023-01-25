<?php

namespace Database\Seeders;

use App\Models\UserDetails;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userDetails = [
            [
                'id' => 1,
                'users_id' => 1,
                'nik' => '1234567890123456',
                'phone' => '081234567890',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1990-01-01',
                'pekerjaan' => 'PNS',
                'rtrw' => '001/001',
                'kelurahan' => 'Sorek Satu',
                'kecamatan' => 'Sorek',
                'agama' => 'Islam',
                'status_perkawinan' => 'Kawin',
                'address' => 'Jl. Raya Bogor Km. 46, Cibinong, Bogor',
                'created_at' => now(),
                'updated_at'=> now()
            ],
            [
                'id' => 2,
                'users_id' => 2,
                'nik' => '1234567890123454',
                'phone' => '081234567890',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1990-01-01',
                'pekerjaan' => 'PNS',
                'rtrw' => '001/001',
                'kelurahan' => 'Sorek Satu',
                'kecamatan' => 'Sorek',
                'agama' => 'Islam',
                'status_perkawinan' => 'Kawin',
                'address' => 'Jl. Raya Bogor Km. 46, Cibinong, Bogor',
                'created_at' => now(),
                'updated_at'=> now()
            ],
            [
                'id' => 3,
                'users_id' => 3,
                'nik' => '1234567890123455',
                'phone' => '081234567890',
                'jenis_kelamin' => 'Laki-laki',
                'tempat_lahir' => 'Jakarta',
                'tanggal_lahir' => '1990-01-01',
                'pekerjaan' => 'PNS',
                'rtrw' => '001/001',
                'kelurahan' => 'Sorek Satu',
                'kecamatan' => 'Sorek',
                'agama' => 'Islam',
                'status_perkawinan' => 'Kawin',
                'address' => 'Jl. Raya Bogor Km. 46, Cibinong, Bogor',
                'created_at' => now(),
                'updated_at'=> now()
            ],
        ];

        UserDetails::insert($userDetails);
    }
}
