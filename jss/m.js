document.addEventListener('DOMContentLoaded', function() {
    // Kode yang sudah ada sebelumnya bisa ditambahkan di sini
    const loginBtn = document.getElementById('loginBtn');
const loginModal = document.getElementById('loginModal');
const registerModal = document.getElementById('registerModal');
const closeButtons = document.querySelectorAll('.close');
const showRegister = document.getElementById('showRegister');
const showLogin = document.getElementById('showLogin');

// Tampilkan login
loginBtn.onclick = () => {
    loginModal.style.display = 'block';
};

// Tutup modal
closeButtons.forEach(btn => {
    btn.onclick = () => {
        loginModal.style.display = 'none';
        registerModal.style.display = 'none';
    };
});

// Tampilkan daftar dari login
showRegister.onclick = (e) => {
    e.preventDefault();
    loginModal.style.display = 'none';
    registerModal.style.display = 'block';
};

// Tampilkan login dari daftar
showLogin.onclick = (e) => {
    e.preventDefault();
    registerModal.style.display = 'none';
    loginModal.style.display = 'block';
};

// Tutup modal ketika klik luar
window.onclick = (e) => {
    if (e.target === loginModal) loginModal.style.display = 'none';
    if (e.target === registerModal) registerModal.style.display = 'none';
};

    // Script untuk slider dengan 5 gambar
    function createImageSlider() {
        // Data untuk 5 gambar slider
        const sliderImages = [
            {
                imgSrc: 'images/slider1.jpg',
                title: 'Mobil Terbaik untuk Perjalanan Anda',
                description: 'Rasakan kenyamanan berkendara dengan armada terbaru kami'
            },
            {
                imgSrc: 'images/slider2.jpg',
                title: 'Harga Terjangkau',
                description: 'Nikmati harga spesial untuk pengalaman berkendara premium'
            },
            {
                imgSrc: 'images/slider3.jpg',
                title: 'Layanan 24/7',
                description: 'Siap melayani kebutuhan transportasi Anda kapanpun'
            },
            {
                imgSrc: 'images/slider4.jpg',
                title: 'Promo Liburan',
                description: 'Dapatkan diskon hingga 25% untuk pemesanan liburan'
            },
            {
                imgSrc: 'images/slider5.jpg',
                title: 'Mobil Mewah',
                description: 'Koleksi mobil mewah untuk acara spesial Anda'
            }
        ];
        
        // Membuat container untuk slider
        const sliderContainer = document.createElement('div');
        sliderContainer.className = 'slider-container';
        
        // Membuat elemen slider
        const slider = document.createElement('div');
        slider.className = 'slider';
        
        // Membuat slides
        sliderImages.forEach((image, index) => {
            const slide = document.createElement('div');
            slide.className = 'slide';
            if (index === 0) {
                slide.classList.add('active');
            }
            
            const img = document.createElement('img');
            img.src = image.imgSrc;
            img.alt = image.title;
            
            const content = document.createElement('div');
            content.className = 'slide-content';
            
            const title = document.createElement('h2');
            title.textContent = image.title;
            
            const desc = document.createElement('p');
            desc.textContent = image.description;
            
            const button = document.createElement('button');
            button.className = 'btn slider-btn';
            button.textContent = 'Lihat Detail';
            
            content.appendChild(title);
            content.appendChild(desc);
            content.appendChild(button);
            
            slide.appendChild(img);
            slide.appendChild(content);
            slider.appendChild(slide);
        });
        
        // Menambahkan kontrol navigasi
        const prevBtn = document.createElement('button');
        prevBtn.className = 'slider-nav prev';
        prevBtn.innerHTML = '&#10094;';
        
        const nextBtn = document.createElement('button');
        nextBtn.className = 'slider-nav next';
        nextBtn.innerHTML = '&#10095;';
        
        // Menambahkan indikator
        const indicators = document.createElement('div');
        indicators.className = 'slider-indicators';
        
        sliderImages.forEach((_, index) => {
            const dot = document.createElement('span');
            dot.className = 'indicator';
            if (index === 0) {
                dot.classList.add('active');
            }
            dot.dataset.index = index;
            indicators.appendChild(dot);
        });
        
        // Menggabungkan semuanya
        sliderContainer.appendChild(slider);
        sliderContainer.appendChild(prevBtn);
        sliderContainer.appendChild(nextBtn);
        sliderContainer.appendChild(indicators);
        
        // Memasukkan slider ke dalam DOM setelah header
        const header = document.querySelector('header');
        header.after(sliderContainer);
        
        // Menambahkan fungsionalitas slider
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.indicator');
        
        function showSlide(n) {
            // Reset
            slides.forEach(slide => slide.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));
            
            // Update current
            currentSlide = (n + slides.length) % slides.length;
            slides[currentSlide].classList.add('active');
            dots[currentSlide].classList.add('active');
        }
        
        // Event listeners
        nextBtn.addEventListener('click', () => {
            showSlide(currentSlide + 1);
        });
        
        prevBtn.addEventListener('click', () => {
            showSlide(currentSlide - 1);
        });
        
        // Indikator dot click
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                showSlide(index);
            });
        });
        
        // Auto slide
        setInterval(() => {
            showSlide(currentSlide + 1);
        }, 5000);
    }
    
    // Jalankan fungsi slider
    createImageSlider();
    
    // Kode tambahan jika diperlukan
});


