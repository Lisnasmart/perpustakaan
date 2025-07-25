
@extends('layouts.app')
@section('title', 'Ubah Anggota')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kelola Anggota</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dasbor</a></li>
                        <li class="breadcrumb-item active">Ubah Anggota</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Ubah Anggota</h5>
                        <span class="float-right">
                            <a href="{{ route('anggota.index') }}" class="btn btn-danger">Kembali</a>
                        </span>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('anggota.update', $data->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">Nama Anggota</label>
                                        <input type="text" name="nama" value="{{ old('nama') ?? $data->nama }}"
                                            class="form-control @error('nama') is-invalid @enderror">
                                        @error('nama')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">NIS</label>
                                        <input type="text" name="nis" value="{{ old('nis') ?? $data->nis }}"
                                            class="form-control @error('nis') is-invalid @enderror">
                                        @error('nis')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">Kelas</label>
                                        <input type="text" name="kelas" value="{{ old('kelas') ?? $data->kelas }}"
                                            class="form-control @error('kelas') is-invalid @enderror">
                                        @error('kelas')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">Jenis Kelamin</label>
                                        <select class="form-control" name="jns_kelamin">
                                            <option value="" disabled>Pilih Jenis Kelamin</option>
                                            <option value="L" @if ($data->jns_kelamin == 'L') selected @endif>
                                                Laki-laki</option>
                                            <option value="P" @if ($data->jns_kelamin == 'P') selected @endif>
                                                Perempuan</option>
                                        </select>
                                        @error('nis')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="form-label">No HP</label>
                                        <input type="text" name="no_hp" value="{{ old('no_hp') ?? $data->no_hp }}"
                                            class="form-control @error('no_hp') is-invalid @enderror">
                                        @error('no_hp')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="" class="form-label">Foto</label>
                                        <input type="file" name="foto" value="{{ old('foto') }}"
                                            class="form-control @error('foto') is-invalid @enderror">
                                        @error('foto')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <img src="{{ asset('storage/' . $data->foto) }}" class="img-fluid" alt=""
                                        srcset="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
@endsection
