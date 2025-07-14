<?php

namespace App\Http\Controllers\Admin;

use App\Models\KategoriBuku;
use App\Models\Anggota;
use App\Models\buku;
use App\Models\Peminjaman;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{

    public function index()
    {

        $jumlahanggota = Anggota::count();
        $jumlahkategori = KategoriBuku::count();
        $jumlahbuku = Buku::count();
        $jumlahpeminjaman = Peminjaman::count();
        try {
            return view('pages.admin.dashboard', compact(
                'jumlahanggota',
                'jumlahkategori',
                'jumlahbuku',
                'jumlahpeminjaman'
            ));
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
