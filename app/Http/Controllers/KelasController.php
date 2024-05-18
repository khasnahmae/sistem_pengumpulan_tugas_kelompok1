<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Dosen;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Kelas::orderBy('id', 'asc')->paginate(5);
        return view('kelas.index', ['queries' => $query]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $list_dosen = Dosen::all(); // Ambil semua data dosen dari database
        return view('kelas.create', compact('list_dosen'));
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kelas' => 'required',
            'prodi' => 'required',
            'wali_kelas' => 'required|exists:dosens,id', // Pastikan wali kelas yang dipilih adalah ID yang valid dari tabel dosens
        ], [
            'kelas.required' => 'Kolom Kelas tidak boleh kosong',
            'prodi.required' => 'Kolom Prodi tidak boleh kosong',
            'wali_kelas.required' => 'Kolom Wali Kelas tidak boleh kosong',
            'wali_kelas.exists' => 'Wali kelas yang dipilih tidak valid',
        ]);

        // Simpan data kelas bersama dengan ID dosen sebagai wali kelas
        Kelas::create([
            'kelas' => $request->kelas, 
            'prodi' => $request->prodi,
            'wali_kelas' => $request->wali_kelas,
        ]);

        return redirect()
            ->route('kelas.index') 
            ->with('success', 'Data kelas sudah berhasil disimpan');
    }


    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('kelas.edit', compact('kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kelas' => 'required',
            'prodi' => 'required',
            'wali_kelas' => 'required|exists:dosens,id', // Pastikan wali kelas yang dipilih adalah ID yang valid dari tabel dosens
        ], [
            'kelas.required' => 'Kolom Kelas tidak boleh kosong',
            'prodi.required' => 'Kolom Prodi tidak boleh kosong',
            'wali_kelas.required' => 'Kolom Wali Kelas tidak boleh kosong',
            'wali_kelas.exists' => 'Wali kelas yang dipilih tidak valid',
        ]);

        // Cari data kelas yang akan diupdate
        $kelas = Kelas::findOrFail($id);

        // Update data kelas
        $kelas->update([
            'kelas' => $request->kelas, 
            'prodi' => $request->prodi,
            'wali_kelas' => $request->wali_kelas,
        ]);

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diperbarui');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('kelas.index')->with('success', 'Dosen berhasil dihapus');
    }

}
