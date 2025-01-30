@extends('dashboard')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Edit Bunga Rusak</h4>
                <form action="{{ route('produk.unit.update', $id->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif
                    <div class="mb-3">
                        <label for="nama_unit">Nama Unit</label>
                        <input type="text" value="{{ $id->nama_unit }}" name="nama_unit" class="form-control"
                            id="nama_unit" placeholder="nama unit">
                    </div>
                    <div class="mb-3">
                        <label for="foto_unit">Foto Unit</label>
                        <div class="priview">
                            <img width="200" id="img" src="{{ '/uploads/'.$id->foto }}" alt="">
                        </div>
                        <div class="input-group">
                            <input type="file" name="foto_unit" value="{{ old('foto_unit') }}" class="form-control"
                                id="foto_unit" placeholder="Foto unit">
                        </div>
                        <script>
                            foto_unit.onchange = d => {
                                const [file] = foto_unit.files;
                                if (file) {
                                    img.src = URL.createObjectURL(file);
                                }
                            }
                        </script>
                    </div>
                    <div class="mb-3">
                        <label for="biaya_jasa">Biaya Jasa</label>
                        <input type="number" min="0" value="{{ $id->biaya_jasa }}" name="biaya_jasa" class="form-control"
                            id="biaya_jasa" placeholder="biaya jasa pembuatan">
                    </div>
                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit"> Update Unit</button>
            </div>
            </form>
        </div>
    </div>
    </div>
@endsection
