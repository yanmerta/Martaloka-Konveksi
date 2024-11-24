<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable =
    [

        'kategori_id',
        'user_id',
        'nama_pemesan',
        'alamat_pemesan',
        'email_pemesan',
        'nomor_hp_pemesan',
        'catatan',
        'user_id',
        'status_pembayaran',
        'total_harga',
        'bukti_pembayaran',
        'no_resi',
        'kurir',
        'metode_pembayaran',
        'delivery',
        'keterangan_tambahan',
        'tujuan_antar',
        'tanggal_ambil'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function detailTransaksi()
    {
        return $this->hasMany(TransaksiProduk::class, 'transaksi_id');
    }

    public function progress()
    {
        return $this->hasMany(ProgressPembelian::class);
    }

    public function cart()
    {

    }
}
