@extends('layouts.app')

@section('content')
    <div class="rounded-4 card mb-5 p-5">
        <h2>Detail Mapel</h2>

        <div class="row">
            {{-- Informasi Dasar --}}
            <div class="col-auto">
                <div class="row">
                    <h4>{{ $mapel->nama_mapel }}</h4>
                </div>
                <p class="card-text">ID: {{ $mapel->id }}</p>
                <p class="card-text">Prodi: {{ $mapel->prodi }}</p>
            </div>
        </div>
        <a href="{{ route('mapel.index') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
@endsection
