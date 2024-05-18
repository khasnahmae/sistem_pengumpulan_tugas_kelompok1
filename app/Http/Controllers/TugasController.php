<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Tugas;
use App\Models\Pengumpulan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;

class TugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Tugas::orderBy('id', 'asc')->paginate(5);
        return view('tugas.index', ['queries' => $query]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tugas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->file('file_tugas')->getMimeType());

        $request->validate([
            'matkul' => 'required',
            'semester' => 'required',
            'pertemuan' => 'required',
            'tgl_buat' => 'required',
            'tgl_dl' => 'required',
            'file_tugas' => 'required|mimes:pdf|max:10000',

        ], [
            'matkul.required' => 'Kolom Mata Kuliah tidak boleh kosong',
            'semester.required' => 'Kolom Semester tidak boleh kosong',
            'pertemuan.required' => 'Kolom Pertemuan tidak boleh kosong',
            'tgl_buat.required' => 'Kolom Tanggal Pembuatan tidak boleh kosong',
            'tgl_dl.required' => 'Kolom Tanggal Deadline tidak boleh kosong',
            'file_tugas.required' => 'Silahkan Pilih File Tugas',
            'file_tugas.mimes' => 'Tipe File harus PDF',
            'file_tugas.max' => 'Ukuran file tidak boleh dari 10 MB',
        ]);

        if ($request->hasFile('file_tugas')) {
            try {
                // Simpan file
                $fileTugas = $request->file('file_tugas');
                $newName = 'FT' . date('Ymd') . '.' . rand() . '.' . $fileTugas->getClientOriginalExtension();

                // Simpan ke penyimpanan yang diinginkan (misal: storage/public/filetugas/)
                $fileTugas->storeAs('public/filetugas/', $newName);

                // Dapatkan ID Dosen berdasarkan user yang sedang login
                $users_id = auth()->user()->id;
                $id_dosens = Dosen::where('users_id', $users_id)->first();
                $id = $id_dosens->id;

                // Simpan data tugas
                Tugas::create([
                    'id_dosens' => $id,
                    'matkul' => $request->matkul,
                    'semester' => $request->semester,
                    'pertemuan' => $request->pertemuan,
                    'tgl_buat' => $request->tgl_buat,
                    'tgl_dl' => $request->tgl_dl,
                    'file_tugas' => $newName,
                ]);

                return redirect()
                    ->route('tugas.index')
                    ->with('success', 'Data Tugas sudah berhasil disimpan');
            } catch (\Exception $e) {
                // Tangani kesalahan saat menyimpan file
                return redirect()
                    ->route('tugas.create')
                    ->withErrors(['file_tugas' => 'Gagal menyimpan file. Pastikan tipe file adalah PDF dan ukurannya tidak melebihi 10 MB.'])
                    ->withInput();
            }
        } else {
            return redirect()
                ->back()
                ->withErrors(['file_tugas' => 'File Tugas tidak ditemukan.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tugas = Tugas::findOrFail($id);
        return view('tugas.edit', compact('tugas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tugas = Tugas::find($id);
        $request->validate([
            'matkul' => 'required',
            'semester' => 'required',
            'pertemuan' => 'required',
            'tgl_buat' => 'required',
            'tgl_dl' => 'required',
            'file_tugas' => 'mimes:pdf|max:10000',
        ],
        [
            'matkul.required' => 'Kolom Mata Kuliah tidak boleh kosong',
            'semester.required' => 'Kolom Semester tidak boleh kosong',
            'pertemuan.required' => 'Kolom Pertemuan tidak boleh kosong',
            'tgl_buat.required' => 'Kolom Tanggal Pembuatan tidak boleh kosong',
            'tgl_dl.required' => 'Kolom Tanggal Deadline tidak boleh kosong',
            'file_tugas.mimes' => 'Tipe File harus PDF',
            'file_tugas.max' => 'Ukuran file tidak boleh dari 10 MB',
        ]);

        // Upload foto jika ada
        if ($request->hasFile('file_tugas')) {
            Storage::delete('storage/filetugas/' . $tugas->file_tugas);
            $file_tugas = $request->file('file_tugas');
            $filename = 'FT' . date('Ymd') . rand() . '.' . $file_tugas->getClientOriginalExtension();
            $file_tugas->storeAs('public/filetugas/' . $filename);
            $oldFilePath = 'storage/filetugas/' . $tugas->file_tugas;
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }


        // Perbarui data
            $tugas->update([
                'matkul' => $request->matkul,
                'semester' => $request->semester,
                'pertemuan' => $request->pertemuan,
                'tgl_buat' => $request->tgl_buat,
                'tgl_dl' => $request->tgl_dl,
                'file_tugas' => $filename,
            ]);
        } else {
            $id->update([
                'matkul' => $request->matkul,
                'semester' => $request->semester,
                'pertemuan' => $request->pertemuan,
                'tgl_buat' => $request->tgl_buat,
                'tgl_dl' => $request->tgl_dl,
            ]);
        }

        return redirect()
            ->route('tugas.index')
            ->with('success', 'Data Tugas Berhasil diUpdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tugas = Tugas::findOrFail($id);

        $pengumpulan = Pengumpulan::where('id_tugass', $id)->delete();

        $tugas->delete();
        Storage::delete('public/filetugas/' . $tugas->file_tugas);
        return redirect()
            ->route('tugas.index')
            ->with('success', 'Data Tugas berhasil dihapus');
    }
    public function detail()
    {
        $query = Tugas::orderBy('id', 'asc')->paginate(5);
        return view('tugasmhs', ['queries' => $query]);
        $isMahasiswa = auth()->user()->role == 'mahasiswa';

    }

    public function exportpdf()
    {
        $query = Tugas::all();

        $pdf = PDF::loadView('tugas.tugas_pdf', ['query' => $query]);
        return $pdf->download('file-tugas.pdf');
    }

}
