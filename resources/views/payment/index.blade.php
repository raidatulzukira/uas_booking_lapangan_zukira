@extends('layouts.tailwind')

@section('title', 'Pembayaran - Booking #' . $booking->id)

@section('content')
<div class="min-h-screen bg-gradient-to-br from-rose-50 via-pink-50 to-purple-50 py-12 px-4">
    <div class="max-w-2xl mx-auto">
        <!-- Payment Card -->
        <div class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/20 overflow-hidden">
            
            <!-- Header -->
            <div class="bg-gradient-to-r from-pink-400 to-rose-400 px-8 py-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold">Pembayaran</h1>
                        <p class="text-pink-100 text-sm">Booking ID: #{{ $booking->id }}</p>
                    </div>
                    <div class="text-right">
                        <div class="text-xs text-pink-100 uppercase tracking-wide">Status</div>
                        @if(isset($payment) && $payment)
                            @if($payment->status_verifikasi == 'pending')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    Menunggu Verifikasi
                                </span>
                            @elseif($payment->status_verifikasi == 'approved')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Disetujui
                                </span>
                            @elseif($payment->status_verifikasi == 'rejected')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Ditolak
                                </span>
                            @endif
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                Belum Bayar
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="p-8">
                <!-- Payment Details -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        Rincian Pembayaran
                    </h2>
                    
                    <div class="bg-gray-50 rounded-xl p-6 space-y-4">
                        @php
                            $hargaSewa = $booking->harga ?? 500000; // Default jika tidak ada
                            $biayaAdmin = 2500;
                            $ppn = ($hargaSewa + $biayaAdmin) * 0.1;
                            $total = $hargaSewa + $biayaAdmin + $ppn;
                        @endphp
                        
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-700">Sewa Booking</span>
                            <span class="font-semibold text-gray-900">Rp {{ number_format($hargaSewa, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-t border-gray-200">
                            <span class="text-gray-700">Biaya Admin</span>
                            <span class="font-semibold text-gray-900">Rp {{ number_format($biayaAdmin, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-t border-gray-200">
                            <span class="text-gray-700">PPN (10%)</span>
                            <span class="font-semibold text-gray-900">Rp {{ number_format($ppn, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-3 border-t-2 border-pink-200 bg-pink-50 -mx-6 px-6 rounded-b-xl">
                            <span class="text-lg font-bold text-gray-800">Total Pembayaran</span>
                            <span class="text-xl font-bold text-pink-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Upload Form - Only show if payment not approved -->
                @if(!isset($payment) || $payment->status_verifikasi !== 'approved')
                <form action="{{ route('payment.upload', $booking->id) }}" method="POST" enctype="multipart/form-data" id="paymentForm">
                    @csrf
                    <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                    <input type="hidden" name="harga" value="{{ $total }}">
                    
                    <div class="mb-8">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            Upload Bukti Pembayaran
                        </h2>
                        
                        <div class="relative">
                            <input type="file" name="bukti_transfer" id="bukti_transfer" accept="image/*" class="hidden" required>
                            <div id="dropZone" class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-pink-400 hover:bg-pink-50 transition-all duration-300 cursor-pointer">
                                <div id="uploadArea">
                                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                    </svg>
                                    <p class="text-gray-600 mb-2">Drag & drop file gambar atau <span class="text-pink-600 font-semibold">klik untuk browse</span></p>
                                    <p class="text-sm text-gray-500">PNG, JPG, JPEG maksimal 2MB</p>
                                </div>
                                <div id="previewArea" class="hidden">
                                    <img id="previewImage" class="max-h-48 mx-auto rounded-lg shadow-lg" alt="Preview">
                                    <p class="text-sm text-gray-600 mt-2">Klik untuk mengganti file</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button type="submit" class="flex-1 bg-gradient-to-r from-pink-400 to-rose-400 hover:from-pink-500 hover:to-rose-500 text-white font-semibold py-3 px-6 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            Kirim Pembayaran
                        </button>
                        
                        <button type="button" onclick="checkPaymentStatus()" class="flex-1 bg-white hover:bg-gray-50 text-gray-700 font-semibold py-3 px-6 rounded-xl border-2 border-gray-200 hover:border-pink-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Cek Status Pembayaran
                        </button>
                    </div>
                </form>
                @else
                    <!-- Payment Approved Message -->
                    <div class="text-center py-8">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-green-800 mb-2">Pembayaran Disetujui!</h3>
                        <p class="text-green-600">Pembayaran Anda telah diverifikasi dan disetujui.</p>
                    </div>
                @endif

                <!-- Payment Info -->
                <div class="mt-8 bg-blue-50 rounded-xl p-6">
                    <h3 class="font-semibold text-blue-900 mb-2">Informasi Pembayaran</h3>
                    <div class="text-sm text-blue-800 space-y-1">
                        <p>• Transfer ke rekening: <strong>BCA 1234567890</strong></p>
                        <p>• Atas nama: <strong>PT. Zukira Booking</strong></p>
                        <p>• Pastikan nominal transfer sesuai dengan total pembayaran</p>
                        <p>• Upload bukti transfer yang jelas dan lengkap</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Status Modal -->
<div id="statusModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-2xl p-8 m-4 max-w-md w-full">
        <div class="text-center">
            <div id="statusIcon" class="mx-auto mb-4"></div>
            <h3 id="statusTitle" class="text-lg font-semibold mb-2"></h3>
            <p id="statusMessage" class="text-gray-600 mb-6"></p>
            <button onclick="closeStatusModal()" class="bg-gradient-to-r from-pink-400 to-rose-400 hover:from-pink-500 hover:to-rose-500 text-white font-semibold py-2 px-6 rounded-xl">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('bukti_transfer');
    const uploadArea = document.getElementById('uploadArea');
    const previewArea = document.getElementById('previewArea');
    const previewImage = document.getElementById('previewImage');

    if (dropZone && fileInput) {
        // Click to browse
        dropZone.addEventListener('click', () => fileInput.click());

        // Drag & Drop functionality
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('border-pink-400', 'bg-pink-50');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('border-pink-400', 'bg-pink-50');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('border-pink-400', 'bg-pink-50');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                handleFileSelect(files[0]);
            }
        });

        // File input change
        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                handleFileSelect(e.target.files[0]);
            }
        });

        function handleFileSelect(file) {
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    previewImage.src = e.target.result;
                    uploadArea.classList.add('hidden');
                    previewArea.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        }

        // Form submission
        const paymentForm = document.getElementById('paymentForm');
        if (paymentForm) {
            paymentForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                const submitButton = this.querySelector('button[type="submit"]');
                
                // Disable button and show loading
                submitButton.disabled = true;
                submitButton.innerHTML = `
                    <svg class="animate-spin w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Mengirim...
                `;

                // Send form data
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        showStatus('success', 'Pembayaran Berhasil!', 'Bukti pembayaran telah dikirim dan sedang diproses.');
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    } else {
                        showStatus('error', 'Gagal!', data.message || 'Terjadi kesalahan saat mengirim pembayaran.');
                    }
                })
                .catch(error => {
                    showStatus('error', 'Error!', 'Terjadi kesalahan saat mengirim pembayaran.');
                })
                .finally(() => {
                    // Reset button
                    submitButton.disabled = false;
                    submitButton.innerHTML = `
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        Kirim Pembayaran
                    `;
                });
            });
        }
    }
});

function checkPaymentStatus() {
    const bookingId = '{{ $booking->id }}';
    
    // Show loading
    showStatus('loading', 'Mengecek Status...', 'Mohon tunggu sebentar...');
    
    fetch(`/api/payment-status/${bookingId}`)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'approved') {
                showStatus('success', 'Pembayaran Disetujui!', 'Pembayaran Anda telah diverifikasi dan disetujui.');
            } else if (data.status === 'pending') {
                showStatus('pending', 'Pembayaran Pending', 'Pembayaran Anda sedang dalam proses verifikasi.');
            } else if (data.status === 'rejected') {
                showStatus('error', 'Pembayaran Ditolak', 'Pembayaran Anda ditolak. Silakan hubungi customer service.');
            } else {
                showStatus('pending', 'Belum Ada Pembayaran', 'Belum ada pembayaran yang dikirim untuk booking ini.');
            }
        })
        .catch(error => {
            showStatus('error', 'Error', 'Terjadi kesalahan saat mengecek status pembayaran.');
        });
}

function showStatus(type, title, message) {
    const modal = document.getElementById('statusModal');
    const icon = document.getElementById('statusIcon');
    const titleEl = document.getElementById('statusTitle');
    const messageEl = document.getElementById('statusMessage');
    
    // Set content
    titleEl.textContent = title;
    messageEl.textContent = message;
    
    // Set icon based on type
    if (type === 'success') {
        icon.innerHTML = `
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
        `;
    } else if (type === 'error') {
        icon.innerHTML = `
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </div>
        `;
    } else if (type === 'pending') {
        icon.innerHTML = `
            <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        `;
    } else if (type === 'loading') {
        icon.innerHTML = `
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-blue-600 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
        `;
    }
    
    // Show modal
    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeStatusModal() {
    const modal = document.getElementById('statusModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
}
</script>

@endsection