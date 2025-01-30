<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BungaKeluar extends Model
{
    protected $fillable = ['nama_bunga', 'jumlah_bunga', 'tanggal_keluar','id_bunga','id_bunga_keluar', 'total_harga','status'];
}
