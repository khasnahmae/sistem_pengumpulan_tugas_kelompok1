@extends('layouts.app')

@section('content')
    <div class="rounded-4 card mb-5 p-5">
        <div class="d-flex justify-content-between">
            <h2>Data Tugas</h2>
            <div class="mb-3">
                <a href="/tugas/pengumpulans" class="btn btn-primary">Penilaian</a>
                <a href="{{ route('tugas.create') }}" class="btn btn-primary">Tambah Tugas</a>
            </div>
        </div>

        <table class="table-hover table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mata Kuliah</th>
                    <th>Semester</th>
                    <th>Pertemuan</th>
                    <th>Tanggal Buat</th>
                    <th>Tanggal Deadline</th>
                    <th>File Tugas</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($queries as $tugas)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $tugas->matkul }}</td>
                        <td>{{ $tugas->semester }}</td>
                        <td>{{ $tugas->pertemuan }}</td>
                        <td>{{ $tugas->tgl_buat }}</td>
                        <td>{{ $tugas->tgl_dl }}</td>
                        <td>
                            @if ($tugas->file_tugas)
                                <a href="{{ asset('storage/filetugas/' . $tugas->file_tugas) }}"
                                    class="btn btn-success btn-sm">Download</a>
                            @else
                                Tidak ada file
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('tugas.edit', $tugas->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form class="d-inline" action="{{ route('tugas.destroy', [$tugas->id]) }}" method="POST"
                                onsubmit="return confirm('Yakin hapus data?')">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $queries->links() }}
    </div>
@endsection
