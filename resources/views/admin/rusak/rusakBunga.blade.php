@extends('dashboard')
@section('content')
    <a class="btn btn-primary mb-4" href="{{ route('rusak.bunga.tambah') }}">Tambah Bunga Rusak</a>
    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="table-responsive">
        <table id="table" class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Bunga</th>
                    <th>Jumlah Bunga</th>
                    <th>Harga Bunga</th>
                    <th>Kategori</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                 $no = 1;   
                @endphp
                @foreach ($BungaRusak as $u)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $u->nama_bunga }}</td>
                        <td>{{ $u->jumlah_bunga }}</td>
                        <td>{{ $u->harga_bunga }}</td>
                        <td>{{ $u->kategori }}</td>
                        <td>{{ $u->tanggal_order }}</td>
                        <td>
                        <div style="gap: 10px; height:100%" class="d-flex flex-wrap">
                            <a href="{{ route('rusak.bunga.edit', $u->id) }}" class="btn btn-warning">
                                Edit
                            </a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#hapusbungarusak{{ $u->id }}">
                                Delete
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="hapusbungarusak{{ $u->id }}" tabindex="-1"
                                aria-labelledby="hapusbungarusak" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fs-5" id="exampleModalLabel">Pemberitahuan</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('rusak.bunga.delete', $u->id) }}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    Apakah anda yakin ingin menghapus bunga {{ $u->nama_bunga}}?
                                                    <input type="hidden">
                                                    <br>
                                                    <br>
                                                    <button type="submit" class="btn btn-danger"
                                                        name="hapusbungarusak">Hapus</button>
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
