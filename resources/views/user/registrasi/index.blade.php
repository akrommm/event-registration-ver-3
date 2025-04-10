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

                            <h3 class="text-center font-weight-bold text-dark">
                                Registrasi Event
                            </h3>
                            <hr>
                            <div class="card shadow-lg card-custom">
                                <div class="card-body">
                                    <form action="{{ url('registrasi') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
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

                                        <div class="form-group">
                                            <label class="form-label" for="id_event">Pilih Event</label>
                                            <select class="form-control select2" name="id_event" required>
                                                <option value="" selected disabled>-- Pilih Event --</option>
                                                @foreach ($list_event as $event)
                                                <option value="{{ $event->id }}">{{ $event->nama }}</option>
                                                @endforeach
                                            </select>
                                            @error('id_event')
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

    <script>
        $('.select2').select2();
    </script>
</body>

</html>