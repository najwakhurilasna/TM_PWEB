@extends('layouts.app')

@section('title', 'Kelola Trip - Admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Kelola Paket Trip</h2>
        <a href="{{ route('admin.trips.create') }}" class="btn btn-primary">Tambah Trip</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Nama Trip</th>
                        <th>Lokasi</th>
                        <th>Harga</th>
                        <th>Durasi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($trips as $key => $trip)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>
                            @if($trip->gambar)
                                <img src="{{ asset('storage/' . $trip->gambar) }}" width="50" height="50" style="object-fit: cover; border-radius: 8px;">
                            @else
                                <span class="badge bg-secondary">No Image</span>
                            @endif
                        </td>
                        <td>{{ $trip->nama }}</td>
                        <td>{{ $trip->lokasi }}</td>
                        <td>Rp {{ number_format($trip->harga, 0, ',', '.') }}</td>
                        <td>{{ $trip->durasi }} hari</td>
                        <td>
                            @if($trip->status == 'aktif')
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-danger">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.trips.show', $trip->id) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('admin.trips.edit', $trip->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.trips.destroy', $trip->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $trips->links() }}
        </div>
    </div>
</div>
@endsection