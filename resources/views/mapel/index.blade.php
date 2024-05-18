@extends('layouts.app')

@section('content')
    <div class="rounded-4 card mb-5 p-5">
        <div class="d-flex justify-content-between">
            <h2>Data Mapel</h2>
            <div class="mb-3">
                <a href="{{ route('mapel.create') }}" class="btn btn-primary">Tambah Mapel</a>
            </div>
        </div>

        <table class="table-hover table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Mapel</th>
                    {{-- <th>Prodi</th> --}}
                    <th>Nama Dosen</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($queries as $mapel)
                    <tr>
                        <td>{{ $mapel->id }}</td>
                        <td>{{ $mapel->nama_mapel }}</td>
                        {{-- <td>{{ $mapel->prodi }}</td> --}}
                        <td>{{ $mapel->dosen->nama ?? 'Tidak ada dosen' }}</td>
                        <td>
                            <a href="{{ route('mapel.show', $mapel->id) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('mapel.edit', $mapel->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form class="d-inline" action="{{ route('mapel.destroy', [$mapel->id]) }}" method="POST"
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
