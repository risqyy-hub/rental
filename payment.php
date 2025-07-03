<?php
// Start session to access booking data
session_start();

// In a real application, you would retrieve booking data from your database
// For demo purposes, we'll use data from JavaScript's sessionStorage via cookie or form submission

// Simulated booking data (in a real application, this would come from your database)
$bookingData = null;

// Check if booking data was submitted via POST
if (isset($_POST['bookingData'])) {
    $bookingData = json_decode($_POST['bookingData'], true);
} 
// If not, we'll create some sample data for demonstration
else {
    // Default/sample booking data for display purposes
    $bookingData = [
        'carId' => 1,
        'carName' => 'Toyota Avanza',
        'carType' => 'MPV',
        'dailyRate' => 350000,
        'location' => 'Jakarta',
        'pickupDate' => date('Y-m-d'),
        'returnDate' => date('Y-m-d', strtotime('+3 days')),
        'withDriver' => true,
        'driverRate' => 15000
    ];
}

// Calculate rental duration
$pickupDate = new DateTime($bookingData['pickupDate']);
$returnDate = new DateTime($bookingData['returnDate']);
$interval = $pickupDate->diff($returnDate);
$days = $interval->days;

// If 0 days, make it 1 day minimum
if ($days < 1) $days = 1;

// Calculate costs
$rentalCost = $bookingData['dailyRate'] * $days;
$driverCost = $bookingData['withDriver'] ? $bookingData['driverRate'] * $days : 0;
$subtotal = $rentalCost + $driverCost;

// Add tax (10%)
$tax = $subtotal * 0.1;
$total = $subtotal + $tax;

// Function to format currency in Indonesian Rupiah
function formatRupiah($amount) {
    return 'Rp ' . number_format($amount, 0, ',', '.');
}

// Generate a unique booking reference
$bookingReference = 'RC' . date('Ymd') . rand(1000, 9999);

// Check if payment was processed (after form submission)
$paymentProcessed = isset($_POST['process_payment']) && $_POST['process_payment'] == 1;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran - RentCar</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Variabel CSS */
        :root {
            --primary-color: #ff6b35;
            --secondary-color: #2ec4b6;
            --dark-color: #293241;
            --light-color: #e0fbfc;
            --accent-color: #ee964b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f8f9fa;
            color: var(--dark-color);
        }

        /* Header Styles */
        header {
            background-color: var(--dark-color);
            color: white;
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 0;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
        }

        .logo span {
            color: var(--primary-color);
        }

        /* Breadcrumbs */
        .breadcrumbs {
            padding: 1rem 0;
            background-color: white;
            border-bottom: 1px solid #eee;
        }

        .breadcrumbs ul {
            display: flex;
            list-style: none;
        }

        .breadcrumbs ul li {
            margin-right: 0.5rem;
        }

        .breadcrumbs ul li:after {
            content: '/';
            margin-left: 0.5rem;
            color: #ccc;
        }

        .breadcrumbs ul li:last-child:after {
            content: '';
        }

        .breadcrumbs ul li a {
            color: #666;
            text-decoration: none;
        }

        .breadcrumbs ul li.active {
            color: var(--primary-color);
            font-weight: 500;
        }

        /* Payment Section Styles */
        .payment-section {
            margin: 2rem 0;
        }

        .page-title {
            margin-bottom: 2rem;
            font-size: 1.8rem;
            color: var(--dark-color);
        }

        .payment-container {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
        }

        @media (max-width: 768px) {
            .payment-container {
                grid-template-columns: 1fr;
            }
        }

        .payment-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .card-title {
            font-size: 1.2rem;
            color: var(--dark-color);
            margin-bottom: 1.5rem;
            padding-bottom: 0.8rem;
            border-bottom: 1px solid #eee;
        }

        /* Booking Summary Styles */
        .summary-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .summary-item.total {
            font-weight: 700;
            font-size: 1.2rem;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #eee;
        }

        .car-details {
            display: flex;
            margin-bottom: 1.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #eee;
        }

        .car-image {
            width: 120px;
            height: 90px;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            border-radius: 5px;
            overflow: hidden;
        }

        .car-image img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        .car-info h3 {
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }

        .car-info p {
            color: #666;
            font-size: 0.9rem;
        }

        /* Payment Method Styles */
        .payment-methods {
            margin-bottom: 2rem;
        }

        .payment-method {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 1rem;
            margin-bottom: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .payment-method:hover {
            border-color: var(--primary-color);
        }

        .payment-method.selected {
            border-color: var(--primary-color);
            background-color: rgba(255, 107, 53, 0.05);
        }

        .payment-method-header {
            display: flex;
            align-items: center;
        }

        .payment-method-radio {
            margin-right: 1rem;
        }

        .payment-logo {
            width: 60px;
            height: 30px;
            object-fit: contain;
            margin-right: 1rem;
        }

        .payment-method-title {
            font-weight: 500;
        }

        .payment-method-body {
            padding-top: 1rem;
            margin-top: 1rem;
            border-top: 1px solid #eee;
            display: none;
        }

        .payment-method.selected .payment-method-body {
            display: block;
        }

        /* Form Styles */
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(255, 107, 53, 0.25);
        }

        .card-inputs {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        /* Button Styles */
        .btn {
            display: inline-block;
            padding: 0.8rem 1.5rem;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            text-align: center;
            font-size: 1rem;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: #ff5722;
            transform: translateY(-2px);
        }

        .btn-outline {
            background-color: transparent;
            color: var(--dark-color);
            border: 1px solid #ddd;
        }

        .btn-outline:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .btn-block {
            display: block;
            width: 100%;
        }

        /* Success Message */
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 1.5rem;
            border-radius: 5px;
            margin-bottom: 2rem;
            text-align: center;
        }

        .success-icon {
            font-size: 3rem;
            color: #28a745;
            margin-bottom: 1rem;
        }

        .booking-reference {
            background-color: #f8f9fa;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            font-weight: 700;
            margin: 1rem 0;
            display: inline-block;
        }

        /* Footer */
        footer {
            background-color: var(--dark-color);
            color: white;
            padding: 2rem 0;
            margin-top: 3rem;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container header-container">
            <a href="index.php" class="logo">Rent<span>Car</span></a>
        </div>
    </header>

    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <ul>
                <li><a href="index.php">Beranda</a></li>
                <li><a href="mobil.php">Mobil</a></li>
                <li class="active">Pembayaran</li>
            </ul>
        </div>
    </div>

    <!-- Payment Section -->
    <section class="payment-section">
        <div class="container">
            <?php if ($paymentProcessed): ?>
                <!-- Payment Success Message -->
                <div class="success-message">
                    <div class="success-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h2>Pembayaran Berhasil!</h2>
                    <p>Terima kasih telah melakukan pemesanan. Detail reservasi telah dikirim ke email Anda.</p>
                    <div class="booking-reference">
                        Nomor Referensi: <?php echo $bookingReference; ?>
                    </div>
                    <p>Simpan nomor referensi ini untuk keperluan lebih lanjut.</p>
                    <a href="index.php" class="btn btn-primary" style="margin-top: 1rem;">Kembali ke Beranda</a>
                </div>
            <?php else: ?>
                <h1 class="page-title">Pembayaran</h1>
                
                <div class="payment-container">
                    <!-- Payment Methods -->
                    <div class="payment-left">
                        <form action="payment.php" method="post" id="payment-form">
                            <input type="hidden" name="process_payment" value="1">
                            
                            <div class="payment-card">
                                <h2 class="card-title">Pilih Metode Pembayaran</h2>
                                
                                <div class="payment-methods">
                                    <!-- Credit/Debit Card Payment Method -->
                                    <div class="payment-method selected" data-method="credit-card">
                                        <div class="payment-method-header">
                                            <input type="radio" name="payment_method" value="credit-card" class="payment-method-radio" checked>
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a4/Mastercard_2019_logo.svg/800px-Mastercard_2019_logo.svg.png" alt="Credit Card" class="payment-logo">
                                            <span class="payment-method-title">Kartu Kredit / Debit</span>
                                        </div>
                                        <div class="payment-method-body">
                                            <div class="form-group">
                                                <label for="card-number" class="form-label">Nomor Kartu</label>
                                                <input type="text" id="card-number" name="card_number" class="form-control" placeholder="1234 5678 9012 3456" maxlength="19">
                                            </div>
                                            <div class="card-inputs">
                                                <div class="form-group">
                                                    <label for="expiry-date" class="form-label">Tanggal Kadaluarsa</label>
                                                    <input type="text" id="expiry-date" name="expiry_date" class="form-control" placeholder="MM/YY" maxlength="5">
                                                </div>
                                                <div class="form-group">
                                                    <label for="cvv" class="form-label">CVV</label>
                                                    <input type="text" id="cvv" name="cvv" class="form-control" placeholder="123" maxlength="3">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="card-name" class="form-label">Nama Pada Kartu</label>
                                                <input type="text" id="card-name" name="card_name" class="form-control" placeholder="Nama Lengkap">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Bank Transfer Payment Method -->
                                    <div class="payment-method" data-method="bank-transfer">
                                        <div class="payment-method-header">
                                            <input type="radio" name="payment_method" value="bank-transfer" class="payment-method-radio">
                                            <img src="https://upload.wikimedia.org/wikipedia/id/thumb/5/55/BNI_logo.svg/1200px-BNI_logo.svg.png" alt="Bank Transfer" class="payment-logo">
                                            <span class="payment-method-title">Transfer Bank</span>
                                        </div>
                                        <div class="payment-method-body">
                                            <p>Silakan transfer ke rekening berikut:</p>
                                            <div style="background-color: #f8f9fa; padding: 1rem; border-radius: 5px; margin: 1rem 0;">
                                                <p><strong>Bank BNI</strong></p>
                                                <p>No. Rekening: 0123456789</p>
                                                <p>Atas Nama: PT RentCar Indonesia</p>
                                            </div>
                                            <p>Konfirmasi pembayaran akan diproses dalam 1x24 jam setelah pembayaran berhasil.</p>
                                        </div>
                                    </div>
                                    
                                    <!-- E-Wallet Payment Method -->
                                    <div class="payment-method" data-method="e-wallet">
                                        <div class="payment-method-header">
                                            <input type="radio" name="payment_method" value="e-wallet" class="payment-method-radio">
                                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/72/Logo_dana_blue.svg/2560px-Logo_dana_blue.svg.png" alt="E-Wallet" class="payment-logo">
                                            <span class="payment-method-title">E-Wallet (DANA, OVO, GoPay)</span>
                                        </div>
                                        <div class="payment-method-body">
                                            <p>Pilih e-wallet yang ingin Anda gunakan:</p>
                                            <div class="form-group">
                                                <select name="e_wallet_provider" class="form-control">
                                                    <option value="dana">DANA</option>
                                                    <option value="ovo">OVO</option>
                                                    <option value="gopay">GoPay</option>
                                                </select>
                                            </div>
                                            <p>Anda akan diarahkan ke aplikasi e-wallet untuk menyelesaikan pembayaran.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="payment-card">
                                <h2 class="card-title">Informasi Pemesan</h2>
                                <div class="form-group">
                                    <label for="customer-name" class="form-label">Nama Lengkap</label>
                                    <input type="text" id="customer-name" name="customer_name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="customer-email" class="form-label">Email</label>
                                    <input type="email" id="customer-email" name="customer_email" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="customer-phone" class="form-label">Nomor Telepon</label>
                                    <input type="tel" id="customer-phone" name="customer_phone" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="customer-address" class="form-label">Alamat</label>
                                    <textarea id="customer-address" name="customer_address" class="form-control" rows="3" required></textarea>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary btn-block">Bayar Sekarang</button>
                        </form>
                    </div>
                    
                    <!-- Order Summary -->
                    <div class="payment-right">
                        <div class="payment-card">
                            <h2 class="card-title">Ringkasan Pesanan</h2>
                            
                            <div class="car-details">
                                <div class="car-image">
                                    <img src="jm/toyota/avanza.png" alt="<?php echo $bookingData['carName']; ?>">
                                </div>
                                <div class="car-info">
                                    <h3><?php echo $bookingData['carName']; ?></h3>
                                    <p><i class="fas fa-map-marker-alt"></i> <?php echo $bookingData['location']; ?></p>
                                    <p><i class="fas fa-calendar"></i> <?php echo date('d M Y', strtotime($bookingData['pickupDate'])); ?> - <?php echo date('d M Y', strtotime($bookingData['returnDate'])); ?></p>
                                </div>
                            </div>
                            
                            <div class="summary-details">
                                <div class="summary-item">
                                    <span>Harga Sewa (<?php echo $days; ?> hari)</span>
                                    <span><?php echo formatRupiah($rentalCost); ?></span>
                                </div>
                                
                                <?php if ($bookingData['withDriver']): ?>
                                <div class="summary-item">
                                    <span>Biaya Sopir (<?php echo $days; ?> hari)</span>
                                    <span><?php echo formatRupiah($driverCost); ?></span>
                                </div>
                                <?php endif; ?>
                                
                                <div class="summary-item">
                                    <span>Subtotal</span>
                                    <span><?php echo formatRupiah($subtotal); ?></span>
                                </div>
                                
                                <div class="summary-item">
                                    <span>Pajak (10%)</span>
                                    <span><?php echo formatRupiah($tax); ?></span>
                                </div>
                                
                                <div class="summary-item total">
                                    <span>Total</span>
                                    <span><?php echo formatRupiah($total); ?></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="payment-card">
                            <h2 class="card-title">Ketentuan Sewa</h2>
                            <ul style="margin-left: 1.5rem; color: #666;">
                                <li>KTP dan SIM A masih berlaku</li>
                                <li>Deposit sebesar Rp 1.000.000</li>
                                <li>Pembayaran penuh dilakukan saat pengambilan mobil</li>
                                <li>Pembatalan 24 jam sebelum dikenakan biaya 50%</li>
                                <li>Keterlambatan pengembalian dikenakan biaya tambahan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-bottom">
                <p>&copy; 2025 RentCar. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Payment method selection
        document.addEventListener('DOMContentLoaded', function() {
            const paymentMethods = document.querySelectorAll('.payment-method');
            
            paymentMethods.forEach(method => {
                method.addEventListener('click', function() {
                    // Remove selected class from all methods
                    paymentMethods.forEach(m => m.classList.remove('selected'));
                    
                    // Add selected class to clicked method
                    this.classList.add('selected');
                    
                    // Select the radio button
                    const radio = this.querySelector('.payment-method-radio');
                    radio.checked = true;
                });
            });
            
            // Format credit card number with spaces
            const cardNumberInput = document.getElementById('card-number');
            if (cardNumberInput) {
                cardNumberInput.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\s+/g, '');
                    if (value.length > 0) {
                        value = value.match(new RegExp('.{1,4}', 'g')).join(' ');
                    }
                    e.target.value = value;
                });
            }
            
            // Format expiry date
            const expiryDateInput = document.getElementById('expiry-date');
            if (expiryDateInput) {
                expiryDateInput.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\D/g, '');
                    if (value.length > 2) {
                        value = value.slice(0, 2) + '/' + value.slice(2, 4);
                    }
                    e.target.value = value;
                });
            }
            
            // Basic form validation
            const paymentForm = document.getElementById('payment-form');
            if (paymentForm) {
                paymentForm.addEventListener('submit', function(e) {
                    const selectedMethod = document.querySelector('.payment-method.selected');
                    const methodType = selectedMethod.getAttribute('data-method');
                    
                    if (methodType === 'credit-card') {
                        const cardNumber = document.getElementById('card-number').value.replace(/\s+/g, '');
                        const cardName = document.getElementById('card-name').value;
                        const expiryDate = document.getElementById('expiry-date').value;
                        const cvv = document.getElementById('cvv').value;
                        
                        if (cardNumber.length < 16) {
                            alert('Silakan masukkan nomor kartu yang valid.');
                            e.preventDefault();
                            return;
                        }
                        
                        if (!cardName) {
                            alert('Silakan masukkan nama pada kartu.');
                            e.preventDefault();
                            return;
                        }
                        
                        if (expiryDate.length < 5) {
                            alert('Silakan masukkan tanggal kadaluarsa yang valid.');
                            e.preventDefault();
                            return;
                        }
                        
                        if (cvv.length < 3) {
                            alert('Silakan masukkan CVV yang valid.');
                            e.preventDefault();
                            return;
                        }
                    }
                    
                    // For demo purposes, we're allowing all submissions to go through
                    // In a real application, you would validate further and process the payment
                });
            }
        });
    </script>
</body>
</html>