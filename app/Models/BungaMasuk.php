<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BungaMasuk extends Model
{
    protected $fillable = ['nama_bunga','foto', 'jumlah_bunga', 'harga_bunga', 'harga_beli', 'kategori', 'tanggal_order'];
}
