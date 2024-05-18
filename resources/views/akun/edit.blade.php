<!-- resources/views/user/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="rounded-4 card mb-5 p-5">
        <div class="container">
            <h2>Edit Pengguna</h2>

            <form action="{{ url('akun/update', $akun->id) }}" method="POST">
                @csrf
                <p><b>Kolom bertanda <span class="text-danger">*</span> tidak boleh kosong</b></p>
                <div class="row">
                    <div class="col px-4">
                        <div class="row py-2">
                            <label for="name">Nama <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                placeholder="Masukkan Nama" value="{{ $akun->name }}">
                            @error('name')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="row py-2">
                            <label for="username">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username"
                                class="form-control @error('username') is-invalid @enderror" placeholder="Masukkan Username"
                                value="{{ $akun->username }}">
                            @error('username')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="row py-2">
                            <label for="password">Password</label>
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
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                placeholder="Masukkan Email" value="{{ $akun->email }}">
                            @error('email')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>
                        <div class="row py-2">
                            <label for="role">Role <span class="text-danger">*</span></label>
                            <select name="role" class="form-control @error('role') is-invalid @enderror">
                                <option value="admin" {{ $akun->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="dosen" {{ $akun->role == 'dosen' ? 'selected' : '' }}>Dosen</option>
                                <option value="mahasiswa" {{ $akun->role == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa
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
                        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan Data</button>
                        <a href="/akun" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    @endsection
