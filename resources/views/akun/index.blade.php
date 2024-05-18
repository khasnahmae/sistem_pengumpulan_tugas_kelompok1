<!-- resources/views/user/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="rounded-4 card mb-5 p-5">
        <div class="d-flex justify-content-between">
            <h2>Data Pengguna</h2>

            <div class="mb-3">
                <a href="/akun/create" class="btn btn-primary">Tambah Pengguna</a>
            </div>
        </div>

        <table class="table-hover table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($akun as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>
                            <a href="{{ url('akun/detail', $user->id) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ url('akun/edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ url('akun/destroy', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $akun->links() }}
    </div>
@endsection
