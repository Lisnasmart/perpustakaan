@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center mt-4">
    <div class="col-lg-10 col-md-11 col-sm-12">

        {{-- Judul dengan Icon --}}
        <h3 class="mb-4 text-primary text-align">
            <i class="bi bi-journal-text me-2"></i> Laporan Peminjaman
        </h3>

        {{-- Tombol Cetak PDF --}}
        <div class="mb-3 text-align">
            <a href="{{ route('laporan.cetak') }}" class="btn btn-success shadow-sm">
                <i class="bi bi-printer-fill me-1"></i> Cetak PDF
            </a>
        </div>

        {{-- Tabel --}}
    
           <div class="table-responsive shadow-sm ">
            
        <table class="table table-bordered table-striped align-middle ">
            <thead class="table-primary  text-center table-primary ">
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
                            <td>{{ $data->user->nama }}</td>
                            <td>{{ $data->buku->judul ?? '-' }}</td>
                            <td>{{ $data->tanggal_pinjam }}</td>
                            <td>{{ $data->tanggal_kembali }}</td>
                            <td>{{ $data->tanggal_pengembalian ?? '-' }}</td>
                            <td>Rp{{ number_format($data->denda ?? 0, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge bg-{{ $data->status == 'dipinjam' ? 'warning' : 'success' }}">
                                    {{ ucfirst($data->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">Belum ada data peminjaman</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
