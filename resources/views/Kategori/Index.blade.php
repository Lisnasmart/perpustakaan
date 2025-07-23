@extends('layouts.app')
@section('title', 'Kelola Kategori Buku')

@section('content')

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-tags-fill me-2"></i>Kelola Kategori Buku</h5>
              <a href="{{ route('kategori.create') }}" class="btn btn-primary shadow-sm ">
                <i class="bi bi-plus-circle "></i> Tambah Kategori
            </a>
        </div>
           
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
 {{-- Form Search --}}
      <div class="row mb-3">
        <div class="col-md-9">
            <form id="searchForm" action="{{ route('kategori.index') }}" method="GET" class="d-flex" role="search">
                <input type="text" name="search" class="form-control me-2 shadow-sm"
                       placeholder="🔍 Cari Nama kategori..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="bi bi-search"></i> Cari
                </button>
                <a href="{{ route('kategori.index') }}" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-clockwise"></i> Reset
                </a>
            </form>
        </div>
</div>
           <div class="table-responsive shadow-sm ">
        <table class="table table-bordered table-striped align-middle ">
            <thead class="table-primary  text-center table-primary ">
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategori as $k)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $k->nama_kategori }}</td>
                            <td>
                                <a href="{{ route('kategori.edit', $k->id) }}" class="btn btn-warning btn-sm me-1">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('kategori.destroy', $k->id) }}" method="POST" style="display:inline-block;">
                                    @csrf @method('DELETE')
                                    <button onclick="return confirm('Yakin ingin menghapus kategori ini?')" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        @if ($kategori->isEmpty())
                        <tr>
                            <td colspan="3">Belum ada kategori.</td>
                        </tr>
                        @endif
                    </tbody>
                    
                </table>

 <div class="d-flex justify-content-center mt-3">
    {{ $kategori->links('pagination::bootstrap-4') }}
</div>

                       
            </div>
        </div>
         
       
    </div>
</div>
@endsection
