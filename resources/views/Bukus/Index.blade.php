@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 text-primary">
        <i class="bi bi-journal-bookmark-fill me-2"></i>Daftar Buku
    </h3>

    {{-- Form Pencarian --}}
    <div class="row mb-3">
        <div class="col-md-9">
            <form id="searchForm" action="{{ route('bukus.index') }}" method="GET" class="d-flex" role="search">
                <input type="text" name="search" class="form-control me-2 shadow-sm"
                       placeholder="🔍 Cari judul buku..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="bi bi-search"></i> Cari
                </button>
                <a href="{{ route('bukus.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-clockwise"></i> Reset
                </a>
            </form>
        </div>
        <div class="col-md-3 text-end">
            <a href="{{ route('bukus.create') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-circle"></i> Tambah Buku
            </a>
        </div>
    </div>

    {{-- Tabel Buku --}}
   <div class="table-responsive shadow-sm ">
        <table class="table table-bordered table-striped align-middle ">
            <thead class="table-primary  text-center table-primary ">
                <tr>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    <th>Deskripsi</th>
                    <th>Foto</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bukus as $buku)
                    <tr>
                        <td>{{ $buku->judul }}</td>
                        <td>{{ $buku->pengarang }}</td>
                        <td>{{ $buku->penerbit }}</td>
                        <td>{{ $buku->tahun_terbit }}</td>
                        <td>{{ $buku->deskripsi }}</td>
                        <td>
                            @if ($buku->foto_buku)
                                <img src="{{ asset('storage/' . $buku->foto_buku) }}" width="80" class="rounded shadow-sm" alt="foto buku">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="text-center">{{ $buku->jumlah_eksemplar }}</td>
                        <td>
                            <div class="d-flex">
                                <a href="{{ route('bukus.edit', $buku->id) }}" class="btn btn-sm btn-outline-primary me-2">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('bukus.destroy', $buku->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash3-fill"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">Belum ada data buku.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
         <div class="d-flex justify-content-center mt-3">
    {{ $bukus->links('pagination::bootstrap-4') }}
</div>
    </div>
</div>
@endsection
