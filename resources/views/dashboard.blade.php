@extends('layouts.app')

@section('title', 'Dashboard - NajaTrip')

@section('content')
<div class="content">

    <div class="search-hero">
        <h2>Selamat Datang di NajaTrip</h2>
        <p>Jelajahi Pesona Banyuwangi & Bali bersama kami</p>

        <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" id="searchIndex" placeholder="Cari wisata...">
        </div>
    </div>

    <p id="noResultIndex" style="display:none; text-align:center; margin-top:20px;">
        😔 Mohon maaf, destinasi tidak ditemukan
    </p>

    <section>
        <div class="section-header">
            <h2>Wisata Populer</h2>
            <p>Destinasi favorit</p>
        </div>

        @php
        $wisata = [
            [
                'nama' => 'Kawah Ijen',
                'desc' => 'Blue fire fenomenal',
                'img' => 'https://cdn.getyourguide.com/image/format=auto...',
                'kategori' => 'banyuwangi'
            ],
            [
                'nama' => 'Pantai Boom',
                'desc' => 'Pesona sunset',
                'img' => 'https://www.gresiksatu.com/...',
                'kategori' => 'banyuwangi'
            ],
            [
                'nama' => 'Bedugul',
                'desc' => 'Danau Beratan',
                'img' => 'https://www.rentalmobilbali.net/...',
                'kategori' => 'bali'
            ],
            [
                'nama' => 'Pantai Pandawa',
                'desc' => 'Pantai eksotis',
                'img' => 'https://cdn-jpr.jawapos.com/...',
                'kategori' => 'bali'
            ],
        ];
        @endphp

        <div class="card-container">

            @forelse($wisata as $w)
            <div class="card wisata-card" data-kategori="{{ $w['kategori'] }}">

                <div class="img-wrapper">
                    <img src="{{ $w['img'] }}" alt="{{ $w['nama'] }}">
                </div>

                <h4>{{ $w['nama'] }}</h4>
                <p class="desc">{{ $w['desc'] }}</p>

            </div>

            @empty
            <p style="text-align:center;">Data wisata tidak tersedia</p>
            @endforelse

        </div>
    </section>
</div>
@endsection
