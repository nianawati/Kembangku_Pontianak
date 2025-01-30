@extends('dashboard')
@section('content')
    <a class="btn btn-primary mb-4" href="{{ route('rusak.barang.tambah') }}">Tambah Barang Rusak</a>
    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="table-responsive">
        <table id="table" class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Barang</th>
                    <th>Harga Barang</th>
                    <th>Kategori</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                 $no = 1;   
                @endphp
                @foreach ($BarangRusak as $u)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $u->nama_barang }}</td>
                        <td>{{ $u->jumlah_barang }}</td>
                        <td>{{ $u->harga_barang }}</td>
                        <td>{{ $u->kategori }}</td>
                        <td>{{ $u->tanggal_order }}</td>
                        <td>
                        <div style="gap: 10px; height:100%" class="d-flex flex-wrap">
                            <a href="{{ route('rusak.barang.edit', $u->id) }}" class="btn btn-warning">
                                Edit
                            </a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#hapusbarangrusak{{ $u->id }}">
                                Delete
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="hapusbarangrusak{{ $u->id }}" tabindex="-1"
                                aria-labelledby="hapusbarangrusak" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fs-5" id="exampleModalLabel">Pemberitahuan</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('rusak.barang.delete', $u->id) }}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    Apakah anda yakin ingin menghapus barang {{ $u->nama_barang}}?
                                                    <input type="hidden">
                                                    <br>
                                                    <br>
                                                    <button type="submit" class="btn btn-danger"
                                                        name="hapusbarangrusak">Hapus</button>
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
