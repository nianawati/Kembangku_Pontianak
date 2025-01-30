<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplier = Supplier::all();
        return view("admin.supplier.supplier", compact("supplier"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.supplier.supplierTambah");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // melakukan validasi data
        $request->validate(
            [
                'nama_supplier' => 'required',
                'no_hp' => 'required',
                'alamat' => 'required',
                'deskripsi'=> 'required'
            ],
            [
                'nama_supplier.required' => 'Nama Supplier wajib diisi',
                'no_hp.required' => ' No Handphone wajib diisi',
                'alamat.required' => 'Alamat wajib diisi',
                'deskripsi.required' => 'Deskriksi wajib diisi'

            ]
        );

        //tambah data produk
        Supplier::insert([
            'nama_supplier' => $request->nama_supplier,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('supplier');
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
    public function edit(Supplier $id)
    {
        return view("admin.supplier.supplierEdit", compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // melakukan validasi data
        $request->validate(
            [
                'nama_supplier' => 'required',
                'no_hp' => 'required',
                'alamat'=> 'required',
                'deskripsi'=> 'required'
            ],
            [
                'nama_supplier.required' => 'Nama Supplier wajib diisi',
                'no_hp.required' => ' No Handphone wajib diisi',
                'alamat.required' => 'Alamat wajib diisi',
                'deskripsi.required' => 'Deskriksi wajib diisi'

            ]
        );

        //tambah data produk
        Supplier::where("id",$id)->update([
            'nama_supplier' => $request->nama_supplier,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('supplier');
    }

    /**
     * Remove the specified resource from storage.
     */         
    public function destroy(Supplier $id)
    {
        $id->delete();
    
        return redirect()->route(route: 'supplier')
                ->with('message','Data berhasil di hapus' );
    }
}
