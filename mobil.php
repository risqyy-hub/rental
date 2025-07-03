<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mobil - AutoRent</title>
    <link rel="stylesheet" href="stylesm.css">
    <link rel="stylesheet" href="jss/m.js">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <nav>
                <div class="logo">Auto<span>Rent</span></div>
                <ul class="nav-links">
                <li><a href="index.html">Beranda</a></li>
                    <li><a href="mobil.php">Mobil</a></li>
                    <li><a href="about.html">Tentang Kami</a></li>
                    <li><a href="contact.html">Kontak</a></li>
                </ul>
                <div class="auth-buttons">
            </div>
            </nav>
        </div>
    </header>

    <div class="slider-container">
    <div class="slider">
        <div class="slide active">
            <img src="images/slider1.jpg" alt="Mobil Terbaik untuk Perjalanan Anda">
            <div class="slide-content">
                <h2>Mobil Terbaik untuk Perjalanan Anda</h2>
                <p>Rasakan kenyamanan berkendara dengan armada terbaru kami</p>
                <button class="slider-btn">Lihat Detail</button>
            </div>
        </div>
        <div class="slide">
            <img src="images/slider2.jpg" alt="Harga Terjangkau">
            <div class="slide-content">
                <h2>Harga Terjangkau</h2>
                <p>Nikmati harga spesial untuk pengalaman berkendara premium</p>
                <button class="slider-btn">Lihat Detail</button>
            </div>
        </div>
        <div class="slide">
            <img src="images/slider3.jpg" alt="Layanan 24/7">
            <div class="slide-content">
                <h2>Layanan 24/7</h2>
                <p>Siap melayani kebutuhan transportasi Anda kapanpun</p>
                <button class="slider-btn">Lihat Detail</button>
            </div>
        </div>
        <div class="slide">
            <img src="images/slider4.jpg" alt="Promo Liburan">
            <div class="slide-content">
                <h2>Promo Liburan</h2>
                <p>Dapatkan diskon hingga 25% untuk pemesanan liburan</p>
                <button class="slider-btn">Lihat Detail</button>
            </div>
        </div>
        <div class="slide">
            <img src="images/slider5.jpg" alt="Mobil Mewah">
            <div class="slide-content">
                <h2>Mobil Mewah</h2>
                <p>Koleksi mobil mewah untuk acara spesial Anda</p>
                <button class="slider-btn">Lihat Detail</button>
            </div>
        </div>
    </div>
    <button class="slider-nav prev">&#10094;</button>
    <button class="slider-nav next">&#10095;</button>
    <div class="slider-indicators">
        <span class="indicator active" data-index="0"></span>
        <span class="indicator" data-index="1"></span>
        <span class="indicator" data-index="2"></span>
        <span class="indicator" data-index="3"></span>
        <span class="indicator" data-index="4"></span>
    </div>
</div>

    <!-- Page Banner -->
    <div class="page-banner">
        <div class="container">
            <h1>Daftar Mobil</h1>
            <p>Pilih mobil terbaik untuk kebutuhan perjalanan Anda</p>
        </div>
    </div>

    <!-- Filter Section -->
    <section class="filter-section">
        <div class="container">
            <div class="filters">
                <div class="filter-group">
                    <label>Kategori</label>
                    <select id="category-filter">
                        <option value="all">Semua Kategori</option>
                        <option value="sedan">Sedan</option>
                        <option value="suv">SUV</option>
                        <option value="mpv">MPV</option>
                        <option value="sports">Sport</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Kapasitas</label>
                    <select id="capacity-filter">
                        <option value="all">Semua Kapasitas</option>
                        <option value="2">2 Orang</option>
                        <option value="5">5 Orang</option>
                        <option value="7">7 Orang</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Transmisi</label>
                    <select id="transmission-filter">
                        <option value="all">Semua Transmisi</option>
                        <option value="Manual">Manual</option>
                        <option value="Otomatis">Otomatis</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Harga</label>
                    <select id="price-filter">
                        <option value="all">Semua Harga</option>
                        <option value="low">< Rp 400.000</option>
                        <option value="mid">Rp 400.000 - Rp 800.000</option>
                        <option value="high">> Rp 800.000</option>
                    </select>
                </div>
                <button class="btn" id="apply-filter">Terapkan Filter</button>
            </div>
        </div>
    </section>

    <!-- Cars List -->
    <section class="cars-list">
        <div class="container">
            <div class="cars-grid" id="cars-container">
                <!-- Cars will be loaded here via JavaScript -->
            </div>
            <div class="pagination">
                <button class="pagination-btn" disabled>Sebelumnya</button>
                <div class="page-numbers">
                    <a href="#" class="active">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                </div>
                <button class="pagination-btn">Selanjutnya</button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>AutoRent</h3>
                    <p>Layanan persewaan mobil terpercaya dengan armada berkualitas dan pelayanan profesional.</p>
                    <div class="social-links">
                        <a href="#"><span>FB</span></a>
                        <a href="#"><span>IG</span></a>
                        <a href="#"><span>TW</span></a>
                        <a href="#"><span>YT</span></a>
                    </div>
                </div>
                <div class="footer-column">
                    <h3>Tautan Cepat</h3>
                    <ul>
                    <li><a href="index.html">Beranda</a></li>
                    <li><a href="mobil.php">Mobil</a></li>
                    <li><a href="about.html">Tentang Kami</a></li>
                    <li><a href="contact.html">Kontak</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Layanan</h3>
                    <style>

                        /* CSS untuk Slider */
.slider-container {
    position: relative;
    width: 100%;
    height: 500px;
    overflow: hidden;
    margin-bottom: 30px;
}

.slider {
    width: 100%;
    height: 100%;
    position: relative;
}

.slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: opacity 0.6s ease-in-out;
    display: flex;
    align-items: center;
}

.slide.active {
    opacity: 1;
    z-index: 1;
}

.slide img {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.slide-content {
    position: relative;
    z-index: 2;
    max-width: 600px;
    padding: 30px;
    margin-left: 10%;
    background-color: rgba(0, 0, 0, 0.6);
    color: #fff;
    border-radius: 5px;
}

.slide-content h2 {
    font-size: 2.5rem;
    margin-bottom: 15px;
    color: #fff;
}

.slide-content p {
    font-size: 1.2rem;
    margin-bottom: 20px;
}

.slider-btn {
    background-color: #4285f4;
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 4px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s;
}

.slider-btn:hover {
    background-color: #3367d6;
}

.slider-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    width: 50px;
    height: 50px;
    background-color: rgba(0, 0, 0, 0.5);
    color: white;
    border: none;
    border-radius: 50%;
    font-size: 24px;
    cursor: pointer;
    z-index: 3;
    transition: background-color 0.3s;
}

.slider-nav:hover {
    background-color: rgba(0, 0, 0, 0.8);
}

.slider-nav.prev {
    left: 20px;
}

.slider-nav.next {
    right: 20px;
}

.slider-indicators {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 10px;
    z-index: 3;
}

.indicator {
    width: 15px;
    height: 15px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.5);
    cursor: pointer;
    transition: background-color 0.3s;
}

.indicator.active {
    background-color: white;
}

/* Responsif untuk perangkat mobile */
@media (max-width: 768px) {
    .slider-container {
        height: 350px;
    }
    
    .slide-content {
        max-width: 85%;
        margin-left: 5%;
        padding: 15px;
    }
    
    .slide-content h2 {
        font-size: 1.8rem;
    }
    
    .slide-content p {
        font-size: 1rem;
    }
    
    .slider-nav {
        width: 40px;
        height: 40px;
        font-size: 18px;
    }
}
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        
        body {
            padding: 20px;
            background-color: #f5f5f5;
        }
        
        .menu-container {
            max-width: 600px;
            margin: 0 auto;
        }
        
        .menu-item {
            background-color: #fff;
            margin-bottom: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
        }
        
        .menu-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }
        
        .menu-item a {
            display: block;
            padding: 16px 20px;
            color: #333;
            text-decoration: none;
            font-weight: bold;
            border-left: 4px solid #4285f4;
        }
        
        .menu-item:nth-child(2) a {
            border-left-color: #ea4335;
        }
        
        .menu-item:nth-child(3) a {
            border-left-color: #fbbc05;
        }
        
        .menu-item:nth-child(4) a {
            border-left-color: #34a853;
        }
    </style>
</head>
<body>
    <div class="menu-container">
        <div class="menu-item">
            <a href="index.html">Sewa Mobil</a>
        </div>
        
        <div class="menu-item">
            <a href="sopir.html">Sewa dengan Sopir</a>
        </div>
        
        <div class="menu-item">
            <a href="#">Antar-Jemput</a>
        </div>
        
        <div class="menu-item">
            <a href="#">Sewa Jangka Panjang</a>
        </div>
    </div>

                </div>
                <div class="footer-column">
                    <h3>Kontak</h3>
                    <ul>
                        <li>Jl. Raya Utama No. 123, Jakarta</li>
                        <li>info@autorent.com</li>
                        <li>+62 21 5678 9012</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 AutoRent. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Login Modal -->
    <div class="modal" id="loginModal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 class="form-title">Masuk ke Akun Anda</h2>
            <form class="auth-form" id="loginForm">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" required>
                </div>
                <button type="submit" class="btn">Masuk</button>
                <div class="form-footer">
                    <p>Belum punya akun? <a href="#" id="showRegister">Daftar di sini</a></p>
                </div>
            </form>
        </div>
    </div>

    <!-- Register Modal -->
    <div class="modal" id="registerModal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2 class="form-title">Daftar Akun Baru</h2>
            <form class="auth-form" id="registerForm">
                <div class="form-group">
                    <label for="reg-name">Nama Lengkap</label>
                    <input type="text" id="reg-name" required>
                </div>
                <div class="form-group">
                    <label for="reg-email">Email</label>
                    <input type="email" id="reg-email" required>
                </div>
                <div class="form-group">
                    <label for="reg-phone">Nomor Telepon</label>
                    <input type="tel" id="reg-phone" required>
                </div>
                <div class="form-group">
                    <label for="reg-password">Password</label>
                    <input type="password" id="reg-password" required>
                </div>
                <div class="form-group">
                    <label for="reg-confirm-password">Konfirmasi Password</label>
                    <input type="password" id="reg-confirm-password" required>
                </div>
                <button type="submit" class="btn">Daftar</button>
                <div class="form-footer">
                    <p>Sudah punya akun? <a href="#" id="showLogin">Masuk di sini</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="scripts.js"></script>
</body>
</html>

