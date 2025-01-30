@extends('dashboard')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Edit status pesanan</h4>
                <form action="{{ route('pesanan_masuk.pesananMasuk.update', $id->id) }}" method="POST">
                    @csrf
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif 
                    <div class="mb-3">
                        <label for="status_pesanan">Status Pesanan</label>
                        <select name="status_pesanan" id="status_pesanan" class="form-select form-control"
                            aria-label="Default select example">
                            <option {{ strcmp($id->status_pesanan, 'diproses') == 0 ? 'selected' : '' }} value="diproses">DiProses</option>
                            <option {{ strcmp($id->status_pesanan, 'selesai') == 0 ? 'selected' : '' }} value="selesai">Selesai</option>
                            <option {{ strcmp($id->status_pesanan, 'dibatalkan') == 0 ? 'selected' : '' }} value="dibatalkan">Dibatalkan</option>
                        </select>
                        <hr class="mb-4">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Update status pesanan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
