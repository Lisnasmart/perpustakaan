@extends('layouts.app')
@section('title', 'Data Anggota')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 align-items-center">
            <div class="col-sm-6">
                <h3><i class="bi bi-people-fill me-2 text-primary"></i>Kelola Anggota</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dasbor</a></li>
                    <li class="breadcrumb-item active">Anggota</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    {{-- Pencarian dan Tambah --}}
     <div class="row mb-3">
        <div class="col-md-9">
            <form id="searchForm" action="{{ route('anggota.index') }}" method="GET" class="d-flex" role="search">
                <input type="text" name="search" class="form-control me-2 shadow-sm"
                       placeholder="🔍 Cari anggota..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="bi bi-search"></i> Cari
                </button>
                <a href="{{ route('anggota.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-clockwise"></i> Reset
                </a>
            </form>
        </div>
        <div class="col-md-3 text-end">
            <a href="{{ route('anggota.create') }}" class="btn btn-primary shadow-sm">
                <i class="bi bi-plus-circle"></i> Tambah Anggota
            </a>
        </div>
    </div>

    {{-- Data Tabel --}}
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Data Anggota</h5>
        </div>
        <div class="card-body">
            @include('components.alert')
           <div class="table-responsive shadow-sm ">
        <table class="table table-bordered table-striped align-middle ">
            <thead class="table-primary  text-center table-primary ">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIS</th>
                            <th>Kelas</th>
                            <th>L/P</th>
                            <th>No HP</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $anggota)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $anggota->nama }}</td>
                            <td>{{ $anggota->nis }}</td>
                            <td>{{ $anggota->kelas }}</td>
                            <td>{{ $anggota->jns_kelamin }}</td>
                            <td>{{ $anggota->no_hp }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $anggota->foto) }}" width="50" class="rounded" alt="foto">
                            </td>
                            <td>
                                <a href="{{ route('anggota.edit', $anggota->id) }}" class="btn btn-sm btn-warning me-1 mb-1">
                                    <i class="bi bi-pencil-square"></i> Ubah
                                </a>
                                <button type="button" data-href="{{ route('anggota.destroy', $anggota->id) }}" class="btn btn-sm btn-danger text-white btn-hapus mb-1">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">
                  {{ $data->links('pagination::bootstrap-4') }}
               </div>

            </div>
        </div>
    </div>

    {{-- Form Delete --}}
    <form action="" method="post" id="formDelete">
        @csrf
        @method('delete')
    </form>
</section>

{{-- Script Konfirmasi --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-2Pmvv7QzYfN2zRvy3xRVyRoE+GUdJ6bWllXzFg3z6vs=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('.btn-hapus').click(function() {
            const conf = confirm('Apakah yakin akan dihapus?');
            if (conf) {
                const url = $(this).data('href');
                $('#formDelete').attr('action', url);
                $('#formDelete').submit();
            }
        });
    });
</script>
@endsection
