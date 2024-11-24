<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressPembelian extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'nama_progress',
        'deskripsi_progres',
        'gambar_progress',
        'transaksi_id'
    ];


    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class,'transaksi_id','id');
    }
}
