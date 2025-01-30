<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unit = Unit::all();
        return view("admin.produk.unit", compact("unit"));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.produk.unitTambah");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // melakukan validasi data
        $request->validate(
            [
                'nama_unit' => 'required',
                'foto_unit' => 'required|image|mimes:jpeg,png,jpg,gif|max:10480',
                'biaya_jasa' => 'required'
            ],
            [
                'nama_unit.required' => 'Nama Supplier wajib diisi',
                'foto_unit.required' => 'Foto wajib diisi',
                'biaya_jasa.required' => 'Biaya Jasa wajib diisi'
            ]
        );


        if ($request->file('foto_unit')) {
            $filename = time() . '.' . $request->foto_unit->extension();
            $request->foto_unit->move(public_path('uploads'), $filename);

            //tambah data produk
            Unit::insert([
                'nama_unit' => $request->nama_unit,
                'foto' => $filename,
                'biaya_jasa' => $request->biaya_jasa
            ]);

            return redirect()->route('produk.unit');
        } else {
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
    public function edit(Unit $id)
    {
        return view("admin.produk.unitEdit", compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // melakukan validasi data
        $request->validate(
            [
                'nama_unit' => 'required',
                'biaya_jasa' => 'required'
            ],
            [
                'nama_unit.required' => 'Nama Unit wajib diisi',
                'biaya_jasa.required' => 'Biaya Jasa wajib diisi'
            ]
        );

        $unit = Unit::where("id", $id)->first();
        if ($request->file('foto_unit')) {
            $filename = time() . '.' . $request->foto_unit->extension();
            if (File::exists(public_path('uploads/').$unit->foto)) {
                File::delete(public_path('uploads/').$unit->foto);
            }
            $request->foto_unit->move(public_path('uploads'), $filename);

            $unit->update([
                'nama_unit' => $request->nama_unit,
                'foto' => $filename,
                'biaya_jasa' => $request->biaya_jasa
            ]);

            return redirect()->route('produk.unit');
        } else {
            $unit->update([
                'nama_unit' => $request->nama_unit,
                'biaya_jasa' => $request->biaya_jasa
            ]);
            return redirect()->route('produk.unit');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $id)
    {
        if (File::exists(public_path('uploads/').$id->foto)) {
            File::delete(public_path('uploads/').$id->foto);
        }
        $id->delete();

        return redirect()->route(route: 'produk.unit')
            ->with('message', 'Data berhasil di hapus');
    }
}
