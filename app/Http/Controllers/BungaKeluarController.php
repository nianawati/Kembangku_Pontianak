<?php

namespace App\Http\Controllers;

use App\Models\BungaKeluar;
use App\Models\BungaMasuk;
use App\Models\Kategoris;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BungaKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $BungaKeluar = BungaKeluar::all();
        return view("admin.bunga.bungaKeluar", compact("BungaKeluar"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $BungaMasuk = BungaMasuk::all();
        return view("admin.bunga.bungaKeluarTambah", compact("BungaMasuk"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // melakukan validasi data
        $request->validate(
            [
                'id_bunga' => 'required',
                'jumlah_bunga' => 'required',
                'tanggal_keluar' => 'required',
                'id_bunga_masuk' => 'require'
            ],
            [
                'id_bunga.required' => 'ID bunga wajib diisi',
                'jumlah_bunga.required' => ' jumlah bunga wajib diisi',
                'tanggal_keluar.require' => 'Tanggal wajib diisi',
                'id_bunga_masuk.required' => 'id bunga masuk harus di tambahkan'
            ]
        );

        $tanggal_keluar = date('Y-m-d', strtotime($request->tanggal_keluar));

        $BungaMasuk = BungaMasuk::where("id", $request->id_bunga)->first();
        if ($BungaMasuk === null) {
            return redirect()->route('bunga.keluar.tambah')->withErrors([
                "message" => "id bunga tidak ditemukan pada data bunga masuk"
            ]);
        } else {

            if ($BungaMasuk->jumlah_bunga < $request->jumlah_bunga) {
                return redirect()->route('bunga.keluar.tambah')->withErrors([
                    "message" => "Jumlah bunga yang masuk lebih sedikit daripada jumlah bunga yang keluar"
                ]);
            }

            $BungaMasuk->update([
                "jumlah_bunga" => $BungaMasuk->jumlah_bunga - $request->jumlah_bunga
            ]);

            //tambah data produk
            BungaKeluar::insert([
                'nama_bunga' => $BungaMasuk->nama_bunga,
                'jumlah_bunga' => $request->jumlah_bunga,
                'id_bunga' => $request->id_bunga,
                'tanggal_keluar' => $tanggal_keluar,
                'id_bunga_keluar' => $request->id_bunga_keluar,
                'total_harga' => $request->jumlah_bunga * $BungaMasuk->harga_bunga,
                'status' => "selesai"
            ]);

            return redirect()->route('bunga.keluar');
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
    public function edit(BungaKeluar $id)
    {
        return view("admin.bunga.bungaKeluarEdit", compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // melakukan validasi data
        $request->validate(
            [
                'id_bunga' => 'required',
                'jumlah_bunga' => 'required',
                'tanggal_keluar' => 'required'
            ],
            [
                'id_bunga.required' => 'ID bunga wajib diisi',
                'jumlah_bunga.required' => ' jumlah bunga wajib diisi',
                'tanggal_keluar' => 'Tanggal wajib diisi'
            ]
        );

        $BungaKeluar = BungaKeluar::where("id",$id)->first();
        $tanggal_keluar = date('Y-m-d', strtotime($request->tanggal_keluar));

        $BungaMasuk = BungaMasuk::where("id", $BungaKeluar->id_bunga)->first();
        if ($BungaMasuk === null) {
            return redirect()->route('bunga.keluar.tambah')->withErrors([
                "message" => "id bunga tidak ditemukan pada data bunga masuk"
            ]);
        } else {

            if ($BungaMasuk->jumlah_bunga < $request->jumlah_bunga) {
                return redirect()->route('bunga.keluar.tambah')->withErrors([
                    "message" => "Jumlah bunga yang masuk lebih sedikit daripada jumlah bunga yang keluar"
                ]);
            }

            if($request->jumlah_bunga < $BungaKeluar->jumlah_bunga){
                $BungaMasuk->update([
                    "jumlah_bunga" => $BungaMasuk->jumlah_bunga + abs($request->jumlah_bunga - $BungaKeluar->jumlah_bunga)
                ]);    
            }else{
                $BungaMasuk->update([
                    "jumlah_bunga" => $BungaMasuk->jumlah_bunga - abs($request->jumlah_bunga - $BungaKeluar->jumlah_bunga)
                ]);
            }
            //tambah data produk
            BungaKeluar::where("id", $id)->update([
                'jumlah_bunga' => $request->jumlah_bunga,
                'tanggal_keluar' => $tanggal_keluar
            ]);

            return redirect()->route('bunga.keluar');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BungaKeluar $id)
    {
        $id->delete();

        return redirect()->route(route: 'bunga.keluar')
            ->with('message', 'Data berhasil di hapus');
    }
}
