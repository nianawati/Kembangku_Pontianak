@extends('dashboard')
@section('content')
    <a class="btn btn-primary mb-4" href="{{ route('barang.keluar.tambah') }}">Tambah Barang Keluar</a>
    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="table-responsive">
        <table id="table" class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Id Barang Keluar</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Jumlah Barang</th>
                    <th>Tanggal Keluar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                 $no = 1;   
                @endphp
                @foreach ($BarangKeluar as $u)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $u->nama_barang }}</td>
                        <td>{{ $u->id_barang_keluar }}</td>
                        <td>{{ $u->total_harga }}</td>
                        <td>{{ $u->status }}</td>
                        <td>{{ $u->jumlah_barang }}</td>
                        <td>{{ $u->tanggal_keluar }}</td>
                        <td style="gap: 10px;" class="d-flex">
                            <a href="{{ route('barang.keluar.edit', $u->id) }}" class="btn btn-warning">
                                Edit
                            </a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#hapusbarangkeluar{{ $u->id }}">
                                Delete
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="hapusbarangkeluar{{ $u->id }}" tabindex="-1"
                                aria-labelledby="hapusbarangkeluar" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fs-5" id="exampleModalLabel">Pemberitahuan</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('barang.keluar.delete', $u->id) }}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    Apakah anda yakin ingin menghapus barang {{ $u->nama_barang}}?
                                                    <input type="hidden">
                                                    <br>
                                                    <br>
                                                    <button type="submit" class="btn btn-danger"
                                                        name="hapusbarangkeluar">Hapus</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </form>
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
