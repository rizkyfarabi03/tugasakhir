{{-- resources/views/partials/filter-kecamatan.blade.php --}}

<div class="row align-items-center">
    <label for="kecamatan" class="col-auto col-form-label fw-semibold">Filter Kecamatan:</label>
    <div class="col-auto">
      <select name="kecamatan" id="kecamatan" class="form-select" onchange="this.form.submit()">
        <option value="">-- Semua Kecamatan --</option>
        @foreach($kecamatanList as $kecamatan)
           <option value="{{ $kecamatan }}" {{ ($selectedKecamatan ?? '') == $kecamatan ? 'selected' : '' }}>
                {{ $kecamatan }}
          </option>
        @endforeach
      </select>
    </div>
  </div>