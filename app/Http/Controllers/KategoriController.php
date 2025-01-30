<?php

namespace App\Http\Controllers;

use App\Models\BungaMasuk;
use App\Models\Kategoris;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = DB::table("kategoris")
        ->join('bunga_masuks','kategoris.id_bunga','=','bunga_masuks.id')
        ->select('*', 'kategoris.id as id')
        ->get();
        return view("admin.produk.kategori", compact("kategori"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $queryGetBungaData = "SELECT bunga_masuks.*
        FROM bunga_masuks 
        LEFT JOIN kategoris ON bunga_masuks.id = kategoris.id_bunga
        WHERE kategoris.id_bunga is NULL;";
        $BungaMasuk = DB::select($queryGetBungaData);
        return view("admin.produk.kategoriTambah",compact('BungaMasuk'));
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
                'jumlah_bunga_dijual' => 'required'
            ],
            [
                'id_bunga.required' => 'id bunga wajib diisi',
                'jumlah_bunga_dijual.required' => 'jumlah bunga bunga wajib diisi'
            ]
        );

        $BungaMasuk = BungaMasuk::where("id",$request->id_bunga)->first();
        if ($BungaMasuk === null) {
            return redirect()->route('produk.kategori.tambah')->withErrors([
                "message" => "ID bunga tidak ditemukan pada data bunga masuk"
            ]);
        } else {

            if ($BungaMasuk->jumlah_bunga < $request->jumlah_bunga_dijual) {
                return redirect()->route('produk.kategori.tambah')->withErrors([
                    "message" => "Jumlah bunga yang masuk lebih sedikit daripada jumlah bunga yang akan dijual"
                ]);
            }

            //tambah data produk
            Kategoris::insert([
                'id_bunga' => $request->id_bunga,
                'jumlah_bunga_dijual' => $request->jumlah_bunga_dijual
            ]);
    
            return redirect()->route('produk.kategori');
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
    public function edit(Kategoris $id)
    {
        $BungaMasuk = BungaMasuk::where("id",$id->id_bunga)->first();
        return view("admin.produk.kategoriEdit", compact('id','BungaMasuk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // melakukan validasi data
        $request->validate(
            [
                'jumlah_bunga_dijual' => 'required'
            ],
            [
                'jumlah_bunga_dijual.required' => 'jumlah bunga bunga wajib diisi'
            ]
        );

        $Kategori = Kategoris::where("id",$id)->first();
        $BungaMasuk = BungaMasuk::where("id",$Kategori->id_bunga)->first();
        if ($BungaMasuk === null) {
            return redirect()->route('produk.kategori.tambah')->withErrors([
                "message" => "ID bunga tidak ditemukan pada data bunga masuk"
            ]);
        } else {

            if ($BungaMasuk->jumlah_bunga < $request->jumlah_bunga_dijual) {
                return redirect()->route('produk.kategori.edit',["id" => $id])->withErrors([
                    "message" => "Jumlah bunga yang masuk lebih sedikit daripada jumlah bunga yang akan dijual"
                ]);
            }

            $Kategori->update([
                "jumlah_bunga_dijual" => $request->jumlah_bunga_dijual
            ]);

            return redirect()->route('produk.kategori');

        }

    }

    /**
     * Remove the specified resource from storage.
     */         
    public function destroy(Kategoris $id)
    {
        $id->delete();
    
        return redirect()->route(route: 'produk.kategori')
                ->with('message','Data berhasil di hapus' );
    }
}
