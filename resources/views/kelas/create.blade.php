@extends('layouts.app')
@section('title', 'Dosen')

@section('content')
    <div class="rounded-2 bg-light container mb-5 mt-5 p-5 shadow-lg">
        <div class="d-flex justify-content-between">
            <div class="">
                <h2 class="text-dark m-0">Tambah Data Dosen</h2>
            </div>
        </div>
        <br>
        {{-- z --}}
        <form action="{{ route('kelas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <p><b>Kolom bertanda <span class="text-danger">*</span> tidak boleh
                    kosong</b></p>
            <div class="row">
                <div class="col px-4">
                    <div class="row py-2">
                        <label for="">Kelas <span class="text-danger">*</span></label>
                        <input type="text" name="kelas"
                            class="form-control @if ($errors->has('kelas')) is-invalid @endif"
                            placeholder="Masukkan Kelas" value="{{ old('kelas') }}">
                        @if ($errors->has('kelas'))
                            <small class="text-danger">
                                {{ $errors->first('kelas') }}
                            </small>
                        @endif
                    </div>
                    <div class="row py-2">
                        <label for="">Prodi <span class="text-danger">*</span></label>
                        <input type="text" name="prodi"
                            class="form-control @if ($errors->has('prodi')) is-invalid @endif"
                            placeholder="Masukkan Prodi" value="{{ old('prodi') }}">
                        @if ($errors->has('prodi'))
                            <small class="text-danger">
                                {{ $errors->first('prodi') }}
                            </small>
                        @endif
                    </div>
                    <div class="row py-2">
                        <label for="">Wali Kelas <span class="text-danger">*</span></label>
                        <select name="wali_kelas" class="form-control @if ($errors->has('wali_kelas')) is-invalid @endif">
                            <option value="">Pilih Wali Kelas</option>
                            @foreach($list_dosen as $dosen)
                                <option value="{{ $dosen->id }}" @if(old('wali_kelas') == $dosen->id) selected @endif>{{ $dosen->nama }}</option>
                            @endforeach
                        </select>
                        
                        @if ($errors->has('wali_kelas'))
                            <small class="text-danger">
                                {{ $errors->first('wali_kelas') }}
                            </small>
                        @endif
                    </div>
                    
            <div class="card-footer">
                <div class="my-2">
                    <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Simpan Data</button>
                    <a href="{{ route('kelas.index') }}" class="btn btn-danger"><i class="fa fa-arrow-left"></i>
                        Kembali</a>
                </div>
            </div>
        </form>
    </div>
@endsection
