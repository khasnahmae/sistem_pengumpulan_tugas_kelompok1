@extends('layouts.app')

@section('content')
    <div class="rounded-4 card mb-5 p-5">
        <h2>Edit Tugas</h2>
        @if (auth()->user()->role == 'dosen')
            <form action="/tugas/{{ $tugas->id }}/update" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="matkul">Mata Kuliah:</label>
                    <input type="text" class="form-control" id="matkul" name="matkul" value="{{ $tugas->matkul }}"
                        required>
                </div>
                <div class="form-group">
                    <label for="semester">Semester:</label>
                    <input type="text" class="form-control" id="semester" name="semester" value="{{ $tugas->semester }}"
                        required>
                </div>
                <div class="form-group">
                    <label for="pertemuan">Pertemuan:</label>
                    <input type="text" class="form-control" id="pertemuan" name="pertemuan"
                        value="{{ $tugas->pertemuan }}" required>
                </div>
                <div class="form-group">
                    <label for="tgl_buat">Tanggal Pembuatan:</label>
                    <input type="date" class="form-control" id="tgl_buat" name="tgl_buat" value="{{ $tugas->tgl_buat }}"
                        required>
                </div>
                <div class="form-group">
                    <label for="tgl_dl">Tanggal Deadline:</label>
                    <input type="date" class="form-control" id="tgl_dl" name="tgl_dl" value="{{ $tugas->tgl_dl }}"
                        required>
                </div>
                <div class="form-group col-6">
                    <label for="file_tugas">File Tugas <span class="text-danger">*</span></label>
                    <input type="file" name="file_tugas"
                        class="form-control-file @error('file_tugas') is-invalid @enderror" placeholder="Pilih File"
                        value="{{ old('file_tugas') }}">
                    <small>Tipe File: Pdf. Max: 10 MB.</small>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('tugas.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        @endif
        @if (auth()->user()->role == 'mahasiswa')
            <form action="/tugas/{id}/pengumpulan" method="POST">
                @csrf
                <div class="form-group">
                    <label for="link_tugas">Link Tugas:</label>
                    <input type="text" class="form-control" id="link_tugas" name="link_tugas"
                        value="{{ old('link_tugas') }}">
                </div>
                <div class="form-group">
                    <label for="tgl_pengumpulan">Tanggal Pengumpulan:</label>
                    <input type="date" class="form-control" id="tgl_pengumpulan" name="tgl_pengumpulan"
                        value="{{ old('tgl_pengumpulan') }}">
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('tugas.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        @else
        @endif
    </div>
@endsection
