<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>A-Labs | Registrasi</title>

    <link rel="shortcut icon" href="{{ url('/')}}/assets/images/logo/A-Labs1.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- CSS Vendor -->
    <link href="{{ url('/') }}/assets/vendors/select2/select2.css" rel="stylesheet">
    <link href="{{ url('/') }}/assets/vendors/datatables/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="{{ url('/') }}/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="{{ url('/') }}/assets/vendors/summernote/summernote-bs4.min.css" rel="stylesheet">

    <!-- Core CSS -->
    <link href="{{ url('/') }}/assets/css/app.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        body {
            background-color: #D3EBF5;
            font-family: 'Poppins', sans-serif;
        }

        .btn-interactive {
            transition: .3s all ease-in-out;
        }

        .btn-interactive:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .card-custom {
            border-radius: 14px;
            transition: all 0.3s ease;
            background-color: #fff;
        }

        .card-custom:hover {
            transform: translateY(-6px) scale(1.02);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            color: #2c3e50;
        }

        .subtitle {
            font-size: 15px;
            color: #6c757d;
            text-align: center;
            margin-top: -10px;
            margin-bottom: 30px;
        }

        @media (max-width: 576px) {
            .card-title {
                font-size: 16px;
            }

            .card-text,
            .btn-sm {
                font-size: 13px;
            }

            .card-img-top {
                height: 140px;
            }
        }
    </style>
</head>

<body>
    <div class="app">
        <div class="layout">
            <div class="main-content py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <x-template.utils.notif-front />

                            <h3 class="text-center font-weight-bold text-dark">
                                List Event
                            </h3>
                            <hr>
                            <div class="subtitle">
                                Pilih Event yang Diikuti!
                            </div>

                            <div class="row justify-content-center">
                                @forelse ($list_event as $event)
                                <div class="col-md-6 col-lg-4 mb-4 d-flex" data-aos="fade-up">
                                    <div class="card card-custom h-100 w-100 border-0 shadow-sm btn-interactive">
                                        <img src="{{ url($event->gambar) }}" class="card-img-top" alt="Banner Event"
                                            style="height: 180px; object-fit: cover; border-top-left-radius: 14px; border-top-right-radius: 14px;">
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title fw-bold">
                                                <a href="{{ url('registrasi', $event->slug) }}" class="text-decoration-none font-weight-bold text-dark">
                                                    {{ Str::limit($event->nama, 40, '...') }}
                                                </a>
                                            </h5>
                                            <p class="card-text text-muted mb-1">
                                                <i class="bi bi-calendar-event"></i>
                                                {{ \Carbon\Carbon::parse($event->waktu)->translatedFormat('d F Y • H:i') }} WIB
                                            </p>
                                            <p class="card-text text-muted flex-grow-1">
                                                <i class="bi bi-geo-alt"></i>
                                                {{ $event->tempat }}
                                            </p>
                                            <a href="{{ url('registrasi', $event->slug) }}"
                                                class="btn btn-primary btn-sm mt-auto w-100 btn-interactive">
                                                <i class="bi bi-box-arrow-in-right"></i> Lihat Detail
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="col-12">
                                    <div class="alert alert-info text-center">
                                        Belum ada event tersedia saat ini.
                                    </div>
                                </div>
                                @endforelse
                            </div>

                            <div class="d-flex justify-content-center mt-4">
                                {{ $list_event->links('pagination::bootstrap-4') }}
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
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true
        });

        $('.select2').select2();
    </script>
</body>

</html>