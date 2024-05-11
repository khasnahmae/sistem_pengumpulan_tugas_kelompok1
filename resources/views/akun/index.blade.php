<!-- resources/views/user/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="rounded-4 mb-5 p-5 card">
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

                @foreach ($akun as $user => $row)
                    <tr>
                        <td>{{ $akun->firstItem() + $user }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->username }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->role }}</td>
                        <td>
                            <a href="{{ url('akun/detail', $row->id) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ url('akun/edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ url('akun/destroy', $row->id) }}" method="POST" style="display:inline;">
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
