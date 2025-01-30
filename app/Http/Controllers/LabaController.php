<?php

namespace App\Http\Controllers;

use App\Models\Laba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LabaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $queryBunga = "
        SELECT 
            IFNULL(SUM(a.total_pendapatan - b.total_biaya_beli - c.total_kerugian), 0) AS total_pendapatan_bunga
        FROM 
            (SELECT 
                IFNULL(SUM(total_harga), 0) AS total_pendapatan 
            FROM 
                bunga_keluars 
            WHERE 
                `status` = 'selesai') a,
            (SELECT 
                IFNULL(SUM(bunga_rusaks.jumlah_bunga * bunga_rusaks.harga_bunga), 0) AS total_kerugian 
            FROM 
                bunga_rusaks) c,
            (SELECT 
                IFNULL(SUM(bunga_keluars.jumlah_bunga * bunga_masuks.harga_beli), 0) AS total_biaya_beli 
            FROM 
                bunga_keluars 
            JOIN 
                bunga_masuks 
            ON 
                bunga_keluars.id_bunga = bunga_masuks.id 
            WHERE 
                bunga_keluars.`status` = 'selesai') b;
        ";
        $queryBarang = "
        SELECT 
            IFNULL(SUM(a.total_pendapatan - b.total_biaya_beli - c.total_kerugian), 0) AS total_pendapatan_barang
        FROM 
            (SELECT 
                IFNULL(SUM(total_harga), 0) AS total_pendapatan 
            FROM 
                barang_keluars 
            WHERE 
                `status` = 'selesai') a,
            (SELECT 
                IFNULL(SUM(barang_rusaks.jumlah_barang * barang_rusaks.harga_barang), 0) AS total_kerugian 
            FROM 
                barang_rusaks) c,
            (SELECT 
                IFNULL(SUM(barang_keluars.jumlah_barang * barang_masuks.harga_beli), 0) AS total_biaya_beli 
            FROM 
                barang_keluars 
            JOIN 
                barang_masuks 
            ON 
                barang_keluars.id_barang = barang_masuks.id 
            WHERE 
                barang_keluars.`status` = 'selesai') b;

        ";
        $queryModalBarang = "
        SELECT 
            IFNULL(SUM(a.modal_barang_masuk_keluar + b.modal_barang), 0) AS total_modal_barang
        FROM 
            (SELECT 
                IFNULL(SUM((barang_keluars.jumlah_barang + barang_masuks.jumlah_barang) * barang_masuks.harga_beli), 0) AS modal_barang_masuk_keluar 
            FROM barang_masuks 
            JOIN barang_keluars 
            ON barang_masuks.id = barang_keluars.id_barang
            WHERE barang_keluars.status = 'selesai') a,
            (SELECT 
                IFNULL(SUM(barang_masuks.jumlah_barang * barang_masuks.harga_beli), 0) AS modal_barang 
            FROM barang_masuks 
            LEFT JOIN barang_keluars 
            ON barang_masuks.id = barang_keluars.id_barang 
            WHERE barang_keluars.id_barang IS NULL) b;
        ";

        $queryModalBunga = "
        SELECT 
            IFNULL(SUM(a.modal_bunga_masuk_keluar + b.modal_bunga), 0) AS total_modal_bunga
        FROM 
            (SELECT 
                IFNULL(SUM((bunga_keluars.jumlah_bunga + bunga_masuks.jumlah_bunga) * bunga_masuks.harga_beli), 0) AS modal_bunga_masuk_keluar 
            FROM bunga_masuks 
            JOIN bunga_keluars 
            ON bunga_masuks.id = bunga_keluars.id_bunga
            WHERE bunga_keluars.status = 'selesai') a,
            (SELECT 
                IFNULL(SUM(bunga_masuks.jumlah_bunga * bunga_masuks.harga_beli), 0) AS modal_bunga 
            FROM bunga_masuks 
            LEFT JOIN bunga_keluars 
            ON bunga_masuks.id = bunga_keluars.id_bunga 
            WHERE bunga_keluars.id_bunga IS NULL) b;
        ";

        $queryLabaKotorBarang = "
        SELECT 
            IFNULL(SUM(total_harga), 0) AS laba_kotor_barang 
        FROM 
            barang_keluars
        WHERE 
            status = 'selesai';
        ";
        $queryLabaKotorBunga = "
        SELECT 
            IFNULL(SUM(total_harga), 0) AS laba_kotor_bunga 
        FROM 
            bunga_keluars
        WHERE 
            status = 'selesai';
        ";
        $queryTotalKeuntunganJasa = "
        SELECT 
            IFNULL(SUM(biaya_jasa), 0) AS total_keuntungan_biaya_jasa 
        FROM 
            pesanan_masuks
        ";

        $LabaBunga = DB::select($queryBunga);
        $LabaBarang = DB::select($queryBarang);
        $ModalBunga = DB::select($queryModalBunga);
        $ModalBarang = DB::select($queryModalBarang);
        $LabaKotorBunga = DB::select($queryLabaKotorBunga);
        $LabaKotorBarang = DB::select($queryLabaKotorBarang);
        $TotalKeuntunganJasa = DB::select($queryTotalKeuntunganJasa);

        if (empty($LabaBarang) || empty($LabaBunga) || empty($ModalBarang) || empty($ModalBunga) || empty($LabaKotorBunga) || empty($LabaKotorBarang) || empty($TotalKeuntunganJasa)) {
            dd("Terjadi Kesalahan pada data laba silahkan hubungi developer untuk melakukan perbaikan");
        }

        $LabaBunga = $LabaBunga[0];
        $LabaBarang = $LabaBarang[0];
        $ModalBunga = $ModalBunga[0];
        $ModalBarang = $ModalBarang[0];
        $LabaKotorBarang = $LabaKotorBarang[0];
        $LabaKotorBunga = $LabaKotorBunga[0];
        $TotalKeuntunganJasa = $TotalKeuntunganJasa[0];
        $Laba = $LabaBunga->total_pendapatan_bunga + $LabaBarang->total_pendapatan_barang + $TotalKeuntunganJasa->total_keuntungan_biaya_jasa;


        return view("admin.laba.laporan", compact("Laba", "LabaBunga", "LabaBarang", "ModalBarang", "ModalBunga","LabaKotorBunga","LabaKotorBarang","TotalKeuntunganJasa"));

    }

    public function cekRekap(Request $request)
    {
        $request->validate(
            [
                'tanggal_awal' => 'required',
                'tanggal_akhir' => 'required'
            ],
            [
                'tanggal_awal.required' => 'tanggal awal wajib diisi',
                'tanggal_akhir.required' => 'tanggal akhir wajib diisi'
            ]
        );

        $tanggal_awal = date('Y-m-d', strtotime($request->tanggal_awal));
        $tanggal_akhir = date('Y-m-d', strtotime($request->tanggal_akhir));

        $queryTotalPendapatanBarang ="
        SELECT 
            IFNULL(SUM(a.total_pendapatan - b.total_biaya_beli - c.total_kerugian), 0) AS total_pendapatan_barang
        FROM 
            (SELECT 
                IFNULL(SUM(total_harga), 0) AS total_pendapatan 
            FROM 
                barang_keluars
            WHERE 
                barang_keluars.tanggal_keluar BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
                AND barang_keluars.status = 'selesai') a,
            (SELECT 
                IFNULL(SUM(barang_rusaks.jumlah_barang * barang_rusaks.harga_barang), 0) AS total_kerugian 
            FROM 
                barang_rusaks) c,
            (SELECT 
                IFNULL(SUM(barang_keluars.jumlah_barang * barang_masuks.harga_beli), 0) AS total_biaya_beli 
            FROM 
                barang_keluars 
            JOIN 
                barang_masuks 
            ON 
                barang_keluars.id_barang = barang_masuks.id
            WHERE 
                barang_keluars.tanggal_keluar BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
                AND barang_keluars.status = 'selesai') b;
        ";
        $queryTotalPendapatanBunga ="
        SELECT 
            IFNULL(SUM(a.total_pendapatan - b.total_biaya_beli - c.total_kerugian), 0) AS total_pendapatan_bunga
        FROM 
            (SELECT 
                IFNULL(SUM(total_harga), 0) AS total_pendapatan 
            FROM 
                bunga_keluars
            WHERE 
                bunga_keluars.tanggal_keluar BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
                AND bunga_keluars.status = 'selesai') a,
            (SELECT 
                IFNULL(SUM(bunga_rusaks.jumlah_bunga * bunga_rusaks.harga_bunga), 0) AS total_kerugian 
            FROM 
                bunga_rusaks) c,
            (SELECT 
                IFNULL(SUM(bunga_keluars.jumlah_bunga * bunga_masuks.harga_beli), 0) AS total_biaya_beli 
            FROM 
                bunga_keluars 
            JOIN 
                bunga_masuks 
            ON 
                bunga_keluars.id_bunga = bunga_masuks.id
            WHERE 
                bunga_keluars.tanggal_keluar BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
                AND bunga_keluars.status = 'selesai') b;
    
        ";
        $queryTotalModalBarang ="
        SELECT 
            IFNULL(SUM(a.modal_barang_masuk_keluar + b.modal_barang), 0) AS total_modal_barang
        FROM 
            (SELECT 
                IFNULL(SUM((barang_keluars.jumlah_barang + barang_masuks.jumlah_barang) * barang_masuks.harga_beli), 0) AS modal_barang_masuk_keluar 
            FROM 
                barang_masuks 
            JOIN 
                barang_keluars 
            ON 
                barang_masuks.id = barang_keluars.id_barang
            WHERE 
                barang_masuks.tanggal_order BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
                AND barang_keluars.status = 'selesai') a,
            (SELECT 
                IFNULL(SUM(barang_masuks.jumlah_barang * barang_masuks.harga_beli), 0) AS modal_barang 
            FROM 
                barang_masuks 
            LEFT JOIN 
                barang_keluars 
            ON 
                barang_masuks.id = barang_keluars.id_barang 
            WHERE 
                barang_keluars.id_barang IS NULL
                AND barang_masuks.tanggal_order BETWEEN '$tanggal_awal' AND '$tanggal_akhir') b;

        ";
        $queryTotalModalBunga ="
        SELECT 
            IFNULL(SUM(a.modal_bunga_masuk_keluar + b.modal_bunga), 0) AS total_modal_bunga
        FROM 
            (SELECT 
                IFNULL(SUM((bunga_keluars.jumlah_bunga + bunga_masuks.jumlah_bunga) * bunga_masuks.harga_beli), 0) AS modal_bunga_masuk_keluar 
            FROM 
                bunga_keluars 
            LEFT JOIN 
                bunga_masuks 
            ON 
                bunga_keluars.id_bunga = bunga_masuks.id
            WHERE 
                bunga_masuks.tanggal_order BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
                AND bunga_keluars.status = 'selesai') a,
            (SELECT 
                IFNULL(SUM(bunga_masuks.jumlah_bunga * bunga_masuks.harga_beli), 0) AS modal_bunga 
            FROM 
                bunga_masuks 
            LEFT JOIN 
                bunga_keluars 
            ON 
                bunga_masuks.id = bunga_keluars.id_bunga 
            WHERE 
                bunga_keluars.id_bunga IS NULL
                AND bunga_masuks.tanggal_order BETWEEN '$tanggal_awal' AND '$tanggal_akhir') b;
        
        ";

        $queryLabaKotorBarang = "
        SELECT 
            IFNULL(SUM(total_harga), 0) AS laba_kotor_barang 
        FROM 
            barang_keluars 
        WHERE 
            tanggal_keluar BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
            AND status = 'selesai';
        ";
        $queryLabaKotorBunga = "
        SELECT 
            IFNULL(SUM(total_harga), 0) AS laba_kotor_bunga 
        FROM 
            bunga_keluars 
        WHERE 
            tanggal_keluar BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
            AND status = 'selesai';
        ";

        $queryKeuntunganJasa = "
        SELECT 
            SUM(biaya_jasa) AS total_keuntungan_biaya_jasa 
        FROM 
            pesanan_masuks
        WHERE 
            pesanan_masuks.tanggal_pesanan BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
        ";

        $totalModalBunga = DB::select($queryTotalModalBunga);
        $totalModalBarang = DB::select($queryTotalModalBarang);
        $totalPendapatanBarang = DB::select($queryTotalPendapatanBarang);
        $totalPendapatanBunga = DB::select($queryTotalPendapatanBunga);
        $LabaKotorBunga = DB::select($queryLabaKotorBunga);
        $LabaKotorBarang = DB::select($queryLabaKotorBarang);
        $KeuntunganJasa = DB::select($queryKeuntunganJasa);

        if (empty($KeuntunganJasa) || empty($totalPendapatanBarang) || empty($totalPendapatanBunga) || empty($totalModalBarang) || empty($totalModalBunga) || empty($LabaKotorBunga) || empty($LabaKotorBarang)) {
            dd("Terjadi Kesalahan pada data laba silahkan hubungi developer untuk melakukan perbaikan");
        }

        $ModalBarang = $totalModalBarang[0];
        $ModalBunga = $totalModalBunga[0];
        $LabaBarang = $totalPendapatanBarang[0];
        $LabaBunga = $totalPendapatanBunga[0];
        $LabaKotorBarang = $LabaKotorBarang[0];
        $LabaKotorBunga = $LabaKotorBunga[0];
        $TotalKeuntunganJasa = $KeuntunganJasa[0];

        $Laba = $LabaBunga->total_pendapatan_bunga + $LabaBarang->total_pendapatan_barang + $TotalKeuntunganJasa->total_keuntungan_biaya_jasa;
        return view("admin.laba.laporan", compact("Laba", "LabaBunga", "LabaBarang", "ModalBarang", "ModalBunga", "LabaKotorBunga","LabaKotorBarang","TotalKeuntunganJasa"));
        
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
