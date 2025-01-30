@extends('dashboard')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Tambah Barang Masuk</h4>
                <form action="{{ route('barang.masuk.tambah') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif
                    <div class="mb-3">
                        <label for="nama_barang">Nama Barang</label>
                        <input type="text" value="{{ old('nama_barang') }}" name="nama_barang" class="form-control"
                            id="nama_barang" placeholder="nama barang">
                        @error('nama_barang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
                        <label for="harga_beli">Harga Beli</label>
                        <input type="number" value="{{ old('harga_beli') }}" name="harga_beli" class="form-control"
                            id="harga_beli" placeholder="harga beli">
                        @error('harga_beli')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="harga_barang">Harga Barang</label>
                        <input type="number" value="{{ old('harga_barang') }}" name="harga_barang" class="form-control"
                            id="harga_barang" placeholder="harga barang">
                        @error('harga_barang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="kategori">Kategori Barang</label>
                        <input type="text" value="{{ old('kategori') }}" name="kategori" class="form-control"
                            id="kategori" placeholder="kategori">
                        @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_order">Tanggal Order</label>
                        <input type="date" value="{{ old('tanggal_order') }}" name="tanggal_order" class="form-control"
                            id="tanggal_order" placeholder="Tanggal order">
                        @error('tanggal_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="foto_barang">Foto Bunga</label>
                        <div class="priview">
                            <img width="200" id="img" src="" alt="">
                        </div>
                        <div class="input-group">
                            <input type="file" accept="image/png, image/gif, image/jpeg" name="foto_barang" value="{{ old('foto_barang') }}" class="form-control"
                                id="foto_barang" placeholder="Foto barang" required>
                        </div>
                        <script>
                            foto_barang.onchange = d => {
                                const [file] = foto_barang.files;
                                if (file) {
                                    img.src = URL.createObjectURL(file);
                                }
                            }
                        </script>
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
