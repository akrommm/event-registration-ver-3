<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>A-Labs - Masuk</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url('/')}}/assets/images/logo/A-labs1.png">

    <!-- page css -->

    <!-- Core css -->
    <link href="{{ url('/')}}/assets/css/app.min.css" rel="stylesheet">

    <style>
        /* Pastikan tampilan full height untuk container dan gunakan flex untuk tengah */
        .full-height {
            height: 100vh;
            /* Menggunakan viewport height */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Perbaikan untuk card yang responsif */
        .card {
            width: 100%;
            max-width: 400px;
            /* Batas maksimal lebar card */
            margin: auto;
            border-radius: 10px;
        }

        /* Menambah jarak agar tidak menempel ke tepi layar */
        .card-body {
            padding: 30px;
        }

        .input-affix {
            position: relative;
        }

        /* Menambah margin bawah untuk form-group */
        .form-group {
            margin-bottom: 15px;
        }

        /* Ikon mata untuk melihat password */
        .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="app">
        <div class="container-fluid p-h-0 p-v-20 bg full-height d-flex" style="background-image: url('{{ url('/')}}/assets/images/others/bg.png')">
            <div class="d-flex flex-column justify-content-between w-100">
                <div class="container d-flex h-100">
                    <div class="row align-items-center w-100">
                        <div class="col-md-7 col-lg-5 m-h-auto" style="padding-left: 30px; padding-right: 0px">
                            <div class="card shadow-lg">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between m-b-30">
                                        <img class="img-fluid" alt="" src="{{ url('/')}}/assets/images/logo/A-labs3.png" width="40%" height="47">
                                        <h2 class="m-b-0 mt-3"></h2>
                                    </div>
                                    <form action="{{ url('/login') }}" method="post">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <x-template.utils.notif />
                                            </div>
                                        </div>
                                        @if (isset($message))
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @endif
                                        @csrf
                                        <div class="form-group" data-validate="Diperlukan Email yang valid">
                                            <label class="font-weight-semibold" for="email">Email:</label>
                                            <div class="input-affix">
                                                <i class="prefix-icon anticon anticon-mail"></i>
                                                <input type="text" class="form-control" name="email" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group" data-validate="Diperlukan Password">
                                            <label class="font-weight-semibold" for="password">Password:</label>
                                            <div class="input-affix m-b-10">
                                                <i class="prefix-icon anticon anticon-lock"></i>
                                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                                <!-- Icon untuk melihat/menyembunyikan password -->
                                                <i class="toggle-password anticon anticon-eye position-absolute" onclick="togglePassword()" style="top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;"></i>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="font-size-13 text-muted">
                                                </span>
                                                <button class="btn btn-dark btn-interactive">Masuk</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-none d-md-flex p-h-40 justify-content-between">
                    <span class=""></span>
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a class="text-dark text-link" href=""></a>
                        </li>
                        <li class="list-inline-item">
                            <a class="text-dark text-link" href=""></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Core Vendors JS -->
    <script src="{{ url('/')}}/assets/js/vendors.min.js"></script>

    <!-- page js -->

    <!-- Core JS -->
    <script src="{{ url('/')}}/assets/js/app.min.js"></script>

    <script>
        // Fungsi untuk toggle password visibility
        function togglePassword() {
            var passwordField = document.getElementById("password");
            var passwordIcon = document.querySelector(".toggle-password");

            // Cek tipe input dan toggle antara password dan text
            if (passwordField.type === "password") {
                passwordField.type = "text";
                passwordIcon.classList.remove("anticon-eye");
                passwordIcon.classList.add("anticon-eye-invisible");
            } else {
                passwordField.type = "password";
                passwordIcon.classList.remove("anticon-eye-invisible");
                passwordIcon.classList.add("anticon-eye");
            }
        }
    </script>

</body>

</html>