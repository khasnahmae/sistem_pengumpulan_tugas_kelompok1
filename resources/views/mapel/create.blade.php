@extends('layouts.app')

@section('content')
    <div class="rounded-2 bg-light container mb-5 mt-5 p-5 shadow-lg">
        <h2>Tambah Mapel</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('mapel.store') }}" method="POST">
            @csrf
            <div class="form-group col-6">
                <label for="nama_mapel">Nama Mapel <span class="text-danger">*</span></label>
                <input type="text" name="nama_mapel" class="form-control @error('nama_mapel') is-invalid @enderror"
                    value="{{ old('nama_mapel') }}" placeholder="Nama Mapel" required>
            </div>
            <div class="form-group col-6">
                <label for="prodi">Prodi <span class="text-danger">*</span></label>
                <input type="text" name="prodi" class="form-control @error('prodi') is-invalid @enderror"
                    value="{{ old('prodi') }}" placeholder="Prodi" required>
            </div>
            <div class="d-flex justify-content-end mt-3">
                <button type="submit" class="btn btn-primary me-3">Simpan</button>
                <a href="{{ route('mapel.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>
@endsection
