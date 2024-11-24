<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiProduk;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $produks = Produk::pluck('id')->toArray();
        // $users = User::pluck('id')->toArray();
        $statuses = ['Dalam Transaksi', 'Belum Dibayar', 'Dibayar','Diterima', 'Dibatalkan','Selesai'];
        $metode = ['BNI', 'BCA', 'Mandiri'];
        $size = ['S','M','L','XL','XXL'];
        $delivery = ['Diantar Ke Tempat Pemesan','Ambil Di Martaloka'];

        for ($i = 0; $i < 10; $i++) {
            $total_harga = 0;
            $user_id = 1;
            $transaksi = Transaksi::create([
                'nama_pemesan' => fake()->name(),
                'user_id' => $user_id,
                'status_pembayaran' => $statuses[array_rand($statuses)],
                'metode_pembayaran' => $metode[array_rand($metode)],
                'total_harga' => 0, // Ini akan diperbarui setelah produk ditambahkan
                'delivery' => $delivery[array_rand($delivery)],
                'catatan' => fake()->sentence(),
            ]);

            // Membuat antara 1 hingga 10 produk untuk setiap transaksi
            $jumlahProduk = rand(1, 3);

            for ($j = 0; $j < $jumlahProduk; $j++) {
                $produk_id = $produks[array_rand($produks)];
                $qty = rand(1, 10);
                $harga_produk = Produk::find($produk_id)->harga_produk;

                $total_price = $harga_produk * $qty;
                $total_harga += $total_price;

                TransaksiProduk::create([
                    'transaksi_id' => $transaksi->id,
                    'produk_id' => $produk_id,
                    'total_price' => $total_price,
                    'qty' => $qty,
                    'size' => $size[array_rand($size)],
                ]);
            }

            // Update total harga transaksi
            $transaksi->update(['total_harga' => $total_harga]);
        }
    }
}
