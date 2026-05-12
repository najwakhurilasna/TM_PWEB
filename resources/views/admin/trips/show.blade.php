@extends('layouts.app')

@section('title', 'Detail Trip - Admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="fas fa-info-circle"></i> Detail Paket Trip</h2>
    <div>
        <a href="{{ route('admin.trips.edit', $trip->id) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Edit
        </a>
        <a href="{{ route('admin.trips.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                @if($trip->gambar)
                    <img src="{{ asset('storage/' . $trip->gambar) }}" class="img-fluid rounded">
                @else
                    <div class="bg-light text-center p-5 rounded">
                        <i class="fas fa-image fa-4x text-muted"></i>
                        <p class="mt-2">Tidak ada gambar</p>
                    </div>
                @endif
            </div>
            <div class="col-md-8">
                <table class="table">
                    <tr><th width="150">Nama Trip</th><td>: {{ $trip->nama }}</td></tr>
                    <tr><th>Lokasi</th><td>: {{ $trip->lokasi }}</td></tr>
                    <tr><th>Harga</th><td>: Rp {{ number_format($trip->harga, 0, ',', '.') }} / orang</td></tr>
                    <tr><th>Durasi</th><td>: {{ $trip->durasi }} hari</td></tr>
                    <tr>
                        <th>Status</th>
                        <td>:
                            @if($trip->status == 'aktif')
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-danger">Nonaktif</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Fasilitas</th>
                        <td>:
                            @if($trip->fasilitas)
                                @foreach(is_array($trip->fasilitas) ? $trip->fasilitas : [] as $fasilitas)
                                    <span class="badge bg-info">✓ {{ $fasilitas }}</span>
                                @endforeach
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    <tr><th>Deskripsi</th><td>: {{ $trip->deskripsi }}</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
