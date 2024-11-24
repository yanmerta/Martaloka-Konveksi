<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomDesign extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'gambar_custom_design',
        'transaksi_custom_design_id'
    ];

    public function transaksiCustom()
    {
        return $this->belongsTo(TransaksiCustomDesign::class);
    }



}
