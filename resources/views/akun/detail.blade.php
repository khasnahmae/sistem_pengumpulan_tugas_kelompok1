<!-- resources/views/user/detail.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="rounded-4 card mb-5 p-5">
        <h2>Detail Pengguna</h2>

        <div class="row">
            {{-- Informasi Dasar --}}
            <div class="col-auto">
                <div class="row">
                    <h4>{{ $akun->name }}</h4>
                    <p class="fw-bold">{{ $akun->username }}</p>
                </div>
                <p class="card-text">Email: {{ $akun->email }}</p>
                <p class="card-text">Role: {{ $akun->role }}</p>
            </div>
        </div>

        <a href="{{ url('akun') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
@endsection
