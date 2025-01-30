<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    protected $fillable = ['nama_barang', 'jumlah_barang', 'tanggal_keluar','id_barang','id_barang_keluar','status'];
    
}
