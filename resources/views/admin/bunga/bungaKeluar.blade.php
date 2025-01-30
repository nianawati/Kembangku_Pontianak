@extends('dashboard')
@section('content')
    <a class="btn btn-primary mb-4" href="{{ route('bunga.keluar.tambah') }}">Tambah Bunga Keluar</a>
    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="table-responsive">
        <table id="table" class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Bunga Keluar</th>
                    <th>Nama Bunga</th>
                    <th>Jumlah Bunga</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Tanggal Keluar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                 $no = 1;   
                @endphp
                @foreach ($BungaKeluar as $u)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $u->id_bunga_keluar }}</td>
                        <td>{{ $u->nama_bunga }}</td>
                        <td>{{ $u->jumlah_bunga }}</td>
                        <td>{{ $u->total_harga }}</td>
                        <td>{{ $u->status }}</td>
                        <td>{{ $u->tanggal_keluar }}</td>
                        <td>
                        <div style="gap: 10px; height:100%" class="d-flex flex-wrap">
                            <a href="{{ route('bunga.keluar.edit', $u->id) }}" class="btn btn-warning">
                                Edit
                            </a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#hapusbungakeluar{{ $u->id }}">
                                Delete
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="hapusbungakeluar{{ $u->id }}" tabindex="-1"
                                aria-labelledby="hapusbungakeluar" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fs-5" id="exampleModalLabel">Pemberitahuan</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('bunga.keluar.delete', $u->id) }}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    Apakah anda yakin ingin menghapus bunga {{ $u->nama_bunga}}?
                                                    <input type="hidden">
                                                    <br>
                                                    <br>
                                                    <button type="submit" class="btn btn-danger"
                                                        name="hapusbungakeluar">Hapus</button>
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
