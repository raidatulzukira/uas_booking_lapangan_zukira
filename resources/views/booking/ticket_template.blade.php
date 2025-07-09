<!DOCTYPE html>
<html lang="id">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>E-Tiket Booking #{{ $booking->id }}</title>
    <style>
        /* Menggunakan font dasar yang umum tersedia */
        body {
            font-family: 'Helvetica Neue', 'Helvetica', 'Arial', sans-serif;
            background-color: #f7fafc;
            color: #1a202c;
            margin: 0;
            padding: 20px;
        }
        .ticket-container {
            background-color: #ffffff;
            border-radius: 15px;
            padding: 30px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 120px;
            display: block;
        }
        .header-title {
            margin-left: 20px;
            flex: 1;
        }
        .header-title h1 {
            font-size: 22px;
            font-weight: bold;
            color: #2d3748;
            margin: 0;
            line-height: 1.3;
        }
        .header-title .transaction-id {
            font-size: 14px;
            color: #718096;
            margin-top: 5px;
        }
        .intro p {
            font-size: 16px;
            color: #4a5568;
            line-height: 1.6;
            margin-bottom: 15px;
        }
        .user-booking-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
            margin: 25px 0;
            border: 1px solid #e2e8f0;
        }
        .user-section {
            display: flex;
            align-items: center;
        }
        .user-section img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 15px;
            object-fit: cover;
            border: 2px solid #e2e8f0;
        }
        .user-section .name {
            font-weight: bold;
            font-size: 16px;
            color: #2d3748;
        }
        .user-section .role {
            font-size: 12px;
            color: #718096;
        }
        .price-section {
            text-align: right;
        }
        .price-label {
            font-size: 12px;
            color: #718096;
            margin-bottom: 2px;
        }
        .price-amount {
            font-size: 20px;
            font-weight: bold;
            color: #38a169;
        }
        .booking-details h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #2d3748;
        }
        .booking-details .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
            font-size: 15px;
            padding: 10px 0;
        }
        .booking-details .info-item .icon {
            width: 25px;
            margin-right: 15px;
            text-align: center;
            font-size: 18px;
        }
        .booking-details .info-item .text {
            color: #4a5568;
            line-height: 1.5;
        }
        .booking-details .info-item .label {
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 3px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
            font-size: 14px;
            color: #718096;
            font-style: italic;
        }
        .price-breakdown {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin: 15px 0;
            border: 1px solid #e2e8f0;
        }
        .price-breakdown .breakdown-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 14px;
        }
        .price-breakdown .breakdown-item.total {
            border-top: 1px solid #e2e8f0;
            padding-top: 8px;
            margin-top: 8px;
            font-weight: bold;
            font-size: 16px;
        }
        .price-breakdown .breakdown-label {
            color: #4a5568;
        }
        .price-breakdown .breakdown-value {
            color: #2d3748;
            font-weight: 500;
        }
        .price-breakdown .breakdown-item.total .breakdown-value {
            color: #38a169;
        }
    </style>
</head>
<body>
    @php
        // Mengubah path gambar menjadi Base64 agar pasti ter-render di PDF
        $logoPath = public_path('images/logo.png');
        $userPhotoPath = public_path('images/user.png'); // Foto default jika user tidak punya foto

        // Pastikan file ada sebelum dibaca
        $logoData = file_exists($logoPath) ? base64_encode(file_get_contents($logoPath)) : '';
        $userPhotoData = file_exists($userPhotoPath) ? base64_encode(file_get_contents($userPhotoPath)) : '';
    @endphp

    <div class="ticket-container">
        <div class="header">
            @if ($logoData)
                <img src="data:image/png;base64,{{ $logoData }}" alt="Logo">
            @endif
            <div class="header-title">
                <h1>Yeey, anda berhasil membeli tiket booking lapangan!</h1>
                <div class="transaction-id">
                    Booking ID : <strong>#{{ $booking->id }}</strong>
                </div>
            </div>
        </div>

        <div class="intro">
            <p>
                Anda berhasil membeli tiket pembookingan lapangannya jangan sampai lupa ya
            </p>
        </div>

        <div class="booking-details">
            <h2>{{ $booking->lapangan->nama }}</h2>
            
            <div class="info-item">
                <div class="text">
                    <div class="label">Tanggal & Waktu</div>
                    {{ \Carbon\Carbon::parse($booking->tanggal)->isoFormat('dddd, D MMMM YYYY') }}<br>
                    {{ \Carbon\Carbon::parse($booking->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->jam_selesai)->format('H:i') }}
                    <div class="text">
                    <div class="label">Durasi Booking</div>
                    {{ $booking->duration_in_hours }} jam
                </div>
                </div>
            </div>
            
            <div class="info-item">
                <div class="text">
                    <div class="label">Alamat Lapangan</div>
                    {{ $booking->lapangan->lokasi ?? 'Lokasi Lapangan Belum Tersedia' }}
                </div>
            </div>
            
        </div>

        <div class="price-breakdown">
            <div class="breakdown-item">
                <span class="breakdown-label">Harga per jam</span>
                <span class="breakdown-value">Rp {{ number_format($booking->lapangan->harga, 0, ',', '.') }}</span>
            </div>
            <div class="breakdown-item">
                <span class="breakdown-label">Subtotal ({{ $booking->duration_in_hours }} jam)</span>
                <span class="breakdown-value">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
            </div>
            <div class="breakdown-item">
                <span class="breakdown-label">Biaya Admin</span>
                <span class="breakdown-value">Rp {{ number_format($booking->admin_fee, 0, ',', '.') }}</span>
            </div>
            <div class="breakdown-item">
                <span class="breakdown-label">Pajak (11%)</span>
                <span class="breakdown-value">Rp {{ number_format($booking->tax, 0, ',', '.') }}</span>
            </div>
            <div class="breakdown-item total">
                <span class="breakdown-label">Total Pembayaran</span>
                <span class="breakdown-value">Rp {{ number_format($booking->final_total, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="footer">
            Harap tunjukkan tiket ini kepada petugas di lapangan.<br>
            Terima kasih telah mempercayai layanan kami!
        </div>
    </div>
</body>
</html>