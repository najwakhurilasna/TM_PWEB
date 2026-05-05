<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Halaman dashboard
    public function index()
    {
        return view('dashboard');
    }

    // Halaman detail
    public function detail()
    {
        return view('detail');
    }

    // Halaman transaksi
    public function transaksi()
    {
        return view('transaksi');
    }

    // Halaman daftar
    public function daftar()
    {
        return view('daftar');
    }

    // Proses transaksi (simpan booking)
    public function prosesTransaksi(Request $request)
    {
        // Nanti diisi logika simpan ke database
        return redirect()->route('daftar')->with('success', 'Booking berhasil!');
    }
}
