@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Mapel</h2>
        <form action="{{ route('mapel.update', $mapel->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama_mapel">Nama Mapel:</label>
                <input type="text" class="form-control" id="nama_mapel" name="nama_mapel"
                    value="{{ $mapel->nama_mapel }}" required>
            </div>
            <div class="form-group">
                <label for="prodi">Prodi:</label>
                <input type="text" class="form-control" id="prodi" name="prodi" value="{{ $mapel->prodi }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('mapel.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection
