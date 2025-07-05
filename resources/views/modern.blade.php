{{-- File: resources/views/layouts/modern.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pemesanan</title>
    
    {{-- Memuat Tailwind & Font Awesome dari CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb; /* Warna abu-abu muda khas tailwind */
        }
    </style>
</head>
<body class="antialiased">

    <main>
        {{-- Di sini konten dari detail.blade.php akan ditampilkan --}}
        @yield('content')
    </main>

</body>
</html>