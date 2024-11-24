<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Kategori;
use App\Models\CustomDesign;
use Illuminate\Database\Seeder;
use App\Models\SizeCustomDesign;
use App\Models\TransaksiCustomDesign;
use Faker\Factory as Faker;


class CustomDesignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $faker = Faker::create();
        $users = User::pluck('id')->toArray();
        $kategori = Kategori::pluck('id')->toArray();
        $statuses = ['Dalam Transaksi', 'Belum Dibayar', 'Dibayar','Diterima', 'Dibatalkan','Selesai'];
        $metode = ['BNI', 'BCA', 'Mandiri'];
        $delivery = ['Diantar Ke Tempat Pemesan','Ambil Di Martaloka'];

        for ($i = 0; $i < 10; $i++) {
            $kategori_id = $kategori[array_rand($kategori)];
            $user_id = $users[array_rand($users)];
            $harga_kategori = Kategori::find($kategori_id)->harga_kategori;
            $total_pesanan = rand(1, 10); // Jumlah pesanan acak

            $transaksi = TransaksiCustomDesign::create([
                'nama_custom' => 'Custom Design' . ' - ' . $faker->name,
                'kategori_id' => $kategori_id,
                'user_id' => $user_id,
                'nama_pemesan' => $faker->name,
                'alamat_pemesan' => $faker->address,
                'email_pemesan' => $faker->email,
                'nomor_hp_pemesan' => $faker->phoneNumber,
                'catatan' => $faker->sentence,
                'total_pesanan' => $total_pesanan,
                'total_harga' => $total_pesanan * $harga_kategori,
                'status_pembayaran' => $statuses[array_rand($statuses)],
                'metode_pembayaran' => $metode[array_rand($metode)],
                'delivery' => $delivery[array_rand($delivery)],
            ]);

            SizeCustomDesign::create([
                'transaksi_custom_design_id' => $transaksi->id,
                'co_s' => rand(0, 5),
                'co_m' => rand(0, 5),
                'co_l' => rand(0, 5),
                'co_xl' => rand(0, 5),
                'co_xxl' => rand(0, 5),
                'ce_s' => rand(0, 5),
                'ce_m' => rand(0, 5),
                'ce_l' => rand(0, 5),
                'ce_xl' => rand(0, 5),
                'ce_xxl' => rand(0, 5),
            ]);

            for ($j = 0; $j < rand(1, 3); $j++) {
                CustomDesign::create([
                    'transaksi_custom_design_id' => $transaksi->id,
                    'gambar_custom_design' => $faker->imageUrl(640, 480, 'fashion', true, 'custom'),
                ]);
            }
        }
    }
}
