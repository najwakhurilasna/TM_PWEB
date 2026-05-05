<div class="card card-hover border-0 shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h6 class="text-muted mb-2">{{ $judul ?? 'Statistik' }}</h6>
                <h2 class="mb-0 fw-bold">{{ $nilai ?? '0' }}</h2>
            </div>
            <div class="rounded-circle p-3 d-flex align-items-center justify-content-center"
                 style="background: {{ $warna ?? '#667eea' }}20; width: 60px; height: 60px;">
                <i class="{{ $ikon ?? 'fas fa-chart-line' }} fa-2x" style="color: {{ $warna ?? '#667eea' }};"></i>
            </div>
        </div>
        @if(isset($deskripsi))
            <small class="text-muted mt-2 d-block">{{ $deskripsi }}</small>
        @endif
    </div>
</div>
