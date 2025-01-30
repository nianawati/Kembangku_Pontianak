@extends('dashboard')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Edit Barang Rusak</h4>
                <form action="{{ route('rusak.barang.update', $id->id) }}" method="POST">
                    @csrf
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif
                    <div class="mb-3">
                        <label for="nama_barang">ID barang ({{ $id->nama_barang }})</label>
                        <input type="text" value="{{ $id->id_barang }}" readonly name="id_barang" class="form-control"
                            id="nama_barang" placeholder="nama barang">
                        @error('nama_barang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jumlah_barang">Jumlah Barang</label>
                        <input type="number" value="{{ $id->jumlah_barang }}" name="jumlah_barang" class="form-control"
                            id="jumlah_barang" placeholder="jumlah barang">
                        @error('jumlah_barang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_order">Tanggal Order</label>
                        <input type="date" value="{{ $id->tanggal_order }}" name="tanggal_order" class="form-control"
                            id="tanggal_order" placeholder="tanggal order">
                        @error('tanggal_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit"> Update Barang Rusak</button>
            </div>
            </form>
        </div>
    </div>
    </div>
@endsection
