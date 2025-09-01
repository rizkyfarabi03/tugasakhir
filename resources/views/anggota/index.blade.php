@extends('admin.dashboard')

@section('content')
<div class="card-body">

    {{-- Flash Message Sukses --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
        </div>
    @endif

    {{-- Flash Message Error (opsional kalau mau ada) --}}
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <form method="GET" action="{{ route('anggota.index') }}" class="form-inline w-100">
            <div class="d-flex gap-2 align-items-center w-100">
                {{-- Input Pencarian --}}
                <div class="input-group w-50">
                    <input name="search" value="{{ request('search') }}" class="form-control form-control-sidebar" type="search" placeholder="Cari Anggota..." aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar" type="submit">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>

            

                {{-- Dropdown Pos Damkar --}}
                <div class="input-group w-30">
                    <select name="pos_damkar_id" class="form-control">
                        <option value="">-- Semua Pos Damkar --</option>
                        @foreach($damkars as $pos)
                            <option value="{{ $pos->id }}" {{ request('pos_damkar_id') == $pos->id ? 'selected' : '' }}>
                                {{ $pos->nama_pos }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tombol Submit --}}
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </div>
            </div>
        </form>

        {{-- Tombol Export --}}
    <div class="col-md-2 d-flex gap-2">
        <a href="{{ route('anggota.export.excel') }}" class="btn btn-success flex-fill">
            <i class="fas fa-file-excel"></i> Excel
        </a>
        {{-- <a href="{{ route('anggota.export.pdf') }}" class="btn btn-danger flex-fill">
            <i class="fas fa-file-pdf"></i> PDF
        </a> --}}
    </div>

        {{-- Tombol Tambah Data --}}
        <div class="col-md-3 text-right">
            <a href="{{ route('anggota.create') }}" class="btn btn-primary w-50">
                <i class="fas fa-plus me-1"></i> Tambah Data
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>No Register</th>
                    <th>Pos Damkar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($anggota as $index => $a)
                <tr>
                    <td>{{ $anggota->firstItem() + $index }}</td>
                    <td>{{ $a->nama }}</td>
                    <td>{{ $a->nik }}</td>
                    <td>{{ $a->no_register }}</td>
                    <td>{{ $a->damkar->nama_pos ?? 'Tidak Terdaftar' }}</td>
                    <td>
                        <a href="{{ route('anggota.edit', $a->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('anggota.destroy', $a->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
                    <td colspan="6" class="text-center">Belum ada data anggota.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="d-flex justify-content-end mt-3">
            <div class="pagination" style="margin-left: 10px;">
                {!! $anggota->appends(request()->query())->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
</div>
@endsection
