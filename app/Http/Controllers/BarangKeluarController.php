<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $BarangKeluar = BarangKeluar::all();
        return view("admin.barang.barangKeluar", compact("BarangKeluar"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $BarangMasuk = BarangMasuk::all();
        return view("admin.barang.barangKeluarTambah", compact("BarangMasuk"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // melakukan validasi data
        $request->validate(
            [
                'id_barang' => 'required',
                'jumlah_barang' => 'required',
                'tanggal_keluar' => 'required'
            ],
            [
                'id_barang.required' => 'ID barang wajib diisi',
                'jumlah_barang.required' => ' jumlah barang wajib diisi',
                'tanggal_keluar' => 'Tanggal wajib diisi'
            ]
        );

        $tanggal_keluar = date('Y-m-d', strtotime($request->tanggal_keluar));


        $BarangMasuk = BarangMasuk::where("id", $request->id_barang)->first();
        if ($BarangMasuk === null) {
            return redirect()->route('barang.keluar.tambah')->withErrors([
                "message" => "ID barang tidak ditemukan pada data barang masuk"
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
            BarangKeluar::insert([
                'nama_barang' => $BarangMasuk->nama_barang,
                'jumlah_barang' => $request->jumlah_barang,
                'id_barang' => $request->id_barang,
                'tanggal_keluar' => $tanggal_keluar,
                'id_barang_keluar' => $request->id_barang_keluar,
                'total_harga' => $request->jumlah_barang * $BarangMasuk->harga_barang,
                'status' => "selesai"
            ]);

            return redirect()->route('barang.keluar');
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
    public function edit(BarangKeluar $id)
    {
        return view("admin.barang.barangKeluarEdit", compact('id'));
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
                'tanggal_keluar' => 'required'
            ],
            [
                'id_barang.required' => 'ID barang wajib diisi',
                'jumlah_barang.required' => ' jumlah barang wajib diisi',
                'tanggal_keluar' => 'Tanggal wajib diisi'
            ]
        );

        $tanggal_keluar = date('Y-m-d', strtotime($request->tanggal_keluar));
        
        $BarangKeluar = BarangKeluar::where("id",$id)->first();
        $BarangMasuk = BarangMasuk::where("id", $request->id_barang)->first();
        if ($BarangMasuk === null) {
            return redirect()->route('barang.keluar.tambah')->withErrors([
                "message" => "ID barang tidak ditemukan pada data barang masuk"
            ]);
        } else {

            if ($BarangMasuk->jumlah_barang < $request->jumlah_barang) {
                return redirect()->route('barang.keluar.tambah')->withErrors([
                    "message" => "Jumlah barang yang masuk lebih sedikit daripada jumlah barang yang keluar"
                ]);
            }

            if($request->jumlah_barang < $BarangKeluar->jumlah_barang){
                $BarangMasuk->update([
                    "jumlah_barang" => $BarangMasuk->jumlah_barang + abs(((int) $request->jumlah_barang) - $BarangKeluar->jumlah_barang)
                ]);
            }else{
                $BarangMasuk->update([
                    "jumlah_barang" => $BarangMasuk->jumlah_barang - abs(((int) $request->jumlah_barang) - $BarangKeluar->jumlah_barang)
                ]);
            }


            //tambah data produk
            BarangKeluar::where("id", $id)->update([
                'jumlah_barang' => $request->jumlah_barang,
                'tanggal_keluar' => $tanggal_keluar
            ]);

            return redirect()->route('barang.keluar');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangKeluar $id)
    {
        $id->delete();

        return redirect()->route(route: 'barang.keluar')
            ->with('message', 'Data berhasil di hapus');
    }
}
