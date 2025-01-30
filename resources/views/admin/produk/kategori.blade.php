@extends('dashboard')
@section('content')
    <a class="btn btn-primary mb-4" href="{{ route('produk.kategori.tambah') }}">Tambah Kategori</a>
    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="table-responsive">
        <table id="table" class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Bunga</th>
                    <th>Foto Bunga</th>
                    <th>Harga Bunga</th>
                    <th>Jumlah Bunga Masuk</th>
                    <th>Jumlah Ketersediaan</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @php
                 $no = 1;   
                @endphp
                @foreach ($kategori as $u)
                    
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $u->nama_bunga }}</td>
                        <td><img width="150" src="{{'/foto_bunga/'.$u->foto }}"/></td>
                        <td>{{ $u->harga_bunga }}</td>
                        <td>{{ $u->jumlah_bunga }}</td>
                        <td>{{ $u->jumlah_bunga_dijual }}</td>

                        <td>
                        
                        <div style="gap: 10px; height:100%" class="d-flex flex-wrap">
                            <a href="{{ route('produk.kategori.edit', $u->id) }}" class="btn btn-warning">
                                Edit
                            </a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#hapusunit{{ $u->id }}">
                                Delete
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="hapusunit{{ $u->id }}" tabindex="-1"
                                aria-labelledby="hapusunit" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fs-5" id="exampleModalLabel">Pemberitahuan</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('produk.kategori.delete', $u->id) }}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    Apakah anda yakin ingin menghapus kategori {{ $u->nama_bunga }}?
                                                    <input type="hidden">
                                                    <br>
                                                    <br>
                                                    <button type="submit" class="btn btn-danger"
                                                        name="hapusbarang">Hapus</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
