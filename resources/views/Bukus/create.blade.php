@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Buku</h2>
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

  <form action="{{ route('bukus.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
  <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Pengarang</label>
            <input type="text" name="pengarang" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Penerbit</label>
            <input type="text" name="penerbit" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tahun Terbit</label>
            <input type="number" name="tahun_terbit" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label>Foto Buku (opsional)</label>
            <input type="file" name="foto_buku" class="form-control">
        </div>

        <div class="mb-3">
            <label>Jumlah Eksemplar</label>
            <input type="number" name="jumlah_eksemplar" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('bukus.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
