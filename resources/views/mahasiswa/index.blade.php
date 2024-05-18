@extends('layouts.app')

@section('content')
    <div class="rounded-4 card mb-5 p-5">
        <div class="d-flex justify-content-between">
            <h2>Data Mahasiswa</h2>

            <div class="mb-3">
                <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">Tambah Mahasiswa</a>
            </div>
        </div>

        <table class="table-hover table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Prodi</th>
                    <th>Semester</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($queries as $mahasiswa => $row)
                    <tr>
                        <td>{{ $queries->firstItem() + $mahasiswa }}</td>
                        <td>{{ $row->nim }}</td>
                        <td>{{ $row->nama }}</td>
                        <td>{{ $row->prodi }}</td>
                        <td>{{ $row->semester }}</td>
                        <td>
                            <a href="{{ route('mahasiswa.detail', $row->id) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('mahasiswa.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('mahasiswa.destroy', $row->id) }}" method="POST"
                                style="display:inline;">
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

        {{ $queries->links() }}
    </div>
@endsection
