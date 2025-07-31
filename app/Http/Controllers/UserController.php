<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua user untuk ditampilkan di dashboard
        $users = User::all();
        return view('dashboard', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Pastikan admin tidak dapat menghapus dirinya sendiri
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.dashboard')->with('error', 'Tidak bisa menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', 'User berhasil dihapus.');
    }

     public function updateRole(Request $request, User $user)
    {
        // Validasi role baru
        $request->validate([
            'role' => 'required|in:admin,petugas,kepala,pengirim',
        ]);

        // Perbarui role user
        $user->update([
            'role' => $request->role,
        ]);

        return redirect()->route('dashboard')->with('success', 'Role user berhasil diperbarui.');
    }
}
