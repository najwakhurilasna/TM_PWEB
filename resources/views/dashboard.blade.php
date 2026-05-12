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
                'img' => 'https://cdn.getyourguide.com/image/format=auto,fit=crop,gravity=auto,quality=60,width=400,height=265,dpr=2/tour_img/c386cfc673b6988b0604af96548f0b4b4e7fbae50ff7a9bf2b58d9b420e36aaa.jpg',
                'kategori' => 'banyuwangi'
            ],
            [
                'nama' => 'Pantai Boom',
                'desc' => 'Pesona sunset',
                'img' => 'https://www.gresiksatu.com/wp-content/uploads/2024/05/pantai-boom-banyuwangi-02.jpg',
                'kategori' => 'banyuwangi'
            ],
            [
                'nama' => 'Bedugul',
                'desc' => 'Danau Beratan',
                'img' => 'https://www.rentalmobilbali.net/wp-content/uploads/2022/09/feature-image-pura-ulun-danu-beratan-bedugul.webp',
                'kategori' => 'bali'
            ],
            [
                'nama' => 'Pantai Pandawa',
                'desc' => 'Pantai eksotis',
                'img' => 'https://cdn-jpr.jawapos.com/images/22/2024/08/12/FotoJet-2024-08-12T123449780-642017321.jpg',
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
