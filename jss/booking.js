// Booking Process Script for RentCar Website
document.addEventListener('DOMContentLoaded', function() {
    // Get all "Sewa Sekarang" buttons
    const rentNowButtons = document.querySelectorAll('.rent-now-btn');
    
    // Add click event listener to each button
    rentNowButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Get car ID from the button's href attribute
            const carId = this.getAttribute('href').split('=')[1];
            
            // Open the booking modal
            openBookingModal(carId);
        });
    });
    
    // Function to create and open booking modal
    function openBookingModal(carId) {
        // First, check if user is logged in
        const isLoggedIn = checkUserLoginStatus();
        
        if (!isLoggedIn) {
            // If not logged in, save the car ID in session storage and redirect to login page
            sessionStorage.setItem('pendingBookingCarId', carId);
            window.location.href = 'login.html?redirect=booking';
            return;
        }
        
        // Find car data based on ID
        const selectedCar = findCarById(carId);
        
        if (!selectedCar) {
            alert('Mobil tidak ditemukan. Silakan coba lagi.');
            return;
        }
        
        // Create modal element
        createBookingModal(selectedCar);
    }
    
    // Function to check if user is logged in (mock for demonstration)
    function checkUserLoginStatus() {
        // In a real application, this would check session/cookies or call an API
        // For demo purposes, we'll assume user is not logged in
        return false;
    }
    
    // Function to find car data by ID
    function findCarById(carId) {
        // In a real application, this would fetch from your cars array or database
        // Using the cars array from your existing script
        return cars.find(car => car.id == carId);
    }
    
    // Function to create booking modal
    function createBookingModal(car) {
        // Create modal overlay
        const modalOverlay = document.createElement('div');
        modalOverlay.id = 'booking-modal-overlay';
        modalOverlay.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        `;
        
        // Create modal content
        const modalContent = document.createElement('div');
        modalContent.id = 'booking-modal';
        modalContent.style.cssText = `
            background-color: white;
            width: 90%;
            max-width: 600px;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            position: relative;
            max-height: 90vh;
            overflow-y: auto;
        `;
        
        // Close button
        const closeButton = document.createElement('button');
        closeButton.innerHTML = '&times;';
        closeButton.style.cssText = `
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #666;
        `;
        closeButton.addEventListener('click', () => {
            document.body.removeChild(modalOverlay);
        });
        
        // Modal header
        const modalHeader = document.createElement('div');
        modalHeader.style.cssText = `
            border-bottom: 1px solid #eee;
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
        `;
        
        const modalTitle = document.createElement('h2');
        modalTitle.textContent = 'Booking ' + car.name;
        modalTitle.style.cssText = `
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        `;
        
        // Car Info Section
        const carInfo = document.createElement('div');
        carInfo.style.cssText = `
            display: flex;
            margin-bottom: 1.5rem;
            align-items: center;
            background-color: #f8f9fa;
            padding: 1rem;
            border-radius: 5px;
        `;
        
        const carImage = document.createElement('div');
        carImage.style.cssText = `
            width: 120px;
            height: 90px;
            overflow: hidden;
            margin-right: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
        `;
        
        const imgElement = document.createElement('img');
        imgElement.src = car.image;
        imgElement.alt = car.name;
        imgElement.style.cssText = `
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        `;
        
        const carDetails = document.createElement('div');
        carDetails.innerHTML = `
            <h4 style="margin: 0 0 0.5rem 0;">${car.name}</h4>
            <p style="margin: 0; color: #666;">Jenis: ${car.type.toUpperCase()}</p>
            <p style="margin: 0; color: #ff6b35; font-weight: bold;">Harga Sewa: ${car.price.replace('Rp', 'Rp ').replace('.000.000', '.000') + ' / hari'}</p>
        `;
        
        // Booking Form
        const bookingForm = document.createElement('form');
        bookingForm.id = 'booking-form';
        bookingForm.innerHTML = `
            <div style="margin-bottom: 1rem;">
                <label for="pickup-location" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Lokasi Pengambilan</label>
                <select id="pickup-location" name="pickup-location" required style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 5px; outline: none;">
                    <option value="">Pilih Lokasi</option>
                    <option value="jakarta">Jakarta</option>
                    <option value="surabaya">Surabaya</option>
                    <option value="bandung">Bandung</option>
                    <option value="yogyakarta">Yogyakarta</option>
                    <option value="bali">Bali</option>
                </select>
            </div>
            
            <div style="margin-bottom: 1rem;">
                <label for="pickup-date" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Tanggal Pengambilan</label>
                <input type="date" id="pickup-date" name="pickup-date" required style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 5px; outline: none;">
            </div>
            
            <div style="margin-bottom: 1rem;">
                <label for="return-date" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Tanggal Pengembalian</label>
                <input type="date" id="return-date" name="return-date" required style="width: 100%; padding: 0.8rem; border: 1px solid #ddd; border-radius: 5px; outline: none;">
            </div>
            
            <div style="margin-bottom: 1rem;">
                <label for="with-driver" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Opsi Tambahan</label>
                <div style="display: flex; align-items: center;">
                    <input type="checkbox" id="with-driver" name="with-driver" style="margin-right: 0.5rem;">
                    <label for="with-driver">Sewa dengan Sopir (+ Rp 150.000/hari)</label>
                </div>
            </div>
            
            <div style="margin-bottom: 1rem;" id="summary-container">
                <h4 style="margin-bottom: 1rem; border-bottom: 1px solid #eee; padding-bottom: 0.5rem;">Ringkasan Biaya</h4>
                <div id="booking-summary" style="background-color: #f8f9fa; padding: 1rem; border-radius: 5px;">
                    <p>Silakan lengkapi tanggal untuk melihat ringkasan biaya</p>
                </div>
            </div>
            
            <button type="submit" style="width: 100%; background-color: var(--primary-color); color: white; border: none; padding: 1rem; border-radius: 5px; cursor: pointer; font-weight: 600; transition: all 0.3s ease;">Lanjutkan ke Pembayaran</button>
        `;
        
        // Append elements to modal
        carImage.appendChild(imgElement);
        carInfo.appendChild(carImage);
        carInfo.appendChild(carDetails);
        
        modalHeader.appendChild(modalTitle);
        modalContent.appendChild(closeButton);
        modalContent.appendChild(modalHeader);
        modalContent.appendChild(carInfo);
        modalContent.appendChild(bookingForm);
        
        modalOverlay.appendChild(modalContent);
        document.body.appendChild(modalOverlay);
        
        // Initialize date pickers
        initializeBookingDatePickers();
        
        // Add event listeners for form fields to update summary
        setupBookingSummaryUpdate(car);
        
        // Form submission handler
        bookingForm.addEventListener('submit', function(e) {
            e.preventDefault();
            processBookingSubmission(car.id);
        });
    }
    
    // Function to initialize date pickers
    function initializeBookingDatePickers() {
        const today = new Date();
        const tomorrow = new Date(today);
        tomorrow.setDate(today.getDate() + 1);
        
        const pickupDateInput = document.getElementById('pickup-date');
        const returnDateInput = document.getElementById('return-date');
        
        // Format date to YYYY-MM-DD
        const formatDate = (date) => {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        };
        
        // Set minimum dates
        pickupDateInput.min = formatDate(today);
        pickupDateInput.value = formatDate(today);
        
        returnDateInput.min = formatDate(tomorrow);
        returnDateInput.value = formatDate(tomorrow);
        
        // Update return date when pickup date changes
        pickupDateInput.addEventListener('change', function() {
            const newPickupDate = new Date(this.value);
            const newMinReturnDate = new Date(newPickupDate);
            newMinReturnDate.setDate(newPickupDate.getDate() + 1);
            
            returnDateInput.min = formatDate(newMinReturnDate);
            
            if (new Date(returnDateInput.value) <= newPickupDate) {
                returnDateInput.value = formatDate(newMinReturnDate);
            }
        });
    }
    
    // Function to set up booking summary update
    function setupBookingSummaryUpdate(car) {
        const pickupDateInput = document.getElementById('pickup-date');
        const returnDateInput = document.getElementById('return-date');
        const withDriverCheckbox = document.getElementById('with-driver');
        const summaryContainer = document.getElementById('booking-summary');
        
        // Extract car price (daily rate)
        const priceText = car.price.replace('Rp', '').replace('.000.000', '');
        const dailyRate = parseInt(priceText) * 1000; // Convert to daily rate
        
        // Function to update summary
        const updateSummary = () => {
            if (!pickupDateInput.value || !returnDateInput.value) return;
            
            const pickupDate = new Date(pickupDateInput.value);
            const returnDate = new Date(returnDateInput.value);
            
            // Calculate number of days
            const timeDiff = returnDate.getTime() - pickupDate.getTime();
            const days = Math.ceil(timeDiff / (1000 * 3600 * 24));
            
            const withDriver = withDriverCheckbox.checked;
            const driverRate = 150000; // Rp 150.000/day
            
            // Calculate costs
            const rentalCost = dailyRate * days;
            const driverCost = withDriver ? driverRate * days : 0;
            const totalCost = rentalCost + driverCost;
            
            // Format numbers for display
            const formatCurrency = (amount) => {
                return 'Rp ' + amount.toLocaleString('id-ID');
            };
            
            // Update summary container
            summaryContainer.innerHTML = `
                <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                    <span>Harga Sewa (${days} hari)</span>
                    <span>${formatCurrency(rentalCost)}</span>
                </div>
                ${withDriver ? `
                <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                    <span>Biaya Sopir (${days} hari)</span>
                    <span>${formatCurrency(driverCost)}</span>
                </div>
                ` : ''}
                <div style="display: flex; justify-content: space-between; border-top: 1px solid #ddd; padding-top: 0.5rem; margin-top: 0.5rem; font-weight: 700;">
                    <span>Total</span>
                    <span>${formatCurrency(totalCost)}</span>
                </div>
            `;
        };
        
        // Add event listeners
        pickupDateInput.addEventListener('change', updateSummary);
        returnDateInput.addEventListener('change', updateSummary);
        withDriverCheckbox.addEventListener('change', updateSummary);
        
        // Initial update
        updateSummary();
    }
    
    // Function to process booking form submission
    function processBookingSubmission(carId) {
        // Get form data
        const location = document.getElementById('pickup-location').value;
        const pickupDate = document.getElementById('pickup-date').value;
        const returnDate = document.getElementById('return-date').value;
        const withDriver = document.getElementById('with-driver').checked;
        
        // Validate form data
        if (!location || !pickupDate || !returnDate) {
            alert('Mohon lengkapi semua data booking.');
            return;
        }
        
        // In a real application, you would send this data to your server
        // For demo purposes, we'll store it in sessionStorage and redirect to a payment page
        const bookingData = {
            carId: carId,
            location: location,
            pickupDate: pickupDate,
            returnDate: returnDate,
            withDriver: withDriver
        };
        
        sessionStorage.setItem('currentBooking', JSON.stringify(bookingData));
        
        // Redirect to payment page
        window.location.href = 'payment.php';
    }
});

      // Smooth scroll untuk link 'Sewa Sekarang'
document.querySelector('.cta-btn').addEventListener('click', function(e) {
    e.preventDefault();
    const targetId = this.getAttribute('href');
    const target = document.querySelector(targetId);
    if (target) {
        window.scrollTo({
            top: target.offsetTop,
            behavior: 'smooth'
        });
    }
});