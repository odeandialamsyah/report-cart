<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratMasuk;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class SuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $surat = SuratMasuk::with('pengirim')->latest()->get();
        return view('surat_masuk.index', compact('surat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('surat_masuk.create');
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

        $filePath = $request->file('file')->store('surat_masuk', 'public');

        SuratMasuk::create([
            'tanggal' => $request->tanggal,
            'tujuan' => $request->tujuan,
            'asal' => $request->asal,
            'nomor' => $request->nomor,
            'perihal' => $request->perihal,
            'file' => $filePath,
            'pengirim_id' => auth()->id(),
        ]);

        return redirect()->route('surat_masuk.index')->with('success', 'Surat masuk berhasil ditambahkan.');
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
        $surat = SuratMasuk::findOrFail($id);
        return view('surat_masuk.edit', compact('surat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $surat = SuratMasuk::findOrFail($id);
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
            $data['file'] = $request->file('file')->store('surat_masuk', 'public');
        }

        $surat->update($data);

        return redirect()->route('surat_masuk.index')->with('success', 'Surat masuk berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $surat_masuk = SuratMasuk::findOrFail($id);
        Storage::disk('public')->delete($surat_masuk->file);
        $surat_masuk->delete();

        return redirect()->route('surat_masuk.index')->with('success', 'Surat berhasil dihapus.');
    }

        /**
     * Preview the file of the specified resource.
     */
    public function preview($id)
    {
        $surat = SuratMasuk::findOrFail($id);
        $fileUrl = Storage::url($surat->file);
        return view('surat_masuk.preview', compact('fileUrl'));
    }

    public function updateStatus(Request $request, SuratMasuk $suratMasuk)
    {
        // Hanya Kepala yang bisa memverifikasi status
        if (auth()->user()->role !== 'kepala' && auth()->user()->role !== 'admin') {
            return redirect()->route('surat_masuk.index')->with('error', 'Anda tidak memiliki hak untuk mengubah status surat.');
        }

        $request->validate([
            'status' => 'required|in:diajukan,diverifikasi,didisposisi,selesai',
        ]);

        $suratMasuk->update([
            'status' => $request->status,
        ]);

        return redirect()->route('verifikasi.index')->with('success', 'Status surat telah diperbarui.');
    }

}
