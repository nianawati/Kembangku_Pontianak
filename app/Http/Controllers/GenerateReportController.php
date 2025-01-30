<?php
namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\BarangRusak;
use App\Models\BungaKeluar;
use App\Models\BungaMasuk;
use App\Models\BungaRusak;
use App\Models\Kategoris;
use App\Models\PesananMasuk;
use App\Models\Unit;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class GenerateReportController extends Controller
{
    public function generatePDF()
    {
        
        $BarangKeluar = BarangKeluar::all();
        $BarangMasuk = BarangMasuk::all();
        $BungaKeluar = BungaKeluar::all();
        $BungaMasuk = BungaMasuk::all();
        $BungaRusak = BungaRusak::all();
        $BarangRusak = BarangRusak::all();
        $Kategoris = Kategoris::all();
        $PesananMasuk = PesananMasuk::all();
        $Unit = Unit::all();


        $BarangKeluarKeys = Schema::getColumnListing("barang_keluars");
        $BarangMasukKeys = Schema::getColumnListing("barang_masuks");
        $BungaKeluarKeys = Schema::getColumnListing("bunga_keluars");
        $BungaMasukKeys = Schema::getColumnListing("bunga_masuks");
        $BungaRusakKeys = Schema::getColumnListing("bunga_rusaks");
        $BarangRusakKeys = Schema::getColumnListing("barang_rusaks");
        $KategorisKeys = Schema::getColumnListing("kategoris");
        $PesananMasukKeys = Schema::getColumnListing("pesanan_masuks");
        $UnitKeys = Schema::getColumnListing("units");
        

        // return view("GenerateReport",compact(
        //     'BarangKeluar',
        //     'BarangMasuk',
        //     'BungaKeluar',
        //     'BungaMasuk',
        //     'BungaRusak',
        //     'BarangRusak',
        //     'Kategoris',
        //     'PesananMasuk',
        //     'Unit',
        //     'BarangKeluarKeys',
        //     'BarangMasukKeys',
        //     'BungaKeluarKeys',
        //     'BungaMasukKeys',
        //     'BungaRusakKeys',
        //     'BarangRusakKeys',
        //     'KategorisKeys',
        //     'PesananMasukKeys',
        //     'UnitKeys'
        // ));

        // Generate HTML dari data
        $pdf = PDF::loadView('GenerateReport', compact(
            'BarangKeluar',
            'BarangMasuk',
            'BungaKeluar',
            'BungaMasuk',
            'BungaRusak',
            'BarangRusak',
            'Kategoris',
            'PesananMasuk',
            'Unit',
            'BarangKeluarKeys',
            'BarangMasukKeys',
            'BungaKeluarKeys',
            'BungaMasukKeys',
            'BungaRusakKeys',
            'BarangRusakKeys',
            'KategorisKeys',
            'PesananMasukKeys',
            'UnitKeys'
        ))->setOption('isHtml5ParserEnabled', true)
        ->setOption('isPhpEnabled', true);

        // Download PDF
        return $pdf->download('laporan_barang.pdf');
    }
}
