@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Daftar Peminjaman</h3>
    <a href="{{ route('peminjaman.create') }}" class="btn btn-primary mb-3">Tambah Peminjaman</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Judul Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tanggal Kembali</th>
            <th>Tanggal Pengembalian</th>
            <th>Denda</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        @foreach($peminjaman as $p)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $p->user->nama }}</td>
            <td>{{ $p->buku->judul }}</td>
            <td>{{ $p->tanggal_pinjam }}</td>
            <td>{{ $p->tanggal_kembali ?? '-' }}</td>
            <td>{{ $p->tanggal_pengembalian  ?? '-' }}</td>
            <td>Rp {{ number_format($p->denda) }}</td>
            <td>{{ $p->status }}</td>
            <td>
                <a href="{{ route('peminjaman.edit', $p->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('peminjaman.destroy', $p->id) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection