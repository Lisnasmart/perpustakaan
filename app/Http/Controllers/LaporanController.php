<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use  Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{


public function index()
{
    $peminjaman = Peminjaman::with('buku')->get(); // pastikan relasi 'buku' ada
    return view('laporan.index', compact('peminjaman'));
}



public function cetakPdf()
{
    $peminjaman = Peminjaman::all();

   $pdf = Pdf::loadView('laporan.peminjaman_pdf', compact('peminjaman'));
    return $pdf->download('laporan-peminjaman.pdf');
}



}
