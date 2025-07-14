@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Kategori Buku</h2>
    <form action="{{ route('kategori.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama Kategori</label>
            <input type="text" name="nama_kategori" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <span class="">
        <a href="{{ route('kategori.index') }}" class="btn btn-danger">Kembali</a>
             </span>
    </form>
</div>

@endsection
 
            