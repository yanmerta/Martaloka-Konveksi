<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategoris')->insert([
            [
                'harga_kategori' => rand(10000, 100000),
                'nama_kategori' => 'Polo',

            ],
            [
                'harga_kategori' => rand(10000, 100000),
                'nama_kategori' => 'Jersey',

            ],
            [
                'harga_kategori' => rand(10000, 100000),
                'nama_kategori' => 'V Neck',

            ],
            [
                'harga_kategori' => rand(10000, 100000),
                'nama_kategori' => 'Hoodie',

            ],
            [
                'harga_kategori' => rand(10000, 100000),
                'nama_kategori' => 'Kemeja',

            ],
            [
                'harga_kategori' => rand(10000, 100000),
                'nama_kategori' => 'Tanktop',

            ],
            [
                'harga_kategori' => rand(10000, 100000),
                'nama_kategori' => 'Sweatshirt',

            ],
            [
                'harga_kategori' => rand(10000, 100000),
                'nama_kategori' => 'Kaos',

            ],
            [
                'harga_kategori' => rand(10000, 100000),
                'nama_kategori' => 'Striped Shirt',

            ],
        ]);
    }
}
