<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    protected $fillable =
    [
        'kontak_id',
        'nama',
        'telepon',
        'email',
        'jenis_kelamin',
        'pesan'

    ];
}