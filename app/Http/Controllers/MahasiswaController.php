<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Pengumpulan;
use App\Models\Tugas;
use Illuminate\Support\Facades\Storage;

class MahasiswaController extends Controller
{
    public function index()
    {
        $query = Mahasiswa::orderBy('id', 'asc')->paginate(5);
        return view('mahasiswa.index', ['queries' => $query]);
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate(
            [
                'nim' => 'required',
                'nama' => 'required',
                'tgl_lahir' => 'required',
                'alamat' => 'required',
                'kontak' => 'required',
                'email' => 'required|email',
                'prodi' => 'required',
                'semester' => 'required',
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif,jfif,svg|max:10000',
            ],
            [
                'nim.required' => 'Kolom NIM tidak boleh kosong',
                'nama.required' => 'Kolom Nama tidak boleh kosong',
                'tgl_lahir.required' => 'Kolom Tanggal Lahir tidak boleh kosong',
                'alamat.required' => 'Kolom Alamat tidak boleh kosong',
                'kontak.required' => 'Kolom Kontak tidak boleh kosong',
                'email.required' => 'Kolom Email tidak boleh kosong',
                'email.email' => 'Format Email tidak valid',
                'prodi.required' => 'Kolom Program Studi tidak boleh kosong',
                'semester.required' => 'Kolom Semester tidak boleh kosong',
                'foto.required' => 'Silahkan pilih file foto',
                'foto.mimes' => 'Tipe File harus JPG/JPEG/PNG/GIF/SVG',
                'foto.max' => 'Ukuran file tidak boleh dari 10 MB',
            ]
        );
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = 'FTO' . date('Ymd') . rand() . '.' . $foto->getClientOriginalExtension();
            $foto->storeAs('public/mahasiswa/' . $filename);
        }
        Mahasiswa::create([
            'users_id' => auth()->user()->id,
            'nim' => $request->nim,
            'nama' => $request->nama,
            'tgl_lahir' => $request->tgl_lahir,
            'alamat' => $request->alamat,
            'kontak' => $request->kontak,
            'email' => $request->email,
            'prodi' => $request->prodi, // Ganti dengan atribut yang sesuai pada model Mahasiswa
            'semester' => $request->semester, // Ganti dengan atribut yang sesuai pada model Mahasiswa
            'foto' => $filename,
        ]);


        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.detail', compact('mahasiswa'));
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $request->validate(
            [
                'nim' => 'required',
                'nama' => 'required',
                'tgl_lahir' => 'required',
                'alamat' => 'required',
                'kontak' => 'required',
                'email' => 'required|email',
                'prodi' => 'required',
                'semester' => 'required',
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif,jfif,svg|max:10000',
            ],
            [
                'nim.required' => 'Kolom NIM tidak boleh kosong',
                'nama.required' => 'Kolom Nama tidak boleh kosong',
                'tgl_lahir.required' => 'Kolom Tanggal Lahir tidak boleh kosong',
                'alamat.required' => 'Kolom Alamat tidak boleh kosong',
                'kontak.required' => 'Kolom Kontak tidak boleh kosong',
                'email.required' => 'Kolom Email tidak boleh kosong',
                'email.email' => 'Format Email tidak valid',
                'prodi.required' => 'Kolom Program Studi tidak boleh kosong',
                'semester.required' => 'Kolom Semester tidak boleh kosong',
                'foto.required' => 'Silahkan pilih file foto',
                'foto.mimes' => 'Tipe File harus JPG/JPEG/PNG/GIF/SVG',
                'foto.max' => 'Ukuran file tidak boleh dari 10 MB',
            ]
        );

        if ($request->hasFile('foto')) {
            Storage::delete('public/mahasiswa/' . $mahasiswa->foto);
            $foto = $request->file('foto');
            $filename = 'FTO' . date('Ymd') . rand() . '.' . $foto->getClientOriginalExtension();
            $foto->storeAs('public/mahasiswa/' . $filename);

            $mahasiswa->update([
                'nim' => $request->nim,
                'nama' => $request->nama,
                'tgl_lahir' => $request->tgl_lahir,
                'alamat' => $request->alamat,
                'kontak' => $request->kontak,
                'email' => $request->email,
                'prodi' => $request->prodi, // Ganti dengan atribut yang sesuai pada model id
                'semester' => $request->semester, // Ganti dengan atribut yang sesuai pada model Mahasiswa
                'foto' => $filename,
            ]);
        } else {
            $id->update([
                'nim' => $request->nim,
                'nama' => $request->nama,
                'tgl_lahir' => $request->tgl_lahir,
                'alamat' => $request->alamat,
                'kontak' => $request->kontak,
                'email' => $request->email,
                'prodi' => $request->prodi,
                'semester' => $request->semester,
            ]);
        }

        return redirect()
            ->route('mahasiswa.index')
            ->with('success', 'Data Mahasiswa Berhasil diUpdate');
    }

    public function destroy($id)
    {

        $mahasiswa = Mahasiswa::findOrFail($id);
        // Hapus mahasiswa dari database
        $mahasiswa->delete();
        Storage::delete('public/mahasiswa/' . $mahasiswa->foto);

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus');
    }
    public function showProfil()
    {
        // Mengambil ID Dosen dari user yang sedang login
        $userId = auth()->user()->id;
        $mahasiswa = Mahasiswa::where('users_id', $userId)->first();

        return view('profilmhs', compact('mahasiswa'));
    }

    public function kumpulkanTugas(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'tugas_id' => 'required|exists:tugas,id',
            'link_tugas' => 'required|url',
            // tambahkan aturan validasi lainnya sesuai kebutuhan
        ]);

        // Simpan pengumpulan tugas
        $validatedData['mahasiswa_id'] = auth()->user()->mahasiswa->id;
        Pengumpulan::create($validatedData);

        return redirect()->route('mahasiswa.tugas')->with('success', 'Tugas berhasil dikumpulkan');
    }

    public function pengumpulan()
    {
        $pengumpulanTugas = Pengumpulan::where('mahasiswa_id', auth()->user()->mahasiswa->id)->get();
        return view('mahasiswa.pengumpulan_tugas', compact('pengumpulanTugas'));
    }
}
