<div class="table-responsive">
  <table class="table table-striped table-bordered align-middle">
    <thead class="table-dark text-center">
      <tr>
        <th>No</th>
        <th>Nama Pos</th>
        <th>Kecamatan</th>
        <th>Jumlah Anggota</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($damkars as $index => $pos)
        <tr>
          <td class="text-center">{{ $damkars->firstItem() + $index }}</td>
          <td>{{ $pos->nama_pos }}</td>
          <td>{{ $pos->kecamatan }}</td>
          <td class="text-center">{{ $pos->anggota_count }}</td>
          <td class="text-center">
            <!-- Tombol Lihat Anggota -->
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#anggotaModal{{ $pos->id }}">
              Lihat Anggota
            </button>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

{{-- <div id="pagination-links"> jangan dibungkus di dalam #damkar-table --}}
<div id="pagination-links" class="d-flex justify-content-center mt-3">
  {!! $damkars->withQueryString()->links('pagination::bootstrap-5') !!}
</div>


@foreach ($damkars as $pos)
<div class="modal fade" id="anggotaModal{{ $pos->id }}" tabindex="-1" aria-labelledby="anggotaModalLabel{{ $pos->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="anggotaModalLabel{{ $pos->id }}">Anggota Pos: {{ $pos->nama_pos }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        @php $anggotaPos = $pos->anggota; @endphp
        @if($anggotaPos->isEmpty())
          <p class="text-muted">Belum ada anggota tercatat.</p>
        @else
        <div class="table-responsive">
          <table class="table table-sm table-bordered">
            <thead class="table-secondary text-center">
              <tr>
                <th>No</th>
                <th>Nama</th>
                {{-- <th>NIK</th> --}}
                <th>No Register</th>
              </tr>
            </thead>
            <tbody>
              @foreach($anggotaPos as $i => $a)
              <tr>
                <td class="text-center">{{ $i + 1 }}</td>
                <td>{{ $a->nama }}</td>
                {{-- <td>{{ $a->nik ?? '-' }}</td> --}}
                <td>{{ $a->no_register }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
@endforeach


<!-- Footer -->
<footer>
    <p>&copy; 2025 <strong>SIG Pemadam Kebakaran Kota Banjarmasin</strong>. All rights About Fire.</p>
    {{-- <p>Built with ❤️ by <a href="https://namadeveloper.com" target="_blank" style="color: #07655f; text-decoration: none;">Muhammad Rizky</a></p> --}}
</footer>