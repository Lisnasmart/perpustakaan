<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
  public function index(Request $request)
{
    // Update otomatis status jika sudah lewat tanggal kembali
    $peminjamanList = Peminjaman::where('status', 'dipinjam')->get();

    foreach ($peminjamanList as $peminjaman) {
        $today = now()->toDateString();
        $tanggalKembali = \Carbon\Carbon::parse($peminjaman->tanggal_kembali)->toDateString();

        if ($today >= $tanggalKembali) {
            $dendaPerHari = 1000;
            $selisihHari = \Carbon\Carbon::parse($tanggalKembali)->diffInDays($today, false);
            $denda = $selisihHari > 0 ? $selisihHari * $dendaPerHari : 0;

            $peminjaman->update([
                'status' => 'dikembalikan',
                'tanggal_pengembalian' => $today,
                'denda' => $denda,
            ]);
            
        }
         
    }
    
    

    // Query pencarian
    $query = Peminjaman::with(['user', 'buku']);

    if ($request->filled('search')) {
        $search = $request->search;

        $query->whereHas('user', function ($q) use ($search) {
            $q->where('nama', 'like', '%' . $search . '%');
        })->orWhereHas('buku', function ($q) use ($search) {
            $q->where('judul', 'like', '%' . $search . '%');
        });
    }
    $data= $query->paginate(5);

    

    return view('peminjaman.index', compact('data'));
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
     public function kembalikan($id)
{
    $peminjaman = Peminjaman::findOrFail($id);

    if ($peminjaman->status !== 'dikembalikan') {
        $tanggalkembali = now();
        $peminjaman->tanggal_pengembalian = $tanggalkembali;
        $peminjaman->status = 'dikembalikan';

        // Hitung denda jika lewat tanggal wajib kembali
        $telat = $tanggalkembali->diffInDays($peminjaman->tanggal_kembali, false); // negatif kalau lewat
        $dendaPerHari = 1000; // Ubah sesuai kebijakan

        $peminjaman->denda = $telat > 0 ? 0 : abs($telat) * $dendaPerHari;

        $peminjaman->save();

        return redirect()->back()->with('success', 'Buku berhasil dikembalikan');

    }

    return redirect()->route('peminjaman.index')->with('warning', 'Peminjaman sudah dikembalikan sebelumnya.');
}

}
