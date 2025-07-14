@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Buku</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('bukus.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control" name="judul" value="{{ old('judul', $buku->judul) }}" required>
        </div>

        <div class="mb-3">
            <label for="pengarang" class="form-label">Pengarang</label>
            <input type="text" class="form-control" name="pengarang" value="{{ old('pengarang', $buku->pengarang) }}" required>
        </div>

        <div class="mb-3">
            <label for="penerbit" class="form-label">Penerbit</label>
            <input type="text" class="form-control" name="penerbit" value="{{ old('penerbit', $buku->penerbit) }}" required>
        </div>

        <div class="mb-3">
            <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
            <input type="number" class="form-control" name="tahun_terbit" value="{{ old('tahun_terbit', $buku->tahun_terbit) }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required>{{ old('deskripsi', $buku->deskripsi) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="foto_buku" class="form-label">Foto Buku</label><br>
            @if ($buku->foto_buku)
                <img src="{{ asset('storage/' . $buku->foto_buku) }}" alt="Foto Buku" width="100"><br><br>
            @endif
            <input type="file" name="foto_buku" class="form-control">
        </div>

        <div class="mb-3">
            <label for="jumlah_eksemplar" class="form-label">Jumlah Eksemplar</label>
            <input type="number" class="form-control" name="jumlah_eksemplar" value="{{ old('jumlah_eksemplar', $buku->jumlah_eksemplar) }}" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('bukus.index') }}" class="btn btn-danger">Batal</a>
    </form>
</div>
@endsection
