<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $BarangMasuk = BarangMasuk::all();
        return view("admin.barang.barangMasuk", compact("BarangMasuk"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.barang.barangMasukTambah");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // melakukan validasi data
        $request->validate(
            [
                'nama_barang' => 'required',
                'jumlah_barang' => 'required',
                'harga_beli' => 'required',
                'harga_barang' => 'required',
                'kategori' => 'required',
                'tanggal_order'=> 'required',
                'foto_barang' => 'required|image|mimes:jpeg,png,jpg,gif|max:10480'
            ],
            [
                'nama_barang.required' => 'nama barang wajib diisi',
                'jumlah_barang.required' => ' jumlah barang wajib diisi',
                'harga_beli.required' => 'harga beli wajib diisi',
                'harga_barang.required' => 'harga barang wajib diisi',
                'kategori.required' => 'kategori barang wajib diisi',
                'tanggal_order.required' => 'Tanggal wajib diisi',
                'foto_barang.required' => 'Foto wajib diisi',
            ]
        );

        $tanggal_order = date('Y-m-d', strtotime($request->tanggal_order));
        
        if ($request->file('foto_barang')) {
            $filename = time() . '.' . $request->foto_barang->extension();
            $request->foto_barang->move(public_path('foto_barang'), $filename);
            
            //tambah data produk
            BarangMasuk::insert([
                'nama_barang' => $request->nama_barang,
                'jumlah_barang' => $request->jumlah_barang,
                'harga_beli' => $request->harga_beli,
                'harga_barang' => $request->harga_barang,
                'kategori' => $request->kategori,
                'tanggal_order' => $tanggal_order,
                'foto' => $filename
            ]);
    
            return redirect()->route('barang.masuk');
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
    public function edit(BarangMasuk $id)
    {
        return view("admin.barang.barangMasukEdit", compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // melakukan validasi data
        $request->validate(
            [
                'nama_barang' => 'required',
                'jumlah_barang' => 'required',
                'harga_beli' => 'required',
                'harga_barang' => 'required',
                'kategori' => 'required',
                'tanggal_order'=> 'required'
            ],
            [
                'nama_barang.required' => 'nama barang wajib diisi',
                'jumlah_barang.required' => ' jumlah barang wajib diisi',
                'harga_beli.required' => 'harga beli wajib diisi',
                'harga_barang.required' => 'harga barang wajib diisi',
                'kategori.required' => 'kategori wajib diisi',
                'tanggal_order.required' => 'Tanggal wajib diisi'
            ]
        );

        $tanggal_order = date('Y-m-d', strtotime($request->tanggal_order));

        if ($request->file('foto_barang')) {
            $barang = BarangMasuk::where("id", $id)->first();
            $filename = time() . '.' . $request->foto_barang->extension();
            if (File::exists(public_path('foto_barang/').$barang->foto)) {
                File::delete(public_path('foto_barang/').$barang->foto);
            }
            $request->foto_barang->move(public_path('foto_barang'), $filename);
            
            //update data produk
            BarangMasuk::where("id",$id)->update([
                'nama_barang' => $request->nama_barang,
                'jumlah_barang' => $request->jumlah_barang,
                'harga_beli' => $request->harga_beli,
                'harga_barang' => $request->harga_barang,
                'kategori' => $request->kategori,
                'tanggal_order' => $tanggal_order,
                'foto' => $filename
            ]);
            
            return redirect()->route('barang.masuk');
        }else{
            BarangMasuk::where("id",$id)->update([
                'nama_barang' => $request->nama_barang,
                'jumlah_barang' => $request->jumlah_barang,
                'harga_beli' => $request->harga_beli,
                'harga_barang' => $request->harga_barang,
                'kategori' => $request->kategori,
                'tanggal_order' => $tanggal_order
            ]);
            return redirect()->route('barang.masuk');
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangMasuk $id)
    {
        if (File::exists(public_path('foto_barang/').$id->foto)) {
            File::delete(public_path('foto_barang/').$id->foto);
        }
        $id->delete();
    
        return redirect()->route(route: 'barang.masuk')
                ->with('message','Data berhasil di hapus' );
    }
}
