@extends('dashboard')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Tambah Barang Keluar</h4>
                <form action="{{ route('barang.keluar.tambah') }}" method="POST">
                    @csrf
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif

                    <div class="mb-3">
                        <label for="rule">ID Barang</label>
                        <select name="id_barang" id="rule" class="form-select form-control"
                            aria-label="Default select example">
                            <option style="display:none;" selected>Pilih ID</option>
                            @foreach ($BarangMasuk as $bm)
                                <option value="{{ $bm->id }}">{{ $bm->id }} {{ $bm->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="jumlah_barang">Jumlah Barang</label>
                        <input type="number" value="{{ old('jumlah_barang') }}" name="jumlah_barang" class="form-control"
                            id="jumlah_barang" placeholder="jumlah barang">
                        @error('jumlah_barang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_keluar">Tanggal Keluar</label>
                        <input type="date" value="{{ old('tanggal_keluar') }}" name="tanggal_keluar" class="form-control"
                            id="tanggal_keluar" placeholder="tanggal keluar">
                        @error('tanggal_keluar')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">

                        <hr class="mb-4">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Tambah Barang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
