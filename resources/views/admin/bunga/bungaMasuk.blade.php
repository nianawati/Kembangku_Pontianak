@extends('dashboard')
@section('content')
    <a class="btn btn-primary mb-4" href="{{ route('bunga.masuk.tambah') }}">Tambah Bunga Masuk</a>
    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="table-responsive">
        <table id="bunga_masuk" class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>
                        <input id="check_all" type="checkbox"/>
                    </th>
                    <th>No</th>
                    <th>ID</th>
                    <th>Nama Bunga</th>
                    <th>Foto Bunga</th>
                    <th>Jumlah Bunga</th>
                    <th>Harga Bunga</th>
                    <th>Harga Beli</th>
                    <th>Kategori</th>
                    <th>Tanggal Order</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                 $no = 1;   
                @endphp
                @foreach ($BungaMasuk as $u)
                    <tr>
                        <td><input class="check" type="checkbox"/></td>
                        <td>{{ $no++ }}</td>
                        <td>{{ $u->id }}</td>
                        <td>{{ $u->nama_bunga }}</td>
                        <td><img width="150" src="{{'/foto_bunga/'.$u->foto }}"/></td>
                        <td>{{ $u->jumlah_bunga }}</td>
                        <td>{{ $u->harga_bunga }}</td>
                        <td>{{ $u->harga_beli }}</td>
                        <td>{{ $u->kategori }}</td>
                        <td>{{ $u->tanggal_order }}</td>
                        <td>
                        <div style="gap: 10px; height:100%" class="d-flex flex-wrap">
                            <a href="{{ route('bunga.masuk.edit', $u->id) }}" class="btn btn-warning">
                                Edit
                            </a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#hapusbungamasuk{{ $u->id }}">
                                Delete
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="hapusbungamasuk{{ $u->id }}" tabindex="-1"
                                aria-labelledby="hapusbungamasuk" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fs-5" id="exampleModalLabel">Pemberitahuan</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('bunga.masuk.delete', $u->id) }}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    Apakah anda yakin ingin menghapus bunga {{ $u->nama_bunga}}?
                                                    <input type="hidden">
                                                    <br>
                                                    <br>
                                                    <button type="submit" class="btn btn-danger"
                                                        name="hapusbungamasuk">Hapus</button>
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
