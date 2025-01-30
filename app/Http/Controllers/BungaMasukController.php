<?php

namespace App\Http\Controllers;

use App\Models\BungaMasuk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BungaMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $BungaMasuk = BungaMasuk::all();
        return view("admin.bunga.bungaMasuk", compact("BungaMasuk"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.bunga.bungaMasukTambah");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // melakukan validasi data
        $request->validate(
            [
                'nama_bunga' => 'required',
                'jumlah_bunga' => 'required',
                'harga_bunga' => 'required',
                'harga_beli' => 'required',
                'kategori'=> 'required',
                'tanggal_order'=> 'required',
                'foto_bunga' => 'required|image|mimes:jpeg,png,jpg,gif|max:10480'
            ],
            [
                'nama_bunga.required' => 'nama bunga wajib diisi',
                'jumlah_bunga.required' => ' jumlah bunga wajib diisi',
                'harga_bunga.required' => 'harga bunga wajib diisi',
                'harga_beli.required' => 'harga beli wajib diisi',
                'kategori.required' => 'Kategori wajib diisi',
                'tanggal_order.required' => 'Tanggal wajib diisi',
                'foto_bunga.required' => 'Foto bunga wajib di isi'
            ]
        );

        $tanggal_order = date('Y-m-d', strtotime($request->tanggal_order));

        if ($request->file('foto_bunga')) {
            $filename = time() . '.' . $request->foto_bunga->extension();
            $request->foto_bunga->move(public_path('foto_bunga'), $filename);
            
            //tambah data produk
            BungaMasuk::insert([
                'nama_bunga' => $request->nama_bunga,
                'jumlah_bunga' => $request->jumlah_bunga,
                'harga_bunga' => $request->harga_bunga,
                'harga_beli' => $request->harga_beli,
                'kategori' => $request->kategori,
                'tanggal_order' => $tanggal_order,
                'foto' => $filename
            ]);
    
            return redirect()->route('bunga.masuk');
        }else{
            return back()->withErrors([
                "message" => "Gagal mengupload foto"
            ]);
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
    public function edit(BungaMasuk $id)
    {
        return view("admin.bunga.bungaMasukEdit", compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // melakukan validasi data
        $request->validate(
            [
                'nama_bunga' => 'required',
                'jumlah_bunga' => 'required',
                'harga_bunga' => 'required',
                'harga_beli' => 'required',
                'kategori'=> 'required',
                'tanggal_order'=> 'required'
            ],
            [
                'nama_bunga.required' => 'nama bunga wajib diisi',
                'jumlah_bunga.required' => ' jumlah bunga wajib diisi',
                'harga_bunga.required' => 'harga bunga wajib diisi',
                'harga_beli.required' => 'harga beli wajib diisi',
                'kategori.required' => 'Kategori wajib diisi',
                'tanggal_order.required' => 'Tanggal wajib diisi'
            ]
        );

        $tanggal_order = date('Y-m-d', strtotime($request->tanggal_order));
        $bunga = BungaMasuk::where("id", $id)->first();

        if ($request->file('foto_bunga')) {
            $filename = time() . '.' . $request->foto_bunga->extension();
            if (File::exists(public_path('foto_bunga/').$bunga->foto)) {
                File::delete(public_path('foto_bunga/').$bunga->foto);
            }
            $request->foto_bunga->move(public_path('foto_bunga'), $filename);
            //tambah data produk
            $bunga->update([
                'nama_bunga' => $request->nama_bunga,
                'jumlah_bunga' => $request->jumlah_bunga,
                'harga_bunga' => $request->harga_bunga,
                'harga_beli' => $request->harga_beli,
                'kategori' => $request->kategori,
                'tanggal_order' => $tanggal_order,
                'foto' => $filename
            ]);
    
            return redirect()->route('bunga.masuk');
        }else{
            $bunga->update([
                'nama_bunga' => $request->nama_bunga,
                'jumlah_bunga' => $request->jumlah_bunga,
                'harga_bunga' => $request->harga_bunga,
                'harga_beli' => $request->harga_beli,
                'kategori' => $request->kategori,
                'tanggal_order' => $tanggal_order
            ]);
            return redirect()->route('bunga.masuk');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BungaMasuk $id)
    {
        if (File::exists(public_path('foto_bunga/').$id->foto)) {
            File::delete(public_path('foto_bunga/').$id->foto);
        }
        $id->delete();
    
        return redirect()->route(route: 'bunga.masuk')
                ->with('message','Data berhasil di hapus' );
    }
}
