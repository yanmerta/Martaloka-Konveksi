<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'message', 'type', 'read_at', 'data'
    ];

    protected $casts = [
        'data' => 'array',
    ];

    // Mengecek apakah notifikasi sudah dibaca
    public function isRead()
    {
        return !is_null($this->read_at);
    }
}
