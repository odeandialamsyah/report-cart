<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratKeluar;
use App\Models\SuratMasuk;

class VerifikasiSuratController extends Controller
{
    function index()
    {
        // Logika untuk menampilkan daftar surat yang perlu diverifikasi
        $suratKeluar = SuratKeluar::with('petugas')->latest()->get();
        $suratMasuk = SuratMasuk::with('pengirim')->latest()->get();
        return view('verifikasi.index', compact('suratKeluar', 'suratMasuk'));
    }
}
