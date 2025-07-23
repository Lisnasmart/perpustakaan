@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 text-primary">
        <a class="mb-4">📚 Daftar Peminjaman</a>
    </h3>

    {{-- Form Search --}}
    <div class="row mb-3">
        <div class="col-md-9">
            <form id="searchForm" action="{{ route('peminjaman.index') }}" method="GET" class="d-flex" role="search">
                <input type="text" name="search" class="form-control me-2 shadow-sm"
                       placeholder="🔍 Cari Nama Peminjam..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="bi bi-search"></i> Cari
                </button>
                <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-clockwise"></i> Reset
                </a>
            </form>
        </div>
        <div class="col-md-3 text-end">
            <a href="{{ route('peminjaman.create') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-circle"></i> Tambah Peminjam
            </a>
        </div>
    </div>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Tabel Data --}}
    <div class="table-responsive shadow-sm">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-primary text-center">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Judul Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Pengembalian</th>
                    <th>Denda</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
    @forelse($data as $p)
        <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>{{ $p->user->nama }}</td>
            <td>{{ $p->buku->judul }}</td>
            <td>{{ $p->tanggal_pinjam }}</td>
            <td>{{ $p->tanggal_kembali ?? '-' }}</td>
            <td>{{ $p->tanggal_pengembalian ?? '-' }}</td>
            <td>Rp {{ number_format($p->denda ?? 0) }}</td>
            <td class="text-center">
                <span class="badge bg-{{ $p->status === 'dipinjam' ? 'warning text-dark' : 'success' }}">
                    {{ ucfirst($p->status) }}
                </span>
            </td>
            <td class="text-center">
                @if ($p->status === 'dipinjam')
                    <form action="{{ route('peminjaman.kembalikan', $p->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm mb-1">
                            <i class="bi bi-arrow-90deg-left"></i> Kembalikan
                        </button>
                    </form>
                @else
                    <span class="badge bg-secondary mb-1">Sudah Dikembalikan</span>
                @endif

                <form action="{{ route('peminjaman.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="bi bi-trash3"></i> Hapus
                    </button>
                </form>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="9" class="text-center text-muted">Belum ada data peminjaman.</td>
        </tr>
    @endforelse
</tbody>

        </table>

        <div class="d-flex justify-content-center mt-3">
            {{ $data->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection
