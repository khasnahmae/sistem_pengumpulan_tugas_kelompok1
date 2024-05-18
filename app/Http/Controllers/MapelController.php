<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Mapel::orderBy('id', 'asc')->paginate(5);
        return view('mapel.index', ['queries' => $query]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dosens = Dosen::all(); // Ambil semua data dosen
        return view('mapel.create', compact('dosens')); // Kirim data ke view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_mapel' => 'required',
            'prodi' => 'required',
            'id_dosens' => 'required|exists:dosens,id', // Validasi untuk id_dosens
        ], [
            'nama_mapel.required' => 'Kolom Nama Mapel tidak boleh kosong',
            'prodi.required' => 'Kolom Prodi tidak boleh kosong',
            'id_dosens.required' => 'Kolom Dosen tidak boleh kosong',
            'id_dosens.exists' => 'Dosen yang dipilih tidak valid',
        ]);

        Mapel::create([
            'nama_mapel' => $request->nama_mapel,
            'prodi' => $request->prodi,
            'id_dosens' => $request->id_dosens, // Simpan id_dosens
        ]);

        return redirect()
            ->route('mapel.index')
            ->with('success', 'Data Mapel berhasil disimpan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mapel = Mapel::findOrFail($id);
        $dosens = Dosen::all(); // Ambil semua data dosen
        return view('mapel.edit', compact('mapel', 'dosens'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $mapel = Mapel::find($id);
        $request->validate([
            'nama_mapel' => 'required',
            'prodi' => 'required',
            'id_dosens' => 'required|exists:dosens,id', // Validasi untuk id_dosens
        ], [
            'nama_mapel.required' => 'Kolom Nama Mapel tidak boleh kosong',
            'prodi.required' => 'Kolom Prodi tidak boleh kosong',
            'id_dosens.required' => 'Kolom Dosen tidak boleh kosong',
            'id_dosens.exists' => 'Dosen yang dipilih tidak valid',
        ]);

        $mapel->update([
            'nama_mapel' => $request->nama_mapel,
            'prodi' => $request->prodi,
            'id_dosens' => $request->id_dosens, // Simpan id_dosens
        ]);

        return redirect()
            ->route('mapel.index')
            ->with('success', 'Data Mapel berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mapel = Mapel::findOrFail($id);
        $mapel->delete();
        return redirect()
            ->route('mapel.index')
            ->with('success', 'Data Mapel berhasil dihapus');
    }

    public function detail()
    {
        $query = Mapel::orderBy('id', 'asc')->paginate(5);
        return view('mapel.detail', ['queries' => $query]);
    }
}
