<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;
    protected $fillable =
    [
        'status',
        'user_id',
        'produk_id',
        'size',
        'qty',

    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
