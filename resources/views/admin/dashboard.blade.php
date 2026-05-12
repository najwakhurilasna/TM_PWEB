@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Dashboard Admin NajaTrip</h4>
                </div>
                <div class="card-body">
                    <p>Selamat datang, <strong>{{ Auth::user()->name }}</strong>!</p>
                    <p>Anda memiliki akses penuh untuk mengelola paket trip.</p>
                    <a href="{{ route('admin.trips.index') }}" class="btn btn-primary">
                        <i class="fas fa-route"></i> Kelola Trip
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection