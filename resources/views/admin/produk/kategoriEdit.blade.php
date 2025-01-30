@extends('dashboard')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Edit Kategori</h4>
                <form action="{{ route('produk.kategori.update', $id->id) }}" method="POST">
                    @csrf
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif
                    <div class="alert alert-warning">{{ $BungaMasuk->nama_bunga }}, Jumlah Bunga Masuk : {{ $BungaMasuk->jumlah_bunga }}</div>
                    <div class="mb-3">
                        <label for="rule">ID Kategori</label>
                        <input type="text" value="{{ $id->id }}" readonly name="id" class="form-control"
                            id="nama_bunga" placeholder="Id kategori">
                    </div>
                    <div class="mb-3">
                        <label for="nama_unit">Jumlah bunga yang tersedia</label>
                        <div class="input-group">
                            <input type="number" value="{{ $id->jumlah_bunga_dijual }}" name="jumlah_bunga_dijual" value="{{ old('jumlah_bunga_dijual') }}"
                                class="form-control" id="nama_unit"
                                placeholder="Jumlah bunga yang akan di display pada kasir" required>
                        </div>
                        <hr class="mb-4">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Edit Kategori Bunga Yang Di
                            Jual</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
