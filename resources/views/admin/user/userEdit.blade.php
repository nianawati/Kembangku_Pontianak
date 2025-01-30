@extends('dashboard')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Edit User</h4>
                <form action="{{ route('user.update', $id->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif
                    <div class="mb-3">
                        <label for="username">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input type="text" name="username" value="{{ $id->username }}" class="form-control"
                                id="username" placeholder="Username" required>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email <span class="text-muted">(Optional)</span></label>
                        <input type="email" value="{{ $id->email }}" name="email" class="form-control" id="email"
                            placeholder="you@example.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="foto_profile">Foto Profile</label>
                        <div class="priview">
                            <img width="200" id="img" src="" alt="">
                        </div>
                        <div class="input-group">
                            <input type="file" accept="image/png, image/gif, image/jpeg" name="foto_profile" value="{{ old('foto_profile') }}" class="form-control"
                                id="foto_profile" placeholder="Foto Profile" required>
                        </div>
                        <script>
                            foto_profile.onchange = d => {
                                const [file] = foto_profile.files;
                                if (file) {
                                    img.src = URL.createObjectURL(file);
                                }
                            }
                        </script>
                    </div>
                    <div class="mb-3">
                        <label for="rule">Rule</label>
                        <select name="rule" id="rule" class="form-select form-control"
                            aria-label="Default select example">
                            <option {{ strcmp($id->rule, 'admin') == 0 ? 'selected' : '' }} value="admin">Admin</option>
                            <option {{ strcmp($id->rule, 'karyawan') == 0 ? 'selected' : '' }} value="karyawan">Karyawan
                            </option>
                        </select>
                        <hr class="mb-4">
                        <button class="btn btn-primary btn-lg btn-block" type="submit">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
