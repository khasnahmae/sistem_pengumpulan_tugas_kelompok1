<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Pengumpulan;
use App\Models\Tugas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DosenController extends Controller
{
    public function index()
    {
        $query = Dosen::orderBy('id', 'asc')->paginate(5);
        return view('dosen.index', ['queries' => $query]);
    }

    public function create()
    {
        return view('dosen.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nip' => 'required|integer', // Changed from telepon to nip
                'nama' => 'required',
                'codename' => 'required',
                'tgl_lahir' => 'required|date',
                'alamat' => 'required',
                'kontak' => 'required',
                'email' => 'required|email',
                'keilmuan' => 'required',
                'foto' => 'required|image|mimes:jpeg,png,jpg,jfif,gif,svg|max:10000',
            ],
            [
                'nip.required' => 'Kolom NIP tidak boleh kosong',
                'nip.integer' => 'NIP harus berupa angka',
                'codename' => 'Kode Dosen tidak boleh kosong',
                'nama.required' => 'Kolom Nama tidak boleh kosong',
                'tgl_lahir.required' => 'Kolom Tanggal Lahir tidak boleh kosong',
                'alamat.required' => 'Kolom Alamat tidak boleh kosong',
                'kontak.required' => 'Kolom Kontak tidak boleh kosong',
                'email.required' => 'Kolom Email tidak boleh kosong',
                'email.email' => 'Format Email tidak valid',
                'keilmuan.required' => 'Kolom Dosen Mata Kuliah tidak boleh kosong',
                'foto.required' => 'Silahkan pilih file foto',
                'foto.mimes' => 'Tipe File harus JPG/JPEG/PNG/GIF/SVG',
                'foto.max' => 'Ukuran file tidak boleh dari 10 MB',
            ],
        );

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = 'FT' . date('Ymd') . rand() . '.' . $foto->getClientOriginalExtension();
            $foto->storeAs('public/dosen/' . $filename);
        }

        Dosen::create([
            'nip' => $request->nip, // Changed from telepon to nip
            'nama' => $request->nama,
            'codename' => $request->codename,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
            'kontak' => $request->kontak,
            'email' => $request->email,
            'keilmuan' => $request->keilmuan,
            'foto' => $filename,
        ]);

        return redirect()
            ->route('dosen.index') // Changed from employee.index to dosen.index
            ->with('success', 'Data Dosen sudah berhasil disimpan');
   }

    public function show($id)
    {
        $dosen = Dosen::findOrFail($id);
        return view('dosen.detail', compact('dosen'));
    }

    public function edit($id)
    {
        $dosen = Dosen::findOrFail($id);
        return view('dosen.edit', compact('dosen'));
    }

    public function update(Request $request, $id)
    {
        $dosen = Dosen::find($id);
        $request->validate([
            'nip' => 'required',
            'nama' => 'required',
            'codename' => 'required',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required',
            'kontak' => 'required',
            'email' => 'required|email',
            'keilmuan' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,jfif,gif|max:10000',
        ],
        [
            'nip.required' => 'Kolom NIP tidak boleh kosong',
            'nama.required' => 'Kolom Nama tidak boleh kosong',
            'codename.required' => 'Kode Dosen tidak boleh kosong',
            'tgl_lahir.required' => 'Kolom Tanggal Lahir tidak boleh kosong',
            'alamat.required' => 'Kolom Alamat tidak boleh kosong',
            'kontak.required' => 'Kolom Kontak tidak boleh kosong',
            'email.required' => 'Kolom Email tidak boleh kosong',
            'email.email' => 'Format Email tidak valid',
            'keilmuan.required' => 'Kolom Dosen Mata Kuliah tidak boleh kosong',
            'foto.required' => 'Silahkan pilih file foto',
            'foto.mimes' => 'Tipe File harus JPG/JPEG/PNG/GIF/SVG',
            'foto.max' => 'Ukuran file tidak boleh dari 10 MB',
        ]
    );

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            Storage::delete('public/dosen/' . $dosen->foto);
            $foto = $request->file('foto');
            $filename = 'FT' . date('Ymd') . rand() . '.' . $foto->getClientOriginalExtension();
            $foto->storeAs('public/dosen/' . $filename);
            $oldFilePath = 'storage/dosen/' . $dosen->foto;
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }


        // Perbarui data
            $dosen->update([
                'nip' => $request->nip,
                'nama' => $request->nama,
                'codename' => $request->codename,
                'tgl_lahir' => $request->tgl_lahir,
                'alamat' => $request->alamat,
                'kontak' => $request->kontak,
                'email' => $request->email,
                'keilmuan' => $request->keilmuan,
                'foto' => $filename,
            ]);
        } else {
            $id->update([
                'nip' => $request->nip,
                'nama' => $request->nama,
                'codename' => $request->codename,
                'tgl_lahir' => $request->tgl_lahir,
                'alamat' => $request->alamat,
                'kontak' => $request->kontak,
                'email' => $request->email,
                'keilmuan' => $request->keilmuan,
            ]);
        }

        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil diperbarui');
    }

    public function destroy($id)
    {
        $dosen = Dosen::findOrFail($id);
        $dosen->delete();
        Storage::delete('public/dosen/' . $dosen->foto);

        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil dihapus');
    }

    public function tugas($id)
    {
        $dosen = Dosen::findOrFail($id);
        $tugas = Tugas::where('dosen_id', $id)->get();
        return view('dosen.tugas', compact('dosen', 'tugas'));
    }

    public function pengumpulanTugas()
    {
        $user = Auth::user();
        $tugasDiajar = $user->dosen->tugas;

        $pengumpulan = Pengumpulan::whereIn('id_tugass', $tugasDiajar->pluck('id'))->get();

        return view('dosen.pengumpulan_tugas', compact('pengumpulan'));

        // $pengumpulan = Pengumpulan::where('tugas_id', $idTugas)->get();
        // return view('dosen.pengumpulan_tugas', compact('pengumpulanTugas'));
    }

    // Tambahkan metode lain sesuai kebutuhan
    public function showMahasiswa()
    {
        $query = Mahasiswa::all();
        return view('datamhs', compact('query'));
    }
    public function detail($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('detailmhs', compact('mahasiswa'));
    }
    public function showProfil()
    {
    // Mengambil ID Dosen dari user yang sedang login
    $userId = auth()->user()->id;
    $dosen = Dosen::where('users_id', $userId)->first();

    return view('profildsn', compact('dosen'));
    }

}
