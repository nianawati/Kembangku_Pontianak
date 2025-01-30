<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesananMasuk extends Model
{
    protected $fillable = ['nama_pesanan', 'tanggal_pesanan', 'nama_produk', 'status_pesanan', 'total_tagihan', 'jumlah_pesanan', 'id_bunga_keluar', 'id_barang_keluar','biaya_jasa'];
}
