<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $kategori = Kategori::pluck('id')->toArray();

        $gambarProduk = array_diff(scandir(public_path('sample-produk')), ['..', '.']);
        // Array produk yang akan diinsert
        $produks = [];

        // Pastikan setiap kategori memiliki minimal 1 produk
        foreach (range(5, 10) as $i) {
            $produk = [
                'nama_produk' => 'Produk ' . $i,
                'deskripsi' => 'Deskripsi produk ' . $i,
                'harga_produk' => rand(100, 999) * 1000,
                'stok' => rand(1, 10),
                'gambar_produk' => $gambarProduk[array_rand($gambarProduk)],
                'kategori_id' => $kategori[array_rand($kategori)],
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $produks[] = $produk;
        }

        $inserts = $produks;

        // Insert produk yang sudah dikumpulkan ke dalam database
        DB::table('produks')->insert($inserts);
    }
}
