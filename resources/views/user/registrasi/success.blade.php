<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>A-Labs | Registrasi</title>

    <link rel="shortcut icon" href="{{ url('/')}}/assets/images/logo/A-Labs1.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- CSS Vendor -->
    <link href="{{ url('/') }}/assets/vendors/select2/select2.css" rel="stylesheet">
    <link href="{{ url('/') }}/assets/vendors/datatables/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="{{ url('/') }}/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="{{ url('/') }}/assets/vendors/summernote/summernote-bs4.min.css" rel="stylesheet">

    <!-- Core CSS -->
    <link href="{{ url('/') }}/assets/css/app.min.css" rel="stylesheet">
    <link href="{{ url('/') }}/assets/css/simadu.css" rel="stylesheet">

    <style>
        .btn-interactive {
            transition: .3s all ease-in-out;
        }

        .btn-interactive:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .form-label {
            font-weight: 600;
            font-size: 14px;
        }

        .card-custom {
            border-radius: 12px;
        }

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
</head>

<body style="background-color: #D3EBF5;">
    <div class="app">
        <div class="layout">
            <div class="main-content py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <x-template.utils.notif-front />

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
                                            <a href="{{ route('download.idcard', $registration->id) }}" target="_blank" class="btn btn-success btn-lg px-10 shadow-sm" style="transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.05)';" onmouseout="this.style.transform='scale(1)';" style="border-radius: 10px;">
                                                <i class="fas fa-print mr-2"></i> Cetak ID Card
                                            </a>
                                        </div>

                                        <div class="text-center mt-4">
                                            <a href="{{ url('registrasi') }}" class="btn btn-primary btn-lg px-10 shadow-sm" style="transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.05)';" onmouseout="this.style.transform='scale(1)';" style="border-radius: 10px;">
                                                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Halaman Registrasi
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tombol Aksi -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS Vendor -->
    <script src="{{ url('/') }}/assets/js/vendors.min.js"></script>
    <script src="{{ url('/') }}/assets/vendors/select2/select2.min.js"></script>
    <script src="{{ url('/') }}/assets/vendors/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ url('/') }}/assets/vendors/datatables/dataTables.bootstrap.min.js"></script>
    <script src="{{ url('/') }}/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="{{ url('/') }}/assets/vendors/summernote/summernote-bs4.min.js"></script>
    <script src="{{ url('/') }}/assets/js/app.min.js"></script>

    <script>
        $('.select2').select2();
    </script>
</body>

</html>