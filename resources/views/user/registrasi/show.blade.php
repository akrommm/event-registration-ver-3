<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>A-Labs | Detail Event</title>

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
                                Detail Event
                            </h3>
                            <hr>
                            <div class="justify-content-center">
                                <x-template.button.back-button url="registrasi" />
                                <div class="card shadow-lg col-md-12" style="margin: auto; border-radius: 10px;">
                                    <!-- Bagian Gambar Banner -->
                                    <div class="card-img-top text-center">
                                        <img
                                            src="{{ url($event->gambar) }}"
                                            alt="Banner Event"
                                            class="img-fluid rounded"
                                            style="max-height: 300px; object-fit: cover; width: 100%;">
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6 class="text-dark font-weight-bold">Nama Event</h6>
                                                <p>{{ $event->nama }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-dark font-weight-bold">Tanggal Event</h6>
                                                <p>{{ $event->waktu->format('d M Y, H:i') }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-dark font-weight-bold">Tempat Event</h6>
                                                <p>{{ $event->tempat }}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6 class="text-dark font-weight-bold">Status</h6>
                                                <p>
                                                    <span class="badge {{ $event->status == 1 ? 'badge-success' : 'badge-warning' }}">
                                                        {{ $event->status == 1 ? 'Publish' : 'Draft' }}
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h6 class="text-dark font-weight-bold">Deskripsi:</h6>
                                                <div>{!! $event->deskripsi ?? 'Tidak ada deskripsi.' !!}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h3 class="text-center font-weight-bold text-dark mt-5">
                                Registrasi Event
                            </h3>
                            <hr>
                            <div class="card shadow-lg col-md-12" style="margin: auto; border-radius: 10px;">
                                <div class="card-body">
                                    <form action="{{ url('registrasi') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id_event" id="id_event" value="{{ $event->id }}">
                                        <div class="form-group">
                                            <label class="form-label" for="nama">Nama Peserta</label>
                                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama lengkap" required>
                                            @error('nama')
                                            <small class="text-danger">* {{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="no_hp">Nomor WhatsApp</label>
                                            <input type="text" name="no_hp" id="no_hp" class="form-control" placeholder="Contoh: 08xxxxxxxxxx" required>
                                            @error('no_hp')
                                            <small class="text-danger">* {{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="form-label" for="photo">Upload Foto</label>
                                            <input type="file" name="photo" id="photo" accept=".jpg, .jpeg, .png" class="form-control" required>
                                            @error('photo')
                                            <small class="text-danger">* {{ $message }}</small>
                                            @enderror
                                        </div>

                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn btn-primary btn-interactive w-100" style="border-radius: 10px;">
                                                Daftar Sekarang
                                            </button>
                                        </div>
                                    </form>
                                </div>
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