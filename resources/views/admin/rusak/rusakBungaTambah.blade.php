@extends('dashboard')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Tambah Bunga Rusak</h4>
                <form action="{{ route('rusak.bunga.tambah') }}" method="POST">
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
                        <label for="jumlah_bunga">Jumlah Bunga</label>
                        <input type="number" value="{{ old('jumlah_bunga') }}" name="jumlah_bunga" class="form-control"
                            id="jumlah_bunga" placeholder="jumlah bunga">
                        @error('jumlah_bunga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_order">Tanggal</label>
                        <input type="date" value="{{ old('tanggal_order') }}" name="tanggal_order" class="form-control"
                            id="tanggal_order" placeholder="tanggal order">
                        @error('tanggal_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">

                        <hr class="mb-4">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Tambah Bunga Rusak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
