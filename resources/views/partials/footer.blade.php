<footer class="footer">
    <div class="footer-top">
        <div class="footer-box">
            <h3>Link Terkait</h3>
            <ul>
                <li><a href="{{ route('dashboard') }}">Beranda</a></li>
                <li><a href="{{ route('detail') }}">Detail Trip</a></li>
                <li><a href="{{ route('transaksi') }}">Transaksi</a></li>
                <li><a href="{{ route('daftar') }}">Daftar</a></li>
            </ul>
        </div>

        <div class="footer-box footer-brand-box">
            <div class="footer-logo">
                <img src="{{ asset('logo.png') }}" alt="Logo NajaTrip" class="footer-logo-img">
                <h3>NajaTrip</h3>
            </div>
            <p class="misi-text">Open Trip Banyuwangi - Bali</p>
            <p class="misi-desc">
                Solusi mudah untuk menjelajahi pesona dua dunia:
                cerdas memilih rute, berakhlak dalam perjalanan,
                berwawasan wisata, dan bertanggung jawab sosial.
            </p>
            <div class="social-icons-footer">
                <a href="#"><i class="fab fa-whatsapp"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-tiktok"></i></a>
            </div>
        </div>

        <div class="footer-box footer-contact">
            <h3>Kontak</h3>
            <div class="contact-address">
                <p><i class="fas fa-map-marker-alt"></i> JL. Raya Banyuwangi, No.02</p>
                <p><i class="fas fa-location-dot"></i> Kembangbelor, Banyuwangi</p>
                <p><i class="fas fa-location-dot"></i> Jawa Timur, Indonesia</p>
                <p><i class="fas fa-phone"></i> (0333) 1234567</p>
                <p><i class="fas fa-envelope"></i> info@najatrip.com</p>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>© 2026 NajaTrip | Powered by Khuril</p>
    </div>
</footer>
