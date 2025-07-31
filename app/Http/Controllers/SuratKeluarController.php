<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratKeluar;
use Illuminate\Support\Facades\Storage;

class SuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $surat = SuratKeluar::with('petugas')->latest()->get();
        return view('surat_keluar.index', compact('surat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('surat_keluar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'tujuan' => 'required|string',
            'asal' => 'required|string',
            'nomor' => 'required|string',
            'perihal' => 'required|string',
            'file' => 'required|mimes:pdf,doc,docx|max:5120',
        ]);

        $filePath = $request->file('file')->store('surat_keluar', 'public');

        SuratKeluar::create([
            'tanggal' => $request->tanggal,
            'tujuan' => $request->tujuan,
            'asal' => $request->asal,
            'nomor' => $request->nomor,
            'perihal' => $request->perihal,
            'file' => $filePath,
            'petugas_id' => auth()->id(),  // Menyimpan ID petugas yang membuat surat
        ]);

        return redirect()->route('surat_keluar.index')->with('success', 'Surat keluar berhasil ditambahkan.');
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
        $surat = SuratKeluar::findOrFail($id);
        return view('surat_keluar.edit', compact('surat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $surat = SuratKeluar::findOrFail($id);
        $request->validate([
            'tanggal' => 'required|date',
            'tujuan' => 'required|string',
            'asal' => 'required|string',
            'nomor' => 'required|string',
            'perihal' => 'required|string',
            'file' => 'nullable|mimes:pdf,doc,docx|max:5120',
        ]);

        $data = $request->only(['tanggal', 'tujuan', 'asal', 'nomor', 'perihal']);

        if ($request->hasFile('file')) {
            // Hapus file lama
            Storage::disk('public')->delete($surat->file);
            // Simpan file baru
            $data['file'] = $request->file('file')->store('surat_keluar', 'public');
        }

        $surat->update($data);

        return redirect()->route('surat_keluar.index')->with('success', 'Surat keluar berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratKeluar $surat_keluar)
    {
        // Hapus file yang terkait dengan surat keluar
        Storage::disk('public')->delete($surat_keluar->file);
        $surat_keluar->delete();

        return redirect()->route('surat_keluar.index')->with('success', 'Surat keluar berhasil dihapus.');
    }

        /**
     * Preview the file of the specified resource.
     */
    public function preview($id)
    {
        $surat = SuratKeluar::findOrFail($id);
        $fileUrl = Storage::url($surat->file);
        return view('surat_keluar.preview', compact('fileUrl'));
    }

    public function updateStatus(Request $request, SuratKeluar $suratKeluar)
    {
        if (auth()->user()->role !== 'kepala' && auth()->user()->role !== 'admin') {
            return redirect()->route('surat_masuk.index')->with('error', 'Anda tidak memiliki hak untuk mengubah status surat.');
        }

        $request->validate([
            'status' => 'required|in:diajukan,disetujui,ditolak',
        ]);

        $suratKeluar->update([
            'status' => $request->status,
        ]);

        return redirect()->route('verifikasi.index')->with('success', 'Status surat telah diperbarui.');
    }

}
