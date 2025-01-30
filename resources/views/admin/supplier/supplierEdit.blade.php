@extends('dashboard')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Edit Supplier</h4>
                <form action="{{ route('supplier.update', $id->id) }}" method="POST">
                    @csrf
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif
                    <div class="mb-3">
                        <label for="nama_supplier">Nama supplier</label>
                        <input type="text" value="{{ $id->nama_supplier }}" name="nama_supplier" class="form-control"
                            id="nama_supplier" placeholder="nama supplier">
                        @error('nama_supplier')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="no_hp">No Handphone</label>
                        <input type="no_hp" value="{{ $id->no_hp }}" name="no_hp" class="form-control" id="no_hp"
                            placeholder="No Handphone">
                        @error('no_hp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="alamat">Alamat</label>
                        <input type="text" value="{{ $id->alamat }}" name="alamat" class="form-control" id="alamat"
                            placeholder="Alamat">
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" value="{{ $id->deskripsi }}" name="deskripsi" class="form-control"
                            id="deskripsi" placeholder="deskripsi">
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Update Supplier</button>
            </div>
            </form>
        </div>
    </div>
    </div>
@endsection
