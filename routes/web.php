<?php

use App\Http\Controllers\GenerateReportController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BungaMasukController;
use App\Http\Controllers\BungaKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangRusakController;
use App\Http\Controllers\BungaRusakController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\PesananMasukController;
use App\Http\Controllers\LabaController;

use App\Http\Middleware\VerifyUser;
use App\Models\BarangKeluar;
use App\Models\BarangMasuk;
use App\Models\BungaKeluar;
use App\Models\BungaMasuk;
use App\Models\Kategoris;
use App\Models\PesananMasuk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route("user.login");
})->name('home');

Route::group(["prefix" => "/kasir", "middleware" => VerifyUser::class], function () {

    Route::get('/', [KasirController::class, 'index'])->name('kasir');

});

Route::group(["prefix" => "/admin", "middleware" => VerifyUser::class], function () {
    Route::get('/', function () {

        $tanggal_awal = date("Y-m-01");
        $tanggal_akhir = date('Y-m-t');

        $queryTotalPendapatanBarang = "
        SELECT 
            IFNULL(SUM(a.total_pendapatan - b.total_biaya_beli - c.total_kerugian), 0) AS total_pendapatan_barang
        FROM 
            (SELECT 
                IFNULL(SUM(total_harga), 0) AS total_pendapatan 
            FROM barang_keluars
            WHERE barang_keluars.tanggal_keluar BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
            AND barang_keluars.status = 'selesai') a,
            (SELECT 
                IFNULL(SUM(barang_rusaks.jumlah_barang * barang_rusaks.harga_barang), 0) AS total_kerugian 
            FROM barang_rusaks) c,
            (SELECT 
                IFNULL(SUM(barang_keluars.jumlah_barang * barang_masuks.harga_beli), 0) AS total_biaya_beli 
            FROM barang_keluars 
            JOIN barang_masuks 
            ON barang_keluars.id_barang = barang_masuks.id
            WHERE barang_keluars.tanggal_keluar BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
            AND barang_keluars.status = 'selesai') b;
        
        ";

        $queryTotalPendapatanBunga = "
        SELECT 
            IFNULL(SUM(a.total_pendapatan - b.total_biaya_beli - c.total_kerugian), 0) AS total_pendapatan_bunga
        FROM 
            (SELECT 
                IFNULL(SUM(total_harga), 0) AS total_pendapatan 
            FROM bunga_keluars
            WHERE bunga_keluars.tanggal_keluar BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
            AND bunga_keluars.status = 'selesai') a,
            (SELECT 
                IFNULL(SUM(bunga_rusaks.jumlah_bunga * bunga_rusaks.harga_bunga), 0) AS total_kerugian 
            FROM bunga_rusaks) c,
            (SELECT 
                IFNULL(SUM(bunga_keluars.jumlah_bunga * bunga_masuks.harga_beli), 0) AS total_biaya_beli 
            FROM bunga_keluars 
            JOIN bunga_masuks 
            ON bunga_keluars.id_bunga = bunga_masuks.id
            WHERE bunga_keluars.tanggal_keluar BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
            AND bunga_keluars.status = 'selesai') b;
        ";

        $queryBunga = "
        SELECT 
            IFNULL(SUM(a.total_pendapatan - b.total_biaya_beli - c.total_kerugian), 0) AS total_pendapatan_bunga
        FROM 
            (SELECT 
                IFNULL(SUM(total_harga), 0) AS total_pendapatan 
            FROM bunga_keluars
            WHERE bunga_keluars.tanggal_keluar BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
            AND bunga_keluars.status = 'selesai') a,
            (SELECT 
                IFNULL(SUM(bunga_rusaks.jumlah_bunga * bunga_rusaks.harga_bunga), 0) AS total_kerugian 
            FROM bunga_rusaks) c,
            (SELECT 
                IFNULL(SUM(bunga_keluars.jumlah_bunga * bunga_masuks.harga_beli), 0) AS total_biaya_beli 
            FROM bunga_keluars
            JOIN bunga_masuks 
            ON bunga_keluars.id_bunga = bunga_masuks.id
            WHERE bunga_keluars.tanggal_keluar BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
            AND bunga_keluars.status = 'selesai') b;
        ";
        
        $queryBarang = "
        SELECT 
            IFNULL(SUM(a.total_pendapatan - b.total_biaya_beli - c.total_kerugian), 0) AS total_pendapatan_barang
        FROM 
            (SELECT IFNULL(SUM(total_harga), 0) AS total_pendapatan 
            FROM barang_keluars
            WHERE barang_keluars.tanggal_keluar BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
            AND barang_keluars.status = 'selesai') a,
            (SELECT IFNULL(SUM(barang_rusaks.jumlah_barang * barang_rusaks.harga_barang), 0) AS total_kerugian 
            FROM barang_rusaks) c,
            (SELECT IFNULL(SUM(barang_keluars.jumlah_barang * barang_masuks.harga_beli), 0) AS total_biaya_beli 
            FROM barang_keluars 
            JOIN barang_masuks 
            ON barang_keluars.id_barang = barang_masuks.id
            WHERE barang_keluars.tanggal_keluar BETWEEN '$tanggal_awal' AND '$tanggal_akhir'
            AND barang_keluars.status = 'selesai') b;
        ";

        
        $tahun = date("Y");
        $bulan = date("m");
        
        $queryLaporanBulananBarang = "
        SELECT 
            MONTH(bk.tanggal_keluar) AS month,
            IFNULL(SUM(bk.total_harga), 0) AS total_pendapatan,
            IFNULL(SUM(bk.jumlah_barang * bm.harga_beli), 0) AS total_biaya_beli,
            IFNULL(SUM(br.jumlah_barang * br.harga_barang), 0) AS total_kerugian,
            IFNULL(SUM(bk.total_harga), 0) 
            - IFNULL(SUM(bk.jumlah_barang * bm.harga_beli), 0) 
            - IFNULL(SUM(br.jumlah_barang * br.harga_barang), 0) AS total_pendapatan_bersih
        FROM barang_keluars bk
        LEFT JOIN barang_masuks bm ON bk.id_barang = bm.id
        LEFT JOIN barang_rusaks br ON bk.id_barang = br.id_barang
        WHERE YEAR(bk.tanggal_keluar) = $tahun
        AND bk.status = 'selesai'
        GROUP BY MONTH(bk.tanggal_keluar)
        ORDER BY MONTH(bk.tanggal_keluar);
        ";

        $queryLaporanBulananBunga = "
        SELECT 
            MONTH(bk.tanggal_keluar) AS month,
            IFNULL(SUM(bk.total_harga), 0) AS total_pendapatan,
            IFNULL(SUM(bk.jumlah_bunga * bm.harga_beli), 0) AS total_biaya_beli,
            IFNULL(SUM(br.jumlah_bunga * br.harga_bunga), 0) AS total_kerugian,
            IFNULL(SUM(bk.total_harga), 0) 
            - IFNULL(SUM(bk.jumlah_bunga * bm.harga_beli), 0) 
            - IFNULL(SUM(br.jumlah_bunga * br.harga_bunga), 0) AS total_pendapatan_bersih
        FROM bunga_keluars bk
        LEFT JOIN bunga_masuks bm ON bk.id_bunga = bm.id
        LEFT JOIN bunga_rusaks br ON bk.id_bunga = br.id_bunga
        WHERE YEAR(bk.tanggal_keluar) = $tahun
        AND bk.status = 'selesai'  -- Menambahkan kondisi status selesai
        GROUP BY MONTH(bk.tanggal_keluar)
        ORDER BY MONTH(bk.tanggal_keluar);
        ";

        $LaporanBulananBunga = DB::select($queryLaporanBulananBunga);
        $LaporanBulananBarang = DB::select($queryLaporanBulananBarang);

        $LabaBunga = DB::select($queryBunga);
        $LabaBarang = DB::select($queryBarang);

        $pendapatanBunga = DB::select($queryTotalPendapatanBunga);
        $pendapatanBarang = DB::select($queryTotalPendapatanBarang);
        $jumlahBungaMasuk = DB::select("SELECT sum(jumlah_bunga) as jumlah_bunga_masuk FROM bunga_masuks;");
        $jumlahBarangMasuk = DB::select("SELECT sum(jumlah_barang) as jumlah_barang_masuk FROM barang_masuks;");
        $queryTotalKeuntunganJasa = "SELECT IFNULL(SUM(biaya_jasa),0) as total_keuntungan_biaya_jasa FROM pesanan_masuks;";
        $queryTotalKeuntunganJasaBulanan = "
        SELECT IFNULL(sum(biaya_jasa),0) as total_keuntungan_biaya_jasa FROM pesanan_masuks
        WHERE MONTH(pesanan_masuks.tanggal_pesanan) = $bulan;
        ";
        $TotalKeuntunganJasa = DB::select($queryTotalKeuntunganJasa);
        $TotalKeuntunganJasaBulanan = DB::select($queryTotalKeuntunganJasaBulanan);
        $pendapatanBunga = $pendapatanBunga[0];
        $pendapatanBarang = $pendapatanBarang[0];
        $jumlahBungaMasuk = $jumlahBungaMasuk[0];
        $jumlahBarangMasuk = $jumlahBarangMasuk[0];
        $LabaBunga = $LabaBunga[0];
        $LabaBarang = $LabaBarang[0];
        $TotalKeuntunganJasa = $TotalKeuntunganJasa[0];
        
        if(empty($TotalKeuntunganJasaBulanan)){
            $TotalKeuntunganJasaBulanan = [[
                "total_keuntungan_biaya_jasa" => 0    
            ]];
        }
        $TotalKeuntunganJasaBulanan = $TotalKeuntunganJasaBulanan[0];
        
        if(empty($LaporanBulananBunga)){
            $LaporanBulananBunga = [[
                "month" => 0,
                "total_biaya_beli" => 0,
                "total_kerugian" => 0,
                "total_pendapatan_bersih" => 0
            ]];
        }

        if(empty($LaporanBulananBarang)){
            $LaporanBulananBarang = [[
                "month" => 0,
                "total_biaya_beli" => 0,
                "total_kerugian" => 0,
                "total_pendapatan_bersih" => 0
            ]];
        }
        

        $Laba = $pendapatanBunga->total_pendapatan_bunga + $pendapatanBarang->total_pendapatan_barang + $TotalKeuntunganJasaBulanan->total_keuntungan_biaya_jasa;
        $LabaKeseluruhan = $LabaBunga->total_pendapatan_bunga + $LabaBarang->total_pendapatan_barang + $TotalKeuntunganJasa->total_keuntungan_biaya_jasa;

        return view('admin.halamanUtama',compact('LaporanBulananBarang','LaporanBulananBunga','Laba','jumlahBungaMasuk','jumlahBarangMasuk','LabaKeseluruhan','LaporanBulananBunga','LaporanBulananBarang','TotalKeuntunganJasa'));
    })->name('dashboard');

    Route::get('/bunga-keluar/{id_bunga_keluar}',function(Request $request, int $id_bunga_keluar){
        $bunga_keluars = DB::select("SELECT bunga_keluars.*,bunga_masuks.harga_bunga FROM bunga_keluars,bunga_masuks WHERE id_bunga_keluar=$id_bunga_keluar AND bunga_masuks.id = bunga_keluars.id_bunga");
        return response()->json(
            $bunga_keluars
        );
    })->name('bunga-keluar');

    Route::get('/barang-keluar/{id_barang_keluar}',function(Request $request, int $id_barang_keluar){
        $barang_keluars = DB::select("SELECT barang_keluars.*,barang_masuks.harga_barang FROM barang_keluars,barang_masuks WHERE id_barang_keluar=$id_barang_keluar AND barang_masuks.id = barang_keluars.id_barang");
        return response()->json(
            $barang_keluars
        );
    })->name('barang-keluar');

    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/user/tambah', [UserController::class, 'create'])->name('user.tambah');
    Route::post('/user/tambah', [UserController::class, 'store'])->name("user.store");
    Route::get('/user/edit{id}', [UserController::class, 'edit'])->name("user.edit");
    Route::post('/user/update{id}', [UserController::class, 'update'])->name("user.update");
    Route::post('/user/delete{id}', [UserController::class, 'destroy'])->name("user.delete");


    Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier');
    Route::get('/supplier/tambah', [SupplierController::class, 'create'])->name('supplier.tambah');
    Route::post('/supplier/tambah', [SupplierController::class, 'store'])->name("supplier.store");
    Route::get('/supplier/edit{id}', [SupplierController::class, 'edit'])->name("supplier.edit");
    Route::post('/supplier/update{id}', [SupplierController::class, 'update'])->name("supplier.update");
    Route::post('/supplier/delete{id}', [SupplierController::class, 'destroy'])->name("supplier.delete");


    Route::get('/bunga/masuk', [BungaMasukController::class, 'index'])->name('bunga.masuk');
    Route::get('/bunga/masuk/tambah', [BungaMasukController::class, 'create'])->name('bunga.masuk.tambah');
    Route::post('/bunga/masuk/tambah', [BungaMasukController::class, 'store'])->name("bunga.masuk.store");
    Route::get('/bunga/masuk/edit{id}', [BungaMasukController::class, 'edit'])->name("bunga.masuk.edit");
    Route::post('/bunga/masuk/update{id}', [BungaMasukController::class, 'update'])->name("bunga.masuk.update");
    Route::post('/bunga/masuk/delete{id}', [BungaMasukController::class, 'destroy'])->name("bunga.masuk.delete");


    Route::get('/bunga/keluar', [BungaKeluarController::class, 'index'])->name('bunga.keluar');
    Route::get('/bunga/keluar/tambah', [BungaKeluarController::class, 'create'])->name('bunga.keluar.tambah');
    Route::post('/bunga/keluar/tambah', [BungaKeluarController::class, 'store'])->name("bunga.keluar.store");
    Route::get('/bunga/keluar/edit{id}', [BungaKeluarController::class, 'edit'])->name("bunga.keluar.edit");
    Route::post('/bunga/keluar/update{id}', [BungaKeluarController::class, 'update'])->name("bunga.keluar.update");
    Route::post('/bunga/keluar/delete{id}', [BungaKeluarController::class, 'destroy'])->name("bunga.keluar.delete");


    Route::get('/barang/masuk', [BarangMasukController::class, 'index'])->name('barang.masuk');
    Route::get('/barang/masuk/tambah', [BarangMasukController::class, 'create'])->name('barang.masuk.tambah');
    Route::post('/barang/masuk/tambah', [BarangMasukController::class, 'store'])->name("barang.masuk.store");
    Route::get('/barang/masuk/edit{id}', [BarangMasukController::class, 'edit'])->name("barang.masuk.edit");
    Route::post('/barang/masuk/update{id}', [BarangMasukController::class, 'update'])->name("barang.masuk.update");
    Route::post('/barang/masuk/delete{id}', [BarangMasukController::class, 'destroy'])->name("barang.masuk.delete");


    Route::get('/barang/keluar', [BarangKeluarController::class, 'index'])->name('barang.keluar');
    Route::get('/barang/keluar/tambah', [BarangKeluarController::class, 'create'])->name('barang.keluar.tambah');
    Route::post('/barang/keluar/tambah', [BarangKeluarController::class, 'store'])->name("barang.keluar.store");
    Route::get('/barang/keluar/edit{id}', [BarangKeluarController::class, 'edit'])->name("barang.keluar.edit");
    Route::post('/barang/keluar/update{id}', [BarangKeluarController::class, 'update'])->name("barang.keluar.update");
    Route::post('/barang/keluar/delete{id}', [BarangKeluarController::class, 'destroy'])->name("barang.keluar.delete");


    Route::get('/rusak/bunga', [BungaRusakController::class, 'index'])->name('rusak.bunga');
    Route::get('/rusak/bunga/tambah', [BungaRusakController::class, 'create'])->name('rusak.bunga.tambah');
    Route::post('/rusak/bunga/tambah', [BungaRusakController::class, 'store'])->name("rusak.bunga.store");
    Route::get('/rusak/bunga/edit{id}', [BungaRusakController::class, 'edit'])->name("rusak.bunga.edit");
    Route::post('/rusak/bunga/update{id}', [BungaRusakController::class, 'update'])->name("rusak.bunga.update");
    Route::post('/rusak/bunga/delete{id}', [BungaRusakController::class, 'destroy'])->name("rusak.bunga.delete");


    Route::get('/rusak/barang', [BarangRusakController::class, 'index'])->name('rusak.barang');
    Route::get('/rusak/barang/tambah', [BarangRusakController::class, 'create'])->name('rusak.barang.tambah');
    Route::post('/rusak/barang/tambah', [BarangRusakController::class, 'store'])->name("rusak.barang.store");
    Route::get('/rusak/barang/edit{id}', [BarangRusakController::class, 'edit'])->name("rusak.barang.edit");
    Route::post('/rusak/barang/update{id}', [BarangRusakController::class, 'update'])->name("rusak.barang.update");
    Route::post('/rusak/barang/delete{id}', [BarangRusakController::class, 'destroy'])->name("rusak.barang.delete");


    Route::get('/produk/unit', [UnitController::class, 'index'])->name('produk.unit');
    Route::get('/produk/unit/tambah', [UnitController::class, 'create'])->name('produk.unit.tambah');
    Route::post('/produk/unit/tambah', [UnitController::class, 'store'])->name("produk.unit.store");
    Route::get('/produk/unit/edit{id}', [UnitController::class, 'edit'])->name("produk.unit.edit");
    Route::post('/produk/unit/update{id}', [UnitController::class, 'update'])->name("produk.unit.update");
    Route::post('/produk/unit/delete{id}', [UnitController::class, 'destroy'])->name("produk.unit.delete");

    Route::get('/produk/kategori', [KategoriController::class, 'index'])->name('produk.kategori');
    Route::get('/produk/kategori/tambah', [KategoriController::class, 'create'])->name('produk.kategori.tambah');
    Route::post('/produk/kategori/tambah', [KategoriController::class, 'store'])->name("produk.kategori.store");
    Route::get('/produk/kategori/edit{id}', [KategoriController::class, 'edit'])->name("produk.kategori.edit");
    Route::post('/produk/kategori/update{id}', [KategoriController::class, 'update'])->name("produk.kategori.update");
    Route::post('/produk/kategori/delete{id}', [KategoriController::class, 'destroy'])->name("produk.kategori.delete");


    Route::get('/pesanan_masuk/pesananMasuk', [PesananMasukController::class, 'index'])->name('pesanan_masuk.pesananMasuk');
    Route::get('/pesanan_masuk/pesananMasuk/edit{id}', [PesananMasukController::class, 'edit'])->name('pesanan_masuk.pesananMasuk.edit');
    Route::post('/pesanan_masuk/pesananMasuk/update{id}', [PesananMasukController::class, 'update'])->name('pesanan_masuk.pesananMasuk.update');

    Route::get('/Laba', [LabaController::class, 'index'])->name('laba');
    Route::post('/Laba', [LabaController::class, 'cekRekap'])->name('laba.cekRekap');

    Route::get("/GenerateReport",[GenerateReportController::class,'generatePDF'])->name("generate-report");

    Route::get('/barang', function () {
        return view('admin.barang');
    });
});

Route::get('/logout', function (Request $request) {

    $user = User::where("username", $request->input("username"));
    $user->update([
        "token" => ""
    ]);
    session()->remove("kembangku_user_token");
    return redirect()->route("user.logout");

})->name('user.logout')->middleware(VerifyUser::class);

Route::get('/login', [LoginController::class, 'index'])->name('user.login');
Route::post('/login', [LoginController::class, 'store'])->name('user.login.store');

Route::post("/tambah_pesanan", function (Request $request) {

    $data = $request->json()->all();
    $unique_id = time();
    $tanggal_order = date('Y-m-d');


    foreach ($data["items"] as $item) {

        if ($item["kategori"] === "bunga") {
            $BungaMasuk = BungaMasuk::where("id", $item["id_bunga"])->first();
            $kategori = Kategoris::where("id", $item["id_kategori"])->first();
            if ($BungaMasuk === null || $kategori === null) {
                return response()->json([
                    "status" => false,
                    "message" => "bunga yang dipesan tidak ada"
                ]);
            } else {

                if ($BungaMasuk->jumlah_bunga < $item["jumlah"] || $kategori->jumlah_bunga_dijual < $item["jumlah"]) {
                    return response()->json([
                        "status" => false,
                        "bunga_masuk" => $BungaMasuk->jumlah_bunga,
                        "bunga_dijual" => $kategori->jumlah_bunga_dijual,
                        "message" => "Jumlah bunga yang dipesan tidak cukup"
                    ]);
                }

                $BungaMasuk->update([
                    "jumlah_bunga" => $BungaMasuk->jumlah_bunga - $item["jumlah"]
                ]);

                $kategori->update([
                    "jumlah_bunga_dijual" => $kategori->jumlah_bunga_dijual - $item["jumlah"]
                ]);

                BungaKeluar::insert([
                    'nama_bunga' => $item["nama_bunga"],
                    'jumlah_bunga' => $item["jumlah"],
                    'id_bunga' => $item["id_bunga"],
                    'tanggal_keluar' => $tanggal_order,
                    'id_bunga_keluar' => $unique_id,
                    'total_harga' => $item["jumlah"] * $item["harga_barang"],
                    'status' => "selesai"
                ]);
            }
        }

        if ($item["kategori"] === "barang") {
            $BarangMasuk = BarangMasuk::where("id", $item["id_barang"])->first();
            if ($BarangMasuk === null) {
                return response()->json([
                    "status" => false,
                    "message" => "barang yang dipesan tidak ada"
                ]);
            } else {

                if ($BarangMasuk->jumlah_barang < $item["jumlah"]) {
                    return response()->json([
                        "status" => false,
                        "message" => "Jumlah barang yang dipesan tidak cukup"
                    ]);
                }

                $BarangMasuk->update([
                    "jumlah_barang" => $BarangMasuk->jumlah_barang - $item["jumlah"]
                ]);

                BarangKeluar::insert([
                    'nama_barang' => $item["nama_barang"],
                    'jumlah_barang' => $item["jumlah"],
                    'id_barang' => $item["id_barang"],
                    'tanggal_keluar' => $tanggal_order,
                    'id_barang_keluar' => $unique_id,
                    'total_harga' => $item["jumlah"] * $item["harga_barang"],
                    'status' => "selesai"
                ]);
            }
        }

    }

    PesananMasuk::insert([
        'nama_pesanan' => $data["nama_pembeli"],
        'tanggal_pesanan' => $tanggal_order,
        'status_pesanan' => "diproses",
        'total_tagihan' => $data["total"],
        'jumlah_pesanan' => $data["total_pesanan"],
        'id_bunga_keluar' => $unique_id,
        'id_barang_keluar' => $unique_id,
        'nama_produk' => $data["nama_produk"],
        'biaya_jasa' => $data["biaya_jasa"],
        'pembayaran' => $data["pembayaran"],
        'kembalian' => $data["kembalian"]
    ]);

    $current_id = PesananMasuk::latest()->first();

    // menambah data bunga keluar
    return response()->json([
        "status" => true,
        "struk_id" => $current_id->id,
        "message" => "berhasil menambahkan data pesanan"
    ]);

})->name("test");

