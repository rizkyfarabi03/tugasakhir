@extends('admin.edit')

@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="mb-4">Edit Anggota</h4>
        <form action="{{ route('anggota.update', $anggota->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" 
                       value="{{ old('nama', $anggota->nama) }}" required>
            </div>

            <div class="mb-3">
                <label for="nik" class="form-label">NIK</label>
                <input type="text" name="nik" class="form-control" 
                       value="{{ old('nik', $anggota->nik) }}">
                <small class="text-muted">Kosongkan jika tidak ada</small>
            </div>

            <div class="mb-3">
                <label for="no_register" class="form-label">No Register</label>
                <input type="text" name="no_register" class="form-control" 
                       value="{{ old('no_register', $anggota->no_register) }}" required>
            </div>

            {{-- Dropdown Kecamatan --}}
            <div class="mb-3">
                <label for="kecamatan" class="form-label">Kecamatan</label>
                <select id="kecamatan" class="form-control" required>
                    <option value="">-- Pilih Kecamatan --</option>
                    @foreach ($listKecamatan as $kec)
                        <option value="{{ $kec }}" 
                            {{ old('kecamatan', $anggota->posDamkar->kecamatan ?? '') == $kec ? 'selected' : '' }}>
                            {{ $kec }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Dropdown Pos Damkar --}}
            <div class="mb-3">
                <label for="pos_damkar_id" class="form-label">Pos Damkar</label>
                <select name="pos_damkar_id" id="pos_damkar_id" class="form-control" required>
                    <option value="">-- Pilih Pos Damkar --</option>
                    {{-- Nanti diisi via JS --}}
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Edit</button>
            <a href="{{ route('anggota.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const kecamatanSelect = document.getElementById('kecamatan');
    const posDamkarSelect = document.getElementById('pos_damkar_id');
    const selectedPos = "{{ old('pos_damkar_id', $anggota->pos_damkar_id) }}";

    function loadPosDamkar(kecamatan, selected = null) {
        posDamkarSelect.innerHTML = '<option value="">-- Pilih Pos Damkar --</option>';

        if (kecamatan) {
            fetch(`/api/pos-damkar/by-kecamatan/${encodeURIComponent(kecamatan)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) {
                        posDamkarSelect.innerHTML += '<option disabled>Tidak ada Pos Damkar</option>';
                    } else {
                        data.forEach(pos => {
                            const opt = document.createElement('option');
                            opt.value = pos.id;
                            opt.textContent = pos.nama_pos;
                            if (selected && selected == pos.id) {
                                opt.selected = true;
                            }
                            posDamkarSelect.appendChild(opt);
                        });
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    alert('Gagal memuat data Pos Damkar.');
                });
        }
    }

    // ketika user ganti kecamatan
    kecamatanSelect.addEventListener('change', function () {
        loadPosDamkar(this.value);
    });

    // load awal sesuai data anggota
    if (kecamatanSelect.value) {
        loadPosDamkar(kecamatanSelect.value, selectedPos);
    }
});
</script>
@endpush
