@extends('layouts.app')

@section('title', 'Daftar Pemesanan - NajaTrip')

@section('content')
<div class="content">
    <div class="section-header">
        <h2><i class="fas fa-table"></i> Data Pemesanan</h2>
        <p>Semua data booking customer</p>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Telepon</th>
                    <th>Tujuan</th>
                    <th>Paket</th>
                    <th>Tanggal</th>
                    <th>Peserta</th>
                    <th>KTP</th>
                    <th>Bukti</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="dataTabel"></tbody>
        </table>
    </div>

    <div class="statistik-container">
        <div class="stat-card">
            <h4><i class="fas fa-clipboard-list"></i> Total Booking</h4>
            <p id="totalBooking">0</p>
        </div>
        <div class="stat-card">
            <h4><i class="fas fa-mountain"></i> Total Peserta Banyuwangi</h4>
            <p id="totalBanyuwangi">0</p>
        </div>
        <div class="stat-card">
            <h4><i class="fas fa-umbrella-beach"></i> Total Peserta Bali</h4>
            <p id="totalBali">0</p>
        </div>
        <div class="stat-card">
            <h4><i class="fas fa-money-bill-wave"></i> Total Pendapatan</h4>
            <p id="totalPendapatan">Rp 0</p>
        </div>
    </div>
</div>

<aside class="sidebar">
    <div class="filter-sidebar">
        <h3><i class="fas fa-filter"></i> Filter Tujuan</h3>
        <label class="checkbox"><input type="checkbox" value="Bali"> 🌴 Bali</label>
        <label class="checkbox"><input type="checkbox" value="Banyuwangi"> 🏞️ Banyuwangi</label>
        <button class="filter-btn" onclick="filterData()"><i class="fas fa-search"></i> Terapkan Filter</button>
    </div>
</aside>

{{-- Popup Edit Status --}}
<div id="popupEdit" class="popup" style="display:none;">
    <div class="popup-content">
        <h3>Edit Status Pemesanan</h3>
        <select id="editStatus" class="form-input">
            <option value="DP">DP (Down Payment)</option>
            <option value="Lunas">Lunas</option>
            <option value="Batal">Batal</option>
        </select>
        <div style="margin-top:20px; display:flex; gap:10px;">
            <button onclick="simpanEdit()" class="submit-btn" style="flex:1;">Simpan</button>
            <button onclick="tutupPopup()" class="filter-btn" style="flex:1;">Batal</button>
        </div>
    </div>
</div>
@endsection
