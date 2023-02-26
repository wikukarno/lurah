<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
                'id' => 1,
                'name' => 'Surat Keterangan Usaha',
                'created_at' => now(),
                'updated_at'=> now(),
                'deleted_at' => null
            ],

            [
                'id' => 2,
                'name' => 'Surat Keterangan Izin',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null
            ],

            [
                'id' => 3,
                'name' => 'Surat Keterangan Tidak Mampu',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null
            ],
            [
                'id' => 4,
                'name' => 'Surat Keterangan Pemakaman',
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null
            ]
        ];

        Category::insert($category);
    }

}
