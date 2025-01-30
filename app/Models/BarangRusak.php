<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangRusak extends Model
{
    protected $fillable = ['id_barang','nama_barang', 'jumlah_barang', 'harga_barang', 'kategori', 'tanggal_order'];
}
