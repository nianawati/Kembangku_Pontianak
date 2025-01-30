<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\BarangRusak;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BarangRusakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $BarangRusak = BarangRusak::all();
        return view("admin.rusak.rusakBarang", compact("BarangRusak"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $BarangMasuk = BarangMasuk::all();
        return view("admin.rusak.rusakBarangTambah",compact('BarangMasuk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // melakukan validasi data
        $request->validate(
            [
                'jumlah_barang' => 'required',
                'id_barang' => 'required',
                'tanggal_order' => 'required'
            ],
            [
                'jumlah_barang.required' => ' jumlah barang wajib diisi',
                'id_barang.required' => ' id barang wajib diisi',
                'tanggal_order' => 'Tanggal wajib diisi'
            ]
        );

        $tanggal_order = date('Y-m-d', strtotime($request->tanggal_order));

        $BarangMasuk = BarangMasuk::where("id", $request->id_barang)->first();
        if ($BarangMasuk === null) {
            return redirect()->route('rusak.barang.tambah')->withErrors([
                "message" => "Nama barang tidak ditemukan pada data barang masuk"
            ]);
        } else {

            if ($BarangMasuk->jumlah_barang < $request->jumlah_barang) {
                return redirect()->route('barang.keluar.tambah')->withErrors([
                    "message" => "Jumlah barang yang masuk lebih sedikit daripada jumlah barang yang keluar"
                ]);
            }

            $BarangMasuk->update([
                "jumlah_barang" => $BarangMasuk->jumlah_barang - $request->jumlah_barang
            ]);


            //tambah data produk
            BarangRusak::insert([
                'ID_barang' => $request->id_barang,
                'nama_barang' => $BarangMasuk->nama_barang,
                'jumlah_barang' => $request->jumlah_barang,
                'harga_barang' => $BarangMasuk->harga_barang,
                'kategori' => $BarangMasuk->kategori,
                'tanggal_order' => $tanggal_order
            ]);

            return redirect()->route('rusak.barang');
        }
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
    public function edit(BarangRusak $id)
    {
        return view("admin.rusak.rusakBarangEdit", compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // melakukan validasi data
        $request->validate(
            [
                'id_barang' => 'required',
                'jumlah_barang' => 'required',
                'tanggal_order' => 'required'
            ],
            [
                'id_barang.required' => 'nama barang wajib diisi',
                'jumlah_barang.required' => ' jumlah barang wajib diisi',
                'tanggal_order' => 'Tanggal wajib diisi'
            ]
        );
        
        $BarangRusak = BarangRusak::where("id",$id)->first();
        $tanggal_order = date('Y-m-d', strtotime($request->tanggal_order));

        //tambah data produk
        $BarangMasuk = BarangMasuk::where("id", $BarangRusak->id_barang)->first();
        if ($BarangMasuk === null) {
            return redirect()->route('rusak.barang.tambah')->withErrors([
                "message" => "id barang tidak ditemukan pada data barang masuk"
            ]);
        } else {

            if ($BarangMasuk->jumlah_barang < $request->jumlah_barang) {
                return redirect()->route('rusak.barang.tambah')->withErrors([
                    "message" => "Jumlah barang yang masuk lebih sedikit daripada jumlah barang yang keluar"
                ]);
            }

            if($request->jumlah_barang < $BarangRusak->jumlah_barang){
                $BarangMasuk->update([
                    "jumlah_barang" => $BarangMasuk->jumlah_barang + abs($request->jumlah_barang - $BarangRusak->jumlah_barang)
                ]);    
            }else{
                $BarangMasuk->update([
                    "jumlah_barang" => $BarangMasuk->jumlah_barang - abs($request->jumlah_barang - $BarangRusak->jumlah_barang)
                ]);
            }
            //tambah data produk
            BarangRusak::where("id", $id)->update([
                'jumlah_barang' => $request->jumlah_barang,
                'tanggal_order' => $tanggal_order
            ]);

        return redirect()->route('rusak.barang');
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangRusak $id)
    {
        $id->delete();

        return redirect()->route(route: 'rusak.barang')
            ->with('message', 'Data berhasil di hapus');
    }
}
