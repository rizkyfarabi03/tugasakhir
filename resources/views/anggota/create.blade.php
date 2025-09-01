@extends('admin.edit')

@section('content')
<div class="card-body">
    <h4 class="mb-4">Tambah Anggota</h4>

    <form method="POST" action="{{ route('anggota.store') }}">
        @csrf

        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
        </div>

        <div class="mb-3">
            <label for="nik" class="form-label">NIK</label>
            <input type="text" name="nik" class="form-control" value="{{ old('nik') }}">
        </div>

        <div class="mb-3">
            <label for="no_register" class="form-label">No Register</label>
            <input type="text" name="no_register" class="form-control" value="{{ old('no_register') }}" required>
        </div>

        {{-- Dropdown Kecamatan --}}
        <div class="mb-3">
            <label for="kecamatan" class="form-label">Kecamatan</label>
            <select id="kecamatan" class="form-control" required>
                <option value="">-- Pilih Kecamatan --</option>
                @foreach ($listKecamatan as $kec)
                    <option value="{{ $kec }}">{{ $kec }}</option>
                @endforeach
            </select>
        </div>

        {{-- Dropdown Pos Damkar --}}
        <div class="mb-3">
            <label for="pos_damkar_id" class="form-label">Pos Damkar</label>
            <select name="pos_damkar_id" id="pos_damkar_id" class="form-control" required>
                <option value="">-- Pilih Pos Damkar --</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Simpan
        </button>
        <a href="{{ route('anggota.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const kecamatanSelect = document.getElementById('kecamatan');
        const posDamkarSelect = document.getElementById('pos_damkar_id');

        kecamatanSelect.addEventListener('change', function () {
            const kecamatan = this.value;
            posDamkarSelect.innerHTML = '<option value="">-- Pilih Pos Damkar --</option>';

            if (kecamatan) {
                fetch(`/api/pos-damkar/by-kecamatan/${encodeURIComponent(kecamatan)}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Gagal ambil data');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.length === 0) {
                            posDamkarSelect.innerHTML += '<option disabled>Tidak ada Pos Damkar</option>';
                        } else {
                            data.forEach(pos => {
                                posDamkarSelect.innerHTML += `<option value="${pos.id}">${pos.nama_pos}</option>`;
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Fetch error:', error);
                        alert('Gagal memuat data Pos Damkar.');
                    });
            }
        });
    });
</script>
@endpush
