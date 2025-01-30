@extends('dashboard')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Edit Bunga Rusak</h4>
                <form action="{{ route('rusak.bunga.update', $id->id) }}" method="POST">
                    @csrf
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif
                    <div class="mb-3">
                        <label for="nama_bunga">ID Bunga ({{ $id->nama_bunga }})</label>
                        <input type="text" value="{{ $id->id_bunga }}" readonly name="id_bunga" class="form-control"
                            id="nama_bunga" placeholder="nama bunga">
                        @error('nama_bunga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jumlah_bunga">Jumlah Bunga</label>
                        <input type="number" value="{{ $id->jumlah_bunga }}" name="jumlah_bunga" class="form-control"
                            id="jumlah_bunga" placeholder="jumlah bunga">
                        @error('jumlah_bunga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_order">Tanggal order</label>
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
