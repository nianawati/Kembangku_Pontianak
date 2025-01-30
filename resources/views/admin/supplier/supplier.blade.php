@extends('dashboard')
@section('content')
    <a class="btn btn-primary mb-4" href="{{ route('supplier.tambah') }}">Tambah Supplier</a>
    @if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <div class="table-responsive">
        <table id="table" class="table table-hover table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Supplier</th>
                    <th>No Handphone</th>
                    <th>Alamat</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                 $no = 1;   
                @endphp
                @foreach ($supplier as $u)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $u->nama_supplier }}</td>
                        <td>{{ $u->no_hp }}</td>
                        <td>{{ $u->alamat }}</td>
                        <td>{{ $u->deskripsi }}</td>
                        <td>
                        <div style="gap: 10px; height:100%" class="d-flex flex-wrap">
                            <a href="{{ route('supplier.edit', $u->id) }}" class="btn btn-warning">
                                Edit
                            </a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#hapusSupplier{{ $u->id }}">
                                Delete
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="hapusSupplier{{ $u->id }}" tabindex="-1"
                                aria-labelledby="hapusSupplier" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fs-5" id="exampleModalLabel">Pemberitahuan</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('supplier.delete', $u->id) }}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    Apakah anda yakin ingin menghapus Supplier {{ $u->nama_supplier }}?
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
