<!-- resources/views/user/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="rounded-4 card mb-5 p-5">
        <div class="row justify-content-center">
            <h1>Tambah Pengguna</h1>
            <p><b>Kolom bertanda <span class="text-danger">*</span> tidak boleh kosong</b></p>

            <div class="">
                <form action="{{ url('akun/store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col px-4">
                            <div class="row py-2">
                                <label for="name">Nama <span class="text-danger">*</span></label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan Nama"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="row py-2">
                                <label for="username">Username <span class="text-danger">*</span></label>
                                <input type="text" name="username"
                                    class="form-control @error('username') is-invalid @enderror"
                                    placeholder="Masukkan Username" value="{{ old('username') }}">
                                @error('username')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="row py-2">
                                <label for="password">Password <span class="text-danger">*</span></label>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Masukkan Password">
                                @error('password')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="row py-2">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="row py-2">
                                <label for="role">Role <span class="text-danger">*</span></label>
                                <select name="role" class="form-control @error('role') is-invalid @enderror">
                                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="dosen" {{ old('role') == 'dosen' ? 'selected' : '' }}>Dosen</option>
                                    <option value="mahasiswa" {{ old('role') == 'mahasiswa' ? 'selected' : '' }}>
                                        Mahasiswa
                                    </option>
                                </select>
                                @error('role')
                                    <small class="text-danger">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="my-2">
                            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan
                                Data</button>
                            <a href="{{ url('akun') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i>
                                Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
