<!-- resources/views/pengumpulan/index_dosen.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="rounded-4 card mb-5 p-5">
        <h2>Data Pengumpulan Tugas</h2>

        <!-- Tampilkan daftar pengumpulan untuk dosen -->
        <table class="table-hover table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mahasiswa</th>
                    {{-- <th>Matakuliah</th> --}}
                    <th>Tanggal Pengumpulan</th>
                    <th>Link Tugas</th>
                    <th>Nilai</th>
                    <th>Komentar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($query as $pengumpulan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pengumpulan->mahasiswa->nama }}</td>
                        {{-- <td>{{ $pengumpulan->tugas->matkul }}</td> --}}
                        <td>{{ $pengumpulan->tgl_pengumpulan }}</td>
                        <td>{{ $pengumpulan->link_tugas }}</td>
                        <td>{{ $pengumpulan->nilai }}</td>
                        <td>{{ $pengumpulan->komentar }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('tugasmhs') }}" class="btn btn-secondary mt-3">Kembali</a>
    </div>
@endsection
