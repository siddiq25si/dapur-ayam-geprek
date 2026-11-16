<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaturanWeb extends Model
{
    use HasFactory;

    protected $table = 'pengaturan_web';
    protected $primaryKey = 'id_pengaturan';

    protected $fillable = [
        'jam_buka',
        'no_whatsapp',
        'status_halal',
    ];
}
