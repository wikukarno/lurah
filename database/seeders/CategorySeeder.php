<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\KategoriSurat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            [
                'id' => Str::uuid(),
                'nama' => 'Surat Keterangan Usaha',
                'created_at' => now(),
                'updated_at'=> now(),
                'deleted_at' => null
            ],

            [
                'id' => Str::uuid(),
                'nama' => 'Surat Keterangan Izin',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null
            ],

            [
                'id' => Str::uuid(),
                'nama' => 'Surat Keterangan Tidak Mampu',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null
            ],
            [
                'id' => Str::uuid(),
                'nama' => 'Surat Keterangan Pemakaman',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null
            ]
        ];

        KategoriSurat::insert($category);
    }

}
