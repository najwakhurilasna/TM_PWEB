<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            return view('admin.dashboard');
        }
        $trips = Trip::where('status','aktif')->get();
        return view('dashboard', compact('trips'));  
    }

    // Halaman detail trip (customer)
    public function detail()
    {
        $trips = Trip::where('status', 'aktif')->get();
        return view('detail', compact('trips'));
    }

    // Halaman transaksi
    public function transaksi()
    {
        return view('transaksi');
    }

    // Halaman daftar pemesanan
    public function daftar()
    {
        return view('daftar');
    }

    // Proses transaksi
    public function prosesTransaksi(Request $request)
    {
        return redirect()->route('daftar')->with('success', 'Booking berhasil!');
    }
}