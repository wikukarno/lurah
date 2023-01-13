<?php

namespace Database\Seeders;

use App\Models\Letter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LetterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $letter = [
            [
                'id' => 1,
                'jenis_surat' => 'Surat Keterangan Usaha',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'jenis_surat' => 'Surat Keterangan Izin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'jenis_surat' => 'Surat Keterangan Pemakaman',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'jenis_surat' => 'Surat Keterangan Tidak Mampu',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        Letter::insert($letter);
    }
}
