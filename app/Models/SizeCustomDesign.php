<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SizeCustomDesign extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'transaksi_custom_design_id',
        'co_s',
        'co_m',
        'co_l',
        'co_xl',
        'co_xxl',
        'co_l1',
        'co_l2',
        'co_l3',
        'co_l4',
        'ce_s',
        'ce_m',
        'ce_l',
        'ce_xl',
        'ce_xxl',
        'ce_l1',
        'ce_l2',
        'ce_l3',
        'ce_l4'
    ];



    public function transaksiCustomDesign()
    {
        return $this->belongsTo(TransaksiCustomDesign::class);
    }
}
