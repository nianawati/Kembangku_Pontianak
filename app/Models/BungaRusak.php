<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BungaRusak extends Model
{
    protected $fillable = ['id_bunga','nama_bunga', 'jumlah_bunga', 'harga_bunga', 'kategori', 'tanggal_order'];
}
