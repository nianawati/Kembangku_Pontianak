<?php

namespace App\Http\Controllers;

use App\Models\BungaMasuk;
use App\Models\BungaRusak;
use App\Models\Kategoris;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BungaRusakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $BungaRusak = BungaRusak::all();
        return view("admin.rusak.rusakBunga", compact("BungaRusak"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $BungaMasuk = BungaMasuk::all();
        return view("admin.rusak.rusakBungaTambah",compact('BungaMasuk'));
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
                'tanggal_order' => 'required'
            ],
            [
                'id_bunga.required' => 'id bunga wajib diisi',
                'jumlah_bunga.required' => ' jumlah bunga wajib diisi',
                'tanggal_order' => 'Tanggal wajib diisi'
            ]
        );

        $tanggal_order = date('Y-m-d', strtotime($request->tanggal_order));
        $BungaMasuk = BungaMasuk::where("id", $request->id_bunga)->first();
        $Kategori = Kategoris::where("id_bunga",$BungaMasuk->id)->first();
        if ($BungaMasuk === null) {
            return redirect()->route('rusak.bunga.tambah')->withErrors([
                "message" => "Nama bunga tidak ditemukan pada data bunga masuk"
            ]);
        } else {

            if ($BungaMasuk->jumlah_bunga < $request->jumlah_bunga) {
                return redirect()->route('rusak.bunga.tambah')->withErrors([
                    "message" => "Jumlah bunga yang masuk lebih sedikit daripada jumlah bunga yang keluar"
                ]);
            }

            $sisaBungaBagus = $BungaMasuk->jumlah_bunga - $request->jumlah_bunga;
            $BungaMasuk->update([
                "jumlah_bunga" => $sisaBungaBagus
            ]);

            $bungaDijual = $Kategori->jumlah_bunga_dijual;
            if($sisaBungaBagus < $bungaDijual){
                $bungaDijual = $sisaBungaBagus;
            }

            $Kategori->update([
                "jumlah_bunga_dijual" => ($bungaDijual < 0) ? 0 : $bungaDijual 
            ]);

            //tambah data produk
            BungaRusak::insert([
                'id_bunga' => $request->id_bunga,
                'nama_bunga' => $BungaMasuk->nama_bunga,
                'jumlah_bunga' => $request->jumlah_bunga,
                'harga_bunga' => $BungaMasuk->harga_bunga,
                'kategori' => $BungaMasuk->kategori,
                'tanggal_order' => $tanggal_order
            ]);

            return redirect()->route('rusak.bunga');
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
    public function edit(BungaRusak $id)
    {
        return view("admin.rusak.rusakBungaEdit", compact('id'));
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
                'tanggal_order' => 'required'
            ],
            [
                'id_bunga.required' => 'ID bunga wajib diisi',
                'jumlah_bunga.required' => ' jumlah bunga wajib diisi',
                'tanggal_order' => 'Tanggal wajib diisi'
            ]
        );

        $BungaRusak = BungaRusak::where("id",$id)->first();
        $tanggal_order = date('Y-m-d', strtotime($request->tanggal_order));

        //tambah data produk
        $BungaMasuk = BungaMasuk::where("id", $BungaRusak->id_bunga)->first();
        if ($BungaMasuk === null) {
            return redirect()->route('rusak.bunga.tambah')->withErrors([
                "message" => "id bunga tidak ditemukan pada data bunga masuk"
            ]);
        } else {

            if ($BungaMasuk->jumlah_bunga < $request->jumlah_bunga) {
                return redirect()->route('rusak.bunga.tambah')->withErrors([
                    "message" => "Jumlah bunga yang masuk lebih sedikit daripada jumlah bunga yang keluar"
                ]);
            }

            if($request->jumlah_bunga < $BungaRusak->jumlah_bunga){
                $BungaMasuk->update([
                    "jumlah_bunga" => $BungaMasuk->jumlah_bunga + abs($request->jumlah_bunga - $BungaRusak->jumlah_bunga)
                ]);    
            }else{
                $BungaMasuk->update([
                    "jumlah_bunga" => $BungaMasuk->jumlah_bunga - abs($request->jumlah_bunga - $BungaRusak->jumlah_bunga)
                ]);
            }
            //tambah data produk
            BungaRusak::where("id", $id)->update([
                'jumlah_bunga' => $request->jumlah_bunga,
                'tanggal_order' => $tanggal_order
            ]);


        return redirect()->route('rusak.bunga');
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BungaRusak $id)
    {
        $id->delete();

        return redirect()->route(route: 'rusak.bunga')
            ->with('message', 'Data berhasil di hapus');
    }
}
