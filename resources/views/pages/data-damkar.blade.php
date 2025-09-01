@extends('admin.dashboard')

@section('content')
<div class="card-body">

    {{-- Flash Message Sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Flash Message Error (opsional kalau mau ada) --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

<div class="container-fluid px-3">
    <div class="row align-items-center mb-3 g-2">
    {{-- Kolom Pencarian --}}
    <div class="col-md-4">
        <form method="GET" action="{{ route('pos-damkar.index') }}">
            <div class="input-group">
                <input name="search" value="{{ request('search') }}" class="form-control" 
                       type="search" placeholder="Cari Pos..." aria-label="Search">
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </div>

    {{-- Dropdown Filter Kecamatan --}}
    <div class="col-md-4">
        <form method="GET" action="{{ route('pos-damkar.index') }}">
            <div class="input-group">
                <select name="kecamatan" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Semua Kecamatan --</option>
                    @foreach($listKecamatan as $kec)
                        <option value="{{ $kec }}" {{ request('kecamatan') == $kec ? 'selected' : '' }}>
                            {{ $kec }}
                        </option>
                    @endforeach
                </select>
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-filter"></i>
                </button>
            </div>
        </form>
    </div>

    {{-- Tombol Export --}}
    <div class="col-md-2 d-flex gap-2">
        <a href="{{ route('damkar.export.excel') }}" class="btn btn-success flex-fill">
            <i class="fas fa-file-excel"></i> Excel
        </a>
        <a href="{{ route('damkar.export.pdf') }}" class="btn btn-danger flex-fill">
            <i class="fas fa-file-pdf"></i> PDF
        </a>
    </div>

    {{-- Tombol Tambah Data --}}
    <div class="col-md-2 text-end">
        <a href="{{ route('pos-damkar.create') }}" class="btn btn-primary w-100">
            <i class="fas fa-plus me-1"></i> Tambah
        </a>
    </div>
</div>

     <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Pos</th>
                    <th>Alamat</th>
                    <th>Kecamatan</th>
                    <th>Telepon</th>
                    <th style="width: 12%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($damkars as $index => $damkar)
                <tr>
                    <td>{{ $damkars->firstItem() + $index }}</td>
                    <td>{{ $damkar->nama_pos }}</td>
                    <td>{{ $damkar->alamat }}</td>
                    <td>{{ $damkar->kecamatan }}</td>
                    <td>{{ $damkar->telepon }}</td>
                    <td>
                        <a href="{{ route('pos-damkar.edit', $damkar->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('pos-damkar.destroy', $damkar->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data damkar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
     </div>

     

        {{-- Pagination --}}
        <div class="d-flex justify-content-end mt-3">
            <div class="pagination" style="margin-left: 10px;">
                {!! $damkars->appends(request()->query())->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
</div>
@endsection
