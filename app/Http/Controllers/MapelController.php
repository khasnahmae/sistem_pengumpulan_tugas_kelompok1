<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;

class MapelController extends Controller
{
    public function index()
    {
        $query = Mapel::orderBy('id', 'asc')->paginate(5);
        return view('mapel.index', ['queries' => $query]);
    }

    public function create()
    {
        return view('mapel.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mapel' => 'required',
            'prodi' => 'required',
        ], [
            'nama_mapel.required' => 'Kolom Nama Mapel tidak boleh kosong',
            'prodi.required' => 'Kolom Prodi tidak boleh kosong',
        ]);

        Mapel::create([
            'nama_mapel' => $request->nama_mapel,
            'prodi' => $request->prodi,
        ]);

        return redirect()
            ->route('mapel.index')
            ->with('success', 'Data Mapel berhasil disimpan');
    }

    public function edit($id)
    {
        $mapel = Mapel::findOrFail($id);
        return view('mapel.edit', compact('mapel'));
    }

    public function update(Request $request, $id)
    {
        $mapel = Mapel::find($id);
        $request->validate([
            'nama_mapel' => 'required',
            'prodi' => 'required',
        ],
        [
            'nama_mapel.required' => 'Kolom Nama Mapel tidak boleh kosong',
            'prodi.required' => 'Kolom Prodi tidak boleh kosong',
        ]);

        $mapel->update([
            'nama_mapel' => $request->nama_mapel,
            'prodi' => $request->prodi,
        ]);

        return redirect()
            ->route('mapel.index')
            ->with('success', 'Data Mapel berhasil diupdate');
    }

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
