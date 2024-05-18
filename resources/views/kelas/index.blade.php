@extends('layouts.app')

@section('content')
    <div class="rounded-2 bg-light container mb-5 mt-5 p-5 shadow-lg">
        <div class="d-flex justify-content-between">
            <h2>Data Kelas</h2>

            <div class="mb-3">
                <a href="{{ route('kelas.create') }}" class="btn btn-primary">Tambah Kelas</a>
            </div>
        </div>

        <table class="table-hover table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kelas</th>
                    <th>Prodi</th>
                    <th>Wali Kelas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($queries as $kelas)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $kelas->kelas }}</td>
                        <td>{{ $kelas->prodi }}</td>
                        <td>{{ $kelas->waliKelas->nama }}</td> <!-- Mengakses nama dosen dengan menggunakan relasi -->  
                        <td>
                            {{-- <a href="{{ route('dosen.show', $dosen->id) }}" class="btn btn-info btn-sm">Detail</a> --}}
                            <a href="{{ route('kelas.edit', $kelas->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('kelas.destroy', $kelas->id) }}" method="POST" style="display:inline;">
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
