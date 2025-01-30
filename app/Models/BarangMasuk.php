<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    protected $fillable = ['nama_barang', 'jumlah_barang', 'harga_beli', 'harga_barang', 'tanggal_order','kategori','foto'];
}
