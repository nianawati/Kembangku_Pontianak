@extends('dashboard')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Tambah Kategori</h4>
                <form action="{{ route('produk.kategori.tambah') }}" method="POST">
                    @csrf
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif
                    <div class="mb-3">
                        <label for="rule">ID Bunga</label>
                        <select name="id_bunga" id="rule" class="form-select form-control"
                            aria-label="Default select example">
                            <option style="display:none;" selected>Pilih ID</option>
                            @foreach ($BungaMasuk as $bm)
                                <option value="{{ $bm->id }}">id ({{ $bm->id }}), nama bunga ({{ $bm->nama_bunga }}), jumlah bunga masuk ({{ $bm->jumlah_bunga }})</option>
                            @endforeach
                        </select>
                        
                    </div>
                    <div class="mb-3">
                        <label for="nama_unit">Jumlah bunga yang tersedia</label>
                        <div class="input-group">
                            <input type="text" name="jumlah_bunga_dijual" value="{{ old('jumlah_bunga_dijual') }}" class="form-control"
                                id="nama_unit" placeholder="Jumlah bunga yang akan di display pada kasir" required>
                        </div>
                        <hr class="mb-4">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Tambah Kategori Bunga Yang Di Jual</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
