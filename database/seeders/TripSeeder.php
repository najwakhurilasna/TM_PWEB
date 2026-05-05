<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Trip;

class TripSeeder extends Seeder
{
    public function run(): void
    {
        $trips = [
            [
                'nama' => 'Kawah Ijen',
                'lokasi' => 'Banyuwangi',
                'deskripsi' => 'Menyaksikan fenomena blue fire yang memukau di Kawah Ijen. Pendakian malam yang tak terlupakan.',
                'harga' => 350000,
                'durasi' => 2,
                'fasilitas' => json_encode(['Transportasi PP', 'Guide Lokal', 'Masker Gas', 'Dokumentasi', 'Makan']),
                'status' => 'aktif',
            ],
            [
                'nama' => 'Pantai Boom',
                'lokasi' => 'Banyuwangi',
                'deskripsi' => 'Nikmati keindahan sunset di Pantai Boom, spot foto favorit di Banyuwangi.',
                'harga' => 200000,
                'durasi' => 1,
                'fasilitas' => json_encode(['Transportasi', 'Dokumentasi', 'Minuman']),
                'status' => 'aktif',
            ],
            [
                'nama' => 'Pulau Tabuhan',
                'lokasi' => 'Banyuwangi',
                'deskripsi' => 'Pulau kecil dengan air laut super jernih, cocok untuk snorkeling.',
                'harga' => 450000,
                'durasi' => 1,
                'fasilitas' => json_encode(['Perahu', 'Snorkeling Gear', 'Makan Siang', 'Guide']),
                'status' => 'aktif',
            ],
            [
                'nama' => 'Baluran National Park',
                'lokasi' => 'Banyuwangi',
                'deskripsi' => 'Jelajahi savana ala Afrika di Baluran, habitat berbagai satwa liar.',
                'harga' => 350000,
                'durasi' => 1,
                'fasilitas' => json_encode(['Transportasi 4x4', 'Tiket Masuk', 'Guide']),
                'status' => 'aktif',
            ],
            [
                'nama' => 'Green Bay (Teluk Ijo)',
                'lokasi' => 'Banyuwangi',
                'deskripsi' => 'Teluk tersembunyi dengan air hijau toska yang mempesona.',
                'harga' => 300000,
                'durasi' => 1,
                'fasilitas' => json_encode(['Transportasi', 'Boat', 'Dokumentasi']),
                'status' => 'aktif',
            ],

            [
                'nama' => 'Nusa Penida',
                'lokasi' => 'Bali',
                'deskripsi' => 'Jelajahi keindahan pantai Kelingking, Broken Beach, dan Angel Billabong.',
                'harga' => 450000,
                'durasi' => 1,
                'fasilitas' => json_encode(['Fast Boat PP', 'Makan Siang', 'Transportasi', 'Tour Guide']),
                'status' => 'aktif',
            ],
            [
                'nama' => 'Bedugul & Tanah Lot',
                'lokasi' => 'Bali',
                'deskripsi' => 'Wisata ke Danau Beratan dan Pura Tanah Lot ikonik.',
                'harga' => 350000,
                'durasi' => 1,
                'fasilitas' => json_encode(['Transportasi', 'Tiket Masuk', 'Guide', 'Dokumentasi']),
                'status' => 'aktif',
            ],
            [
                'nama' => 'Ubud & Tegalalang',
                'lokasi' => 'Bali',
                'deskripsi' => 'Wisata budaya di Ubud, Monkey Forest, dan Tegalalang Rice Terrace.',
                'harga' => 300000,
                'durasi' => 1,
                'fasilitas' => json_encode(['Transportasi', 'Tour Guide', 'Air Mineral', 'Dokumentasi']),
                'status' => 'aktif',
            ],
            [
                'nama' => 'Pantai Pandawa',
                'lokasi' => 'Bali',
                'deskripsi' => 'Pantai eksotis di Bali selatan dengan tebing tinggi yang menjulang.',
                'harga' => 250000,
                'durasi' => 1,
                'fasilitas' => json_encode(['Transportasi', 'Tiket Masuk', 'Dokumentasi']),
                'status' => 'aktif',
            ],
            [
                'nama' => 'Kintamani & Desa Penglipuran',
                'lokasi' => 'Bali',
                'deskripsi' => 'Nikmati pemandangan gunung Batur dan kunjungi desa adat Penglipuran.',
                'harga' => 400000,
                'durasi' => 1,
                'fasilitas' => json_encode(['Transportasi', 'Makan Siang', 'Guide', 'Dokumentasi']),
                'status' => 'aktif',
            ],
        ];

        foreach ($trips as $trip) {
            Trip::create($trip);
        }
    }
}
