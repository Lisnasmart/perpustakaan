<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with('buku')->get();
        return view('peminjaman.index', compact('peminjaman'));
    }

  public function create()
{
    $buku = Buku::all();
    $users = user::where('peran', 'Anggota')->get(); // Ambil hanya anggota

    return view('peminjaman.create', compact('buku', 'users'));
}

    public function store(Request $request)
    {
   Peminjaman::create($request->all());
        return redirect()->route('peminjaman.index')->with('success', 'Data berhasil ditambahkan.');



      
    }

    public function edit(Peminjaman $peminjaman)
    {
        $buku = Buku::all();
        $user = user::where('peran', 'Anggota')->get();
        return view('peminjaman.edit', compact('user', 'peminjaman', 'buku'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'user_id' => 'required',
            'buku_id' => 'required',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date',
            'tanggal_pengembalian' => 'nullable|date',
            'denda' => 'nullable|integer',
            'status' => 'required'
        ]);

        $peminjaman->update($request->all());
        return redirect()->route('peminjaman.index')->with('success', 'Data berhasil diupdate.');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();
        return redirect()->route('peminjaman.index')->with('success', 'Data berhasil dihapus.');
    }
}
