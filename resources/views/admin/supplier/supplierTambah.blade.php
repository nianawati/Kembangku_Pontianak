@extends('dashboard')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Tambah Supplier</h4>
                <form action="{{ route('supplier.tambah') }}" method="POST">
                    @csrf
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif
                    <div class="mb-3">
                        <label for="nama_supplier">Nama Supplier</label>
                        <div class="input-group">
                            <input type="text" name="nama_supplier" value="{{ old('nama_supplier') }}"
                                class="form-control" id="nama_supplier" placeholder="Nama Supplier" required>
                            @error('nama_supplier')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="no_hp">No Handphone<span class="text-muted"></span></label>
                        <input type="no_hp" value="{{ old('no_hp') }}" name="no_hp" class="form-control" id="no_hp"
                            placeholder="No Handphone">
                        @error('no_hp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="alamat">Alamat</label>
                        <input type="text" value="{{ old('alamat') }}" name="alamat" class="form-control" id="alamat"
                            placeholder="Alamat">
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" value="{{ old('deskripsi') }}" name="deskripsi" class="form-control"
                            id="deskripsi" placeholder="Deskripsi">
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <hr class="mb-4">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Tambah Supplier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
