<x-app title="A-Labs | Registrasi Event ">
    <div class="text-center mb-4">
        <h5 class="font-weight-bold text-dark" style="font-size: 30px;">Registrasi Berhasil!</h5>
    </div>
    <hr>
    <div class="container mt-5">
        <div class="card shadow-lg" style="margin: auto; border-radius: 10px;">
            <div class="card-body text-center">
                <!-- Animasi Success Icon -->
                <div class="mb-4">
                    <div style="font-size: 60px; color: #28a745;">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>

                <!-- Informasi Registrasi -->
                <p class="lead mb-3">
                    Peserta dengan nama <strong>{{ $registration->nama_peserta }}</strong> telah berhasil diregistrasi.
                </p>
                <p class="h6 mb-4">
                    ID Peserta: <strong>{{ $registration->id_peserta }}</strong>
                </p>
                <p class="mb-4">
                    Berikut adalah QR Code untuk keperluan check-in:
                </p>

                <!-- QR Code dengan Animasi Hover -->
                <div class="mb-4">
                    <img src="{{ url($registration->qr_code) }}" alt="QR Code" class="img-fluid" style="max-width: 200px; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.1)';" onmouseout="this.style.transform='scale(1)';">
                </div>
                <div class="text-center mt-4">
                    <a href="{{ route('admin.download.idcard', $registration->id) }}" target="_blank" class="btn btn-success btn-lg px-10 shadow-sm" style="transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.05)';" onmouseout="this.style.transform='scale(1)';" style="border-radius: 10px;">
                        <i class="fas fa-print mr-2"></i> Cetak ID Card
                    </a>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ url('admin/registration') }}" class="btn btn-primary btn-lg px-10 shadow-sm" style="transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.05)';" onmouseout="this.style.transform='scale(1)';" style="border-radius: 10px;">
                        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Halaman Registrasi
                    </a>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
    </div>

    <!-- CSS Animations -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</x-app>