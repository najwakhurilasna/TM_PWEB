@extends('layouts.app')

@section('title', 'Form Pemesanan - NajaTrip')

@section('content')
<div class="content form-container">
    <div class="form-card">
        <h2><i class="fas fa-clipboard-list"></i> Booking Trip</h2>
        <p>Isi data diri Anda dengan lengkap dan benar</p>

        <form id="formBooking" method="POST" action="{{ route('transaksi.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label><i class="fas fa-user"></i> Nama Lengkap</label>
                <input type="text" id="nama" name="nama" class="form-input" placeholder="Masukkan nama lengkap" required>
            </div>

            <div class="form-group">
                <label><i class="fas fa-phone"></i> Nomor Telepon</label>
                <input type="text" id="telp" name="telp" class="form-input" placeholder="08xxxxxxxxxx" required>
            </div>

            <div class="form-group">
                <label><i class="fas fa-map-marker-alt"></i> Tujuan Daerah</label>
                <select id="tujuan" name="tujuan" class="form-input" required>
                    <option value="">-- Pilih Tujuan --</option>
                    <option value="Banyuwangi">Banyuwangi</option>
                    <option value="Bali">Bali</option>
                </select>
            </div>

            <div class="form-group">
                <label><i class="fas fa-box"></i> Pilih Paket Trip</label>
                <select id="paket" name="paket" class="form-input" required>
                    <option value="">-- Pilih Paket --</option>
                </select>
            </div>

            <div class="form-group">
                <label><i class="fas fa-calendar"></i> Tanggal Keberangkatan</label>
                <input type="date" id="tanggal" name="tanggal" class="form-input" required>
            </div>

            <div class="form-group">
                <label><i class="fas fa-users"></i> Jumlah Peserta</label>
                <input type="number" id="peserta" name="peserta" class="form-input" placeholder="Jumlah orang" min="1" required>
            </div>

            <div class="form-group">
                <label><i class="fas fa-id-card"></i> Upload Identitas (KTP/KK)</label>
                <input type="file" id="ktp" name="ktp" class="form-input" accept="image/*" required>
                <small style="color:var(--gray);">Max 1MB, format gambar</small>
            </div>

            <div class="form-group">
                <label><i class="fas fa-receipt"></i> Upload Bukti Pembayaran DP</label>
                <input type="file" id="bukti" name="bukti" class="form-input" accept="image/*" required>
                <small style="color:var(--gray);">Max 1MB, format gambar</small>
            </div>

            <button type="submit" class="submit-btn"><i class="fas fa-paper-plane"></i> Booking Sekarang</button>
        </form>
    </div>
</div>
@endsection
