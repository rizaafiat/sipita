    <footer class="footer">
        <div class="footer-content">
            <!-- Alamat & Kontak -->
            <div class="footer-section">
                <h3>Alamat & Kontak</h3>
                <div class="address-info">
                    <p>
                        <span class="icon"><i class="fa-solid fa-building"></i></span>
                        <span>Perwakilan BKKBN Provinsi Kalimantan Selatan<br>
                        Jl. Gatot Subroto No. 09, Kel. Kebun Bunga, Kec. Banjarmasin Timur<br>
                        Banjarmasin, Kalimantan Selatan 70235</span>
                    </p>
                    <p>
                        <span class="icon"><i class="fa-solid fa-phone"></i></span>
                        <span>(0511) 3253279</span>
                    </p>
                    <p>
                        <span class="icon"><i class="fa-solid fa-envelope"></i></span>
                        <span>kalsel@bkkbn.go.id</span>
                    </p>
                    <p>
                        <span class="icon"><i class="fa-solid fa-globe"></i></span>
                        <span><a href ="https://kalsel.kemendukbangga.go.id" >kalsel.kemendukbangga.go.id</a></span>
                    </p>
                </div>
            </div>

            <!-- Link Cepat -->
            <div class="footer-section">
                <h3>Link Cepat</h3>
                <ul class="quick-links">
                    <li><a href="/permohonan_informasi.php">Permohonan Informasi</a></li>
                    <li><a href="/cek_status_permohonan.php">Cek Status Permohonan</a></li>
                    <li><a href="/jumlah_permohonan.php">Jumlah Pemohon Informasi</a></li>
                </ul>
            </div>

            <!-- Sosial Media -->
            <div class="footer-section">
                <h3>Ikuti Kami</h3>
                <p style="color: rgba(255, 255, 255, 0.8); margin-bottom: 15px; line-height: 1.6;">
                    Dapatkan informasi terbaru tentang program dan kegiatan BKKBN Kalimantan Selatan
                </p>
                <div class="social-links">
                    <a href="https://www.youtube.com/@kemendukbangga_bkkbnkalsel" class="social-link youtube">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="https://www.instagram.com/kemendukbangga_bkkbnkalsel/" class="social-link instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://twitter.com/BkkbnKalsel" class="social-link twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="https://www.facebook.com/bkkbnkalsel75/" class="social-link facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://www.tiktok.com/@kalselbkkbn" class="social-link tiktok">
                        <i class="fab fa-tiktok"></i>
                    </a>
                    <a href="https://e-ppid.bkkbn.go.id/" class="social-link ppid">
                        <span>PPID</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <p class="copyright">
                © 2025 Perwakilan BKKBN Provinsi Kalimantan Selatan. All Rights Reserved.
            </p>
            <p class="last-updated">
                Website terakhir diperbarui: <span id="lastUpdate">21 Juli 2025, 14:30 WIB</span>
            </p>
        </div>
    </footer>
</body>
</html>

<script>

        // Simulasi update waktu real-time
        function updateTime() {
            const now = new Date();
            const options = { 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric', 
                hour: '2-digit', 
                minute: '2-digit',
                timeZone: 'Asia/Makassar'
            };
            document.getElementById('lastUpdate').textContent = now.toLocaleDateString('id-ID', options) + ' WITA';
        }

        // Inisialisasi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', function() {
            // Animasi counter untuk statistik

            // Update waktu setiap menit
            updateTime();
            setInterval(updateTime, 60000);

        });
    </script>