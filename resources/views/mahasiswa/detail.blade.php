<!-- resources/views/mahasiswa/detail.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="rounded-4 card mb-5 p-5">
        <div class="bg-light rounded-2 container p-5 shadow-lg">
            <h2>Detail Mahasiswa</h2>

            <div class="row">
                @if ($mahasiswa->foto)
                    <img src="{{ asset('storage/mahasiswa/' . $mahasiswa->foto) }}" style="width:250px"
                        class="rounded-3 col-auto" />
                @endif
                {{-- Informasi Dasar --}}
                <div class="col-auto">
                    <div class="row">
                        <h4>{{ $mahasiswa->nama }}</h4>
                        <p class="fw-bold">{{ $mahasiswa->nim }}</p>
                    </div>
                    <p class="card-text">Tanggal Lahir: {{ $mahasiswa->tgl_lahir }}</p>
                    <p class="card-text">Alamat: {{ $mahasiswa->alamat }}</p>
                    <p class="card-text">Kontak: {{ $mahasiswa->kontak }}</p>
                    <p class="card-text">Email: {{ $mahasiswa->email }}</p>
                    <p class="card-text">Program Studi: {{ $mahasiswa->prodi }}</p>
                    <p class="card-text">Semester: {{ $mahasiswa->semester }}</p>
                </div>
            </div>
            <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary mt-3">Kembali</a>
        </div>
    @endsection
