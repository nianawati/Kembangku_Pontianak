@extends('dashboard')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Edit Barang</h4>
                <form action="{{ route('barang.keluar.update', $id->id) }}" method="POST">
                    @csrf
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif
                    <div class="mb-3">
                        <label for="nama_barang">ID Barang ({{ $id->nama_barang }})</label>
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
                        <label for="tanggal_keluar">Tanggal Keluar</label>
                        <input type="date" value="{{ $id->tanggal_keluar }}" name="tanggal_keluar" class="form-control"
                            id="tanggal_keluar" placeholder="tanggal keluar">
                        
                    </div>

                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Update Barang</button>
            </div>
            </form>
        </div>
    </div>
    </div>
@endsection
