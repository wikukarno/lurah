<?php

namespace Database\Seeders;

use App\Models\UserDetails;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
                'id' => Str::uuid(),
                'users_id' => '169a222e-5eeb-414e-9765-59c94e186168',
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
                'id' => Str::uuid(),
                'users_id' => '169a123e-7jkb-414e-9765-59c94e186169',
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
                'id' => Str::uuid(),
                'users_id' => '169a111e-7jkb-414e-9765-59c94e186170',
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
