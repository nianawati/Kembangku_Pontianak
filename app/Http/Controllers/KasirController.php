<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Kategoris;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KasirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Unit = Unit::all();
        $Kategori = DB::table("kategoris")
            ->join('bunga_masuks', 'kategoris.id_bunga', '=', 'bunga_masuks.id')
            ->select('*', 'kategoris.id as id')
            ->get();
        $BarangMasuk = BarangMasuk::all();
        return view("karyawan.kasir",compact("Unit","Kategori","BarangMasuk"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
