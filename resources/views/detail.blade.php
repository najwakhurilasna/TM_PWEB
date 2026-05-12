@extends('layouts.app')

@section('title', 'Detail Trip')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="hero-section text-center" style="background: linear-gradient(135deg, #0F2B4D, #1A4A7A); padding: 50px; border-radius: 20px; color: white;">
            <h1>Daftar Paket Trip</h1>
            <p>Pilih destinasi favoritmu dan mulai petualangan!</p>
        </div>
    </div>
</div>

<div class="row mt-4">
    @forelse($trips ?? [] as $trip)
    <div class="col-md-4 mb-4">
        <div class="card h-100 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">{{ $trip->nama }}</h5>
                <p class="card-text text-muted">
                    <i class="fas fa-map-marker-alt"></i> {{ $trip->lokasi }}<br>
                    <i class="fas fa-clock"></i> {{ $trip->durasi}} hari<br>
                    <strong class="text-primary">Rp {{ number_format($trip->harga, 0, ',', '.') }}</strong> / orang
                </p>
                <a href="{{ route('transaksi') }}" class="btn btn-primary w-100">
                    <i class="fas fa-shopping-cart"></i> Pesan Sekarang
                </a>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="alert alert-info">Belum ada trip tersedia.</div>
    </div>
    @endforelse
</div>
@endsection
