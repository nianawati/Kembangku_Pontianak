<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\BungaKeluar;
use App\Models\BungaMasuk;
use App\Models\PesananMasuk;
use Illuminate\Http\Request;

class PesananMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $PesananMasuk = PesananMasuk::all();
        return view("admin.pesanan_masuk.pesananMasuk", compact("PesananMasuk"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // melakukan validasi data

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PesananMasuk $id)
    {
        return view("admin.pesanan_masuk.pesananMasukEdit", compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'status_pesanan' => 'required'
            ],
            [
                'status_pesanan.required' => 'Status Pesanan wajib diisi'

            ]
        );

        //tambah data produk
        $Pesanan = PesananMasuk::where("id", $id)->first();

        if ($request->status_pesanan === "dibatalkan" && ($Pesanan->status_pesanan === "diproses" || $Pesanan->status_pesanan === "selesai" || $Pesanan->status_pesanan === "dibatalkan") ) {
            $BungaKeluar = BungaKeluar::where("id_bunga_keluar", $Pesanan->id_bunga_keluar)->get();
            $BarangKeluar = BarangKeluar::where("id_barang_keluar", $Pesanan->id_barang_keluar)->get();

            foreach ($BungaKeluar as $bunga) {
                $bungaMasuk = BungaMasuk::where("id", $bunga->id_bunga)->first();
                $bungaMasuk->update([
                    "jumlah_bunga" => $bungaMasuk->jumlah_bunga + $bunga->jumlah_bunga
                ]);
            }

            BungaKeluar::where("id_bunga_keluar", $Pesanan->id_bunga_keluar)->update([
                "status" => "dibatalkan"
            ]);

            foreach ($BarangKeluar as $barang) {
                $barangMasuk = BarangMasuk::where("id", $barang->id_barang)->first();
                $barangMasuk->update([
                    "jumlah_barang" => $barangMasuk->jumlah_barang + $barang->jumlah_barang
                ]);
                
            }

            BarangKeluar::where("id_barang_keluar", $Pesanan->id_barang_keluar)->update([
                "status" => "dibatalkan"
            ]);

        } else if (($request->status_pesanan === "diproses" || $request->status_pesanan === "selesai") && $Pesanan->status_pesanan === "dibatalkan") {
            $BungaKeluar = BungaKeluar::where("id_bunga_keluar", $Pesanan->id_bunga_keluar)->get();
            $BarangKeluar = BarangKeluar::where("id_barang_keluar", $Pesanan->id_barang_keluar)->get();

            foreach ($BungaKeluar as $bunga) {
                $bungaMasuk = BungaMasuk::where("id", $bunga->id_bunga)->first();
                $bungaMasuk->update([
                    "jumlah_bunga" => $bungaMasuk->jumlah_bunga - $bunga->jumlah_bunga
                ]);
            }
            BungaKeluar::where("id_bunga_keluar", $Pesanan->id_bunga_keluar)->update([
                "status" => "selesai"
            ]);

            foreach ($BarangKeluar as $barang) {
                $barangMasuk = BarangMasuk::where("id", $barang->id_barang)->first();
                $barangMasuk->update([
                    "jumlah_barang" => $barangMasuk->jumlah_barang - $barang->jumlah_barang
                ]);
            }
            BarangKeluar::where("id_barang_keluar", $Pesanan->id_barang_keluar)->update([
                "status" => "selesai"
            ]);

        }

        $Pesanan->update([
            'status_pesanan' => $request->status_pesanan
        ]);


        return redirect()->route('pesanan_masuk.pesananMasuk');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

    }
}
