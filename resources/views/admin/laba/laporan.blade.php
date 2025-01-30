@extends('dashboard')
@section('content')
    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="table-responsive">
        <table id="laporan" class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>Total Pendapatan</th>
                    <th>Total Keuntungan Bunga</th>
                    <th>Total Keuntungan Barang</th>
                    <th>Total Keuntungan Jasa</th>
                    <th>Modal Bunga</th>
                    <th>Modal Barang</th>
                    <th>Laba Kotor Bunga</th>
                    <th>Laba Kotor Barang</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $Laba }}</td>
                    <td>{{ $LabaBunga->total_pendapatan_bunga }}</td>
                    <td>{{ $LabaBarang->total_pendapatan_barang }}</td>
                    <td>{{ $TotalKeuntunganJasa->total_keuntungan_biaya_jasa }}</td>
                    <td>{{ $ModalBunga->total_modal_bunga }}</td>
                    <td>{{ $ModalBarang->total_modal_barang }}</td>
                    <td>{{ $LabaKotorBunga->laba_kotor_bunga }}</td>
                    <td>{{ $LabaKotorBarang->laba_kotor_barang }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        <div class="row">
            <div class="col-md-8 order-md-1">
                <h4 class="my-3">Tanggal Rekap Penjualan</h4>
                <form enctype="multipart/form-data" action="{{ route('laba.cekRekap') }}" method="POST">
                    @csrf
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif
                    <div class="mb-3">
                        <label for="tanggal_awal">Tanggal awal</label>
                        <input type="date" value="{{ old('tanggal_awal') }}" name="tanggal_awal" class="form-control"
                            id="tanggal_awal" placeholder="tanggal awal">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_akhir">Tanggal akhir</label>
                        <input type="date" value="{{ old('tanggal_akhir') }}" name="tanggal_akhir" class="form-control"
                            id="tanggal_akhir" placeholder="tanggal akhir">
                    </div>
                    
                    <div class="mb-3">

                        <hr class="mb-4">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Cek Laporan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
