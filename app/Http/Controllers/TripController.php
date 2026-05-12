<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini!');
        }
        $trips = Trip::latest()->paginate(10);
        return view('admin.trips.index', compact('trips'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini!');
        }
        return view('admin.trips.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini!');
        }
        
        $request->validate([
            'nama' => 'required|string|min:3|max:100',
            'lokasi' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'harga' => 'required|integer|min:0',
            'durasi' => 'required|integer|min:1',
            'fasilitas' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        $data = $request->all();

        if ($request->fasilitas) {
            $data['fasilitas'] = json_encode(explode(',', $request->fasilitas));
        }

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('trips', 'public');
            $data['gambar'] = $path;
        }

        Trip::create($data);

        return redirect('/admin/trips')->with('success', 'Trip berhasil ditambahkan!');
    }

    public function show(Trip $trip)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini!');
        }
        return view('admin.trips.show', compact('trip'));
    }

    public function edit(Trip $trip)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini!');
        }
        return view('admin.trips.edit', compact('trip'));
    }

    public function update(Request $request, Trip $trip)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini!');
        }
        
        $request->validate([
            'nama' => 'required|string|min:3|max:100',
            'lokasi' => 'required|string|max:100',
            'deskripsi' => 'required|string',
            'harga' => 'required|integer|min:0',
            'durasi' => 'required|integer|min:1',
            'fasilitas' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        $data = $request->all();

        if ($request->fasilitas) {
            $data['fasilitas'] = json_encode(explode(',', $request->fasilitas));
        }

        if ($request->hasFile('gambar')) {
            if ($trip->gambar) {
                Storage::disk('public')->delete($trip->gambar);
            }
            $path = $request->file('gambar')->store('trips', 'public');
            $data['gambar'] = $path;
        }

        $trip->update($data);

        return redirect('/admin/trips')->with('success', 'Trip berhasil diupdate!');
    }

    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini!');
        }
        
        $trip = Trip::findOrFail($id);

        if ($trip->gambar) {
            Storage::disk('public')->delete($trip->gambar);
        }

        $trip->delete();

        return redirect('/admin/trips')->with('success', 'Trip berhasil dihapus!');
    }
}