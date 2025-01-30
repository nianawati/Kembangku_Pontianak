@extends('dashboard')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Tambah Bunga Masuk</h4>
                <form enctype="multipart/form-data" action="{{ route('bunga.masuk.tambah') }}" method="POST">
                    @csrf
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif
                    <div class="mb-3">
                        <label for="nama_bunga">Nama Bunga</label>
                        <input type="text" value="{{ old('nama_bunga') }}" name="nama_bunga" class="form-control" id="nama_bunga"
                            placeholder="nama bunga">
                        @error('nama_bunga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="jumlah_bunga">Jumlah Bunga</label>
                        <input type="number" value="{{ old('jumlah_bunga') }}" name="jumlah_bunga" class="form-control" id="jumlah_bunga"
                            placeholder="jumlah bunga">
                        @error('jumlah_bunga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="harga_bunga">Harga Bunga</label>
                        <input type="number" value="{{ old('harga_bunga') }}" name="harga_bunga" class="form-control" id="harga_bunga"
                            placeholder="harga bunga">
                        @error('harga_bunga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="harga_beli">Harga Beli</label>
                        <input type="number" value="{{ old('harga_beli') }}" name="harga_beli" class="form-control" id="harga_beli"
                            placeholder="harga beli">
                        @error('harga_beli')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="kategori">Kategori</label>
                        <input type="text" value="{{ old('kategori') }}" name="kategori" class="form-control" id="kategori"
                            placeholder="kategori">
                        @error('kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_order">Tanggal Order</label>
                        <input type="date" value="{{ old('tanggal_order') }}" name="tanggal_order" class="form-control" id="tanggal_order"
                            placeholder="tanggal order">
                        @error('tanggal_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="foto_bunga">Foto Bunga</label>
                        <div class="priview">
                            <img width="200" id="img" src="" alt="">
                        </div>
                        <div class="input-group">
                            <input type="file" accept="image/png, image/gif, image/jpeg" name="foto_bunga" value="{{ old('foto_bunga') }}" class="form-control"
                                id="foto_bunga" placeholder="Foto bunga" required>
                        </div>
                        <script>
                            foto_bunga.onchange = d => {
                                const [file] = foto_bunga.files;
                                if (file) {
                                    img.src = URL.createObjectURL(file);
                                }
                            }
                        </script>
                    </div>

                    <div class="mb-3">
                    
                        <hr class="mb-4">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Tambah Bunga</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
