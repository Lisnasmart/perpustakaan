<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
   public function index()
{
    $bukus = Buku::all(); // Pastikan model "Buku" sesuai
    return view('bukus.index', compact('bukus'));
}


    public function create()
    {
        return view('bukus.create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'judul' => 'required',
        'pengarang' => 'required',
        'penerbit' => 'required',
        'tahun_terbit' => 'required|numeric',
        'deskripsi' => 'nullable',
        'foto_buku' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        'jumlah_eksemplar' => 'required|numeric'
    ]);

    $buku = new \App\Models\Buku;
    $buku->judul = $validated['judul'];
    $buku->pengarang = $validated['pengarang'];
    $buku->penerbit = $validated['penerbit'];
    $buku->tahun_terbit = $validated['tahun_terbit'];
    $buku->deskripsi = $validated['deskripsi'] ?? '';

    if ($request->hasFile('foto_buku')) {
        $path = $request->file('foto_buku')->store('foto_buku', 'public');
        $buku->foto_buku = $path;
    }

    $buku->jumlah_eksemplar = $validated['jumlah_eksemplar'];
    $buku->save();

    return redirect()->route('bukus.index')->with('success', 'Buku berhasil ditambahkan!');
}


    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        return view('bukus.edit', compact('buku'));
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|integer',
            'deskripsi' => 'nullable',
            'foto_buku' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'jumlah_eksemplar' => 'required|integer',
        ]);

        if ($request->hasFile('foto_buku')) {
            $validated['foto_buku'] = $request->file('foto_buku')->store('foto_buku', 'public');
        }

        $buku->update($validated);

        return redirect()->route('bukus.index')->with('success', 'Buku berhasil diupdate.');
    }

    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();
        return redirect()->route('bukus.index')->with('success', 'Buku berhasil dihapus.');
    }
}
