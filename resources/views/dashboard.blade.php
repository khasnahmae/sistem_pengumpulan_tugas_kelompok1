@extends('layouts.app')

@section('content')
    @notifyCss
    <x-notify::notify />
    @notifyJs
    <div class="rounded-4 card mb-5 p-5">
        <div class="col text-center">
            <div class="row">
                <h3>👋 Hai !, {{ Auth::user()->name }}</h3>
            </div>
            <div class="row mb-4">
                <span>Apa yang ingin anda lakukan hari ini?</span>
            </div>
            @switch(auth()->user()->role)
                @case('admin')
                    <div class="row d-flex justify-content-center">
                        <a href="/akun" class="btn btn-primary btn-lg mb-2" style="width: 300px">Lihat Data Akun</a>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <a href="/mahasiswa" class="btn btn-primary btn-lg" style="width: 300px">Lihat Data Mahasiswa</a>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <a href="/dosen" class="btn btn-primary btn-lg mt-2" style="width: 300px">Lihat Data Dosen</a>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <a href="/kelas" class="btn btn-primary btn-lg mt-2" style="width: 300px">Lihat Data Kelas</a>
                    </div>
                @break

                @case('dosen')
                    <div class="row d-flex justify-content-center">
                        <a href="/datamhs" class="btn btn-primary btn-lg" style="width: 300px">Lihat Data Mahasiswa</a>
                    </div>
                    <div class="row d-flex justify-content-center">
                        <a href="/tugas" class="btn btn-primary btn-lg mt-2" style="width: 300px">Lihat Tugas</a>
                    </div>
                @break

                @case('mahasiswa')
                    <div class="row d-flex justify-content-center">
                        <a href="/tugasmhs" class="btn btn-primary btn-lg mt-2" style="width: 300px">Lihat Tugas</a>
                    </div>
                @break

                @default
            @endswitch
        </div>
    </div>
@endsection
