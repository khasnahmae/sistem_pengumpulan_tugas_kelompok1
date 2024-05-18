<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\PengumpulanController;
use App\Http\Controllers\TugasController;
use App\Http\Controllers\MapelController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'auth']);

Route::get('/beranda', function () {
    return view('dashboard');
});
Route::group(['middleware' => 'checkRole:admin'], function () {

    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
    Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
    Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
    Route::get('/mahasiswa/{id}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
    Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::get('/mahasiswa/{id}', [MahasiswaController::class, 'show'])->name('mahasiswa.detail');
    Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');

    Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.index');
    Route::get('/dosen/create', [DosenController::class, 'create'])->name('dosen.create');
    Route::post('/dosen', [DosenController::class, 'store'])->name('dosen.store');
    Route::get('/dosen/{id}/edit', [DosenController::class, 'edit'])->name('dosen.edit');
    Route::put('/dosen/{id}', [DosenController::class, 'update'])->name('dosen.update');
    Route::get('/dosen/{id}', [DosenController::class, 'show'])->name('dosen.show');
    Route::delete('/dosen/{id}', [DosenController::class, 'destroy'])->name('dosen.destroy');

    Route::get('/akun', [AuthController::class, 'index']);
    Route::get('/akun/create', [AuthController::class, 'create']);
    Route::get('/akun/detail/{id}', [AuthController::class, 'detail']);
    Route::get('/akun/edit/{id}', [AuthController::class, 'edit']);
    Route::post('/akun/store', [AuthController::class, 'store']);
    Route::post('/akun/update/{id}', [AuthController::class, 'akunUpdate']);
    Route::get('/akun/{id}', [AuthController::class, 'show'])->name('mahasiswa.show');
    Route::post('/akun/{id}', [AuthController::class, 'update']);
    Route::delete('/akun/destroy/{id}', [AuthController::class, 'destroy']);

    Route::get('/mapel', [MapelController::class, 'index'])->name('mapel.index');
    Route::get('/mapel/create', [MapelController::class, 'create'])->name('mapel.create');
    Route::post('/mapel', [MapelController::class, 'store'])->name('mapel.store');
    Route::get('/mapel/{id}/edit', [MapelController::class, 'edit'])->name('mapel.edit');
    Route::put('/mapel/{id}', [MapelController::class, 'update'])->name('mapel.update');
    Route::get('/mapel/{id}', [MapelController::class, 'show'])->name('mapel.show');
    Route::delete('/mapel/{id}', [MapelController::class, 'destroy'])->name('mapel.destroy');
});
Route::group(['middleware' => 'checkRole:dosen'], function () {

    Route::get('/tugas', [TugasController::class, 'index'])->name('tugas.index');
    Route::get('/tugas/create', [TugasController::class, 'create'])->name('tugas.create');
    Route::post('/tugas', [TugasController::class, 'store'])->name('tugas.store');
    Route::get('/tugas/{id}/edit', [TugasController::class, 'edit'])->name('tugas.edit');
    Route::post('/tugas/{id}/update', [TugasController::class, 'update']);
    Route::delete('/tugas/{id}', [TugasController::class, 'destroy'])->name('tugas.destroy');
    Route::get('/profildsn', [DosenController::class, 'showProfil'])->name('profildsn');
    Route::get('datamhs', [DosenController::class, 'showMahasiswa'])->name('datamhs');
    Route::get('/detailmhs/{id}', [DosenController::class, 'detail'])->name('detailmhs');
    Route::get('/tugas/pengumpulans', [PengumpulanController::class, 'indexDosen'])->name('pengumpulan.indexDosen');
    Route::get('/tugas/{id}/pengumpulanedit', [PengumpulanController::class, 'edit'])->name('pengumpulan.edit');
    Route::put('/tugas/pengumpulans/{id}', [PengumpulanController::class, 'update'])->name('pengumpulan.update');
});
Route::group(['middleware' => 'checkRole:mahasiswa'], function () {

    Route::get('/tugasmhs', [TugasController::class, 'detail'])->name('tugasmhs');
    Route::get('/profilmhs', [MahasiswaController::class, 'showProfil'])->name('profilmhs');
    Route::get('/pengumpulan', [PengumpulanController::class, 'index'])->name('pengumpulan.index');
    Route::get('/pengumpulantugas', [PengumpulanController::class, 'mhsindex'])->name('pengumpulan.index');
    Route::get('/pengumpulan/create', [PengumpulanController::class, 'create'])->name('pengumpulan.create');
});


// Pada file web.php



Route::get('/logout', [AuthController::class, 'logout']);
