@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Laporan Peminjaman</h2>
   <form method="GET" action="{{ route('laporan.index') }}" class="row g-3 mb-3">
    <!-- <div class="col-auto">
        <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
        <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" value="{{ request('tanggal_awal') }}">
    </div>
    <div class="col-auto">
        <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
        <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" value="{{ request('tanggal_akhir') }}">
    </div> -->
    <div class="col-auto mt-4">
        <!-- <button type="submit" class="btn btn-primary">Search</button> -->
        <form method="GET" action="{{ route('laporan.cetak') }}" class="mt-2">
    <!-- <input type="hidden" name="tanggal_awal" value="{{ request('tanggal_awal') }}">
    <input type="hidden" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}"> -->
      <a href="{{ route('laporan.cetak') }}" class="btn btn-success">Cetak PDF</a>
</form>

    </div>
</form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Peminjam</th>
                <th>Judul Buku</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Tanggal Pengembalian</th>
                <th>Denda</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($peminjaman as $data)
            <tr>
                <td>{{ $data->user->nama}}</td>
                <td>{{ $data->buku->judul ?? '-' }}</td>
                <td>{{ $data->tanggal_pinjam }}</td>
                <td>{{ $data->tanggal_kembali }}</td>
                <td>{{ $data->tanggal_pengembalian ?? '-' }}</td>
                <td>Rp{{ number_format($data->denda ?? 0, 0, ',', '.') }}</td>
                <td>{{ $data->status }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">Belum ada data peminjaman</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
