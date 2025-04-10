<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $title }}</title>

    <!-- Favicon -->
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url('/')}}/assets/images/logo/A-Labs1.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- page css -->
    <link href="{{ url('/') }}/assets/vendors/select2/select2.css" rel="stylesheet">
    <link href="{{ url('/') }}/assets/vendors/datatables/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="{{ url('/') }}/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ url('/') }}/assets/vendors/summernote/summernote-bs4.min.css">

    <!-- Core css -->
    <link href="{{ url('/') }}/assets/css/app.min.css" rel="stylesheet">
    <link href="{{ url('/') }}/assets/css/simadu.css" rel="stylesheet">

    <style>
        .btn-interactive {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-interactive:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-interactive:focus {
            outline: none;
            box-shadow: 0 0 10px rgba(0, 0, 255, 0.4);
        }

        /* Preloader */
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease-out;
        }

        .preloader.fade-out {
            opacity: 0;
            pointer-events: none;
        }

        /* SVG Loader */
        .pl {
            display: block;
            width: 6.25em;
            height: 6.25em;
        }

        .pl__ring,
        .pl__ball {
            animation: ring 2s ease-out infinite;
        }

        .pl__ball {
            animation-name: ball;
        }

        @keyframes ring {
            from {
                stroke-dasharray: 0 257 0 0 1 0 0 258;
            }

            25% {
                stroke-dasharray: 0 0 0 0 257 0 258 0;
            }

            50%,
            to {
                stroke-dasharray: 0 0 0 0 0 515 0 0;
            }
        }

        @keyframes ball {

            from,
            50% {
                animation-timing-function: ease-in;
                stroke-dashoffset: 1;
            }

            64% {
                animation-timing-function: ease-in;
                stroke-dashoffset: -109;
            }

            78% {
                animation-timing-function: ease-in;
                stroke-dashoffset: -145;
            }

            92% {
                animation-timing-function: ease-in;
                stroke-dashoffset: -157;
            }

            57%,
            71%,
            85%,
            99%,
            to {
                animation-timing-function: ease-out;
                stroke-dashoffset: -163;
            }
        }
    </style>

</head>

<body>
    <!-- Preloader -->
    <div class="preloader" id="preloader">
        <svg class="pl" viewBox="0 0 200 200" width="200" height="200" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <linearGradient id="pl-grad1" x1="1" y1="0.5" x2="0" y2="0.5">
                    <stop offset="0%" stop-color="hsl(313,90%,55%)" />
                    <stop offset="100%" stop-color="hsl(223,90%,55%)" />
                </linearGradient>
                <linearGradient id="pl-grad2" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="0%" stop-color="hsl(313,90%,55%)" />
                    <stop offset="100%" stop-color="hsl(223,90%,55%)" />
                </linearGradient>
            </defs>
            <circle class="pl__ring" cx="100" cy="100" r="82" fill="none" stroke="url(#pl-grad1)" stroke-width="36" stroke-dasharray="0 257 1 257" stroke-dashoffset="0.01" stroke-linecap="round" transform="rotate(-90,100,100)" />
            <line class="pl__ball" stroke="url(#pl-grad2)" x1="100" y1="18" x2="100.01" y2="182" stroke-width="36" stroke-dasharray="1 165" stroke-linecap="round" />
        </svg>
    </div>
    <div class="app">
        <div class="layout">
            <!-- Header START -->
            <x-template.header />
            <!-- Header END -->

            <!-- Side Nav START -->
            <x-template.sidebar />
            <!-- Side Nav END -->

            <!-- Page Container START -->
            <div class="page-container">
                <!-- Content Wrapper START -->
                <div class="main-content" style="background-color: #D3EBF5;">
                    <div class="container-fluid pt-4">
                        <div class="row">
                            <div class="col-md-12">
                                <x-template.utils.notif-front />
                            </div>
                        </div>
                        {{ $slot }}
                    </div><!-- /.container-fluid -->
                </div>
                <!-- Content Wrapper END -->

                <!-- Footer START -->
                <x-template.footer />
                <!-- Footer END -->

            </div>
            <!-- Page Container END -->
        </div>
    </div>


    <!-- Core Vendors JS -->
    <script src="{{ url('/') }}/assets/js/vendors.min.js"></script>

    <!-- page js -->
    <script src="{{ url('/') }}/assets/vendors/select2/select2.min.js"></script>
    <script src="{{ url('/') }}/assets/vendors/chartjs/Chart.min.js"></script>
    <script src="{{ url('/') }}/assets/js/pages/dashboard-default.js"></script>
    <script src="{{ url('/') }}/assets/vendors/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ url('/') }}/assets/vendors/datatables/dataTables.bootstrap.min.js"></script>
    <script src="{{ url('/') }}/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- Summernote -->
    <script src="{{ url('/') }}/assets/vendors/summernote/summernote-bs4.min.js"></script>

    <!-- Core JS -->
    <script src="{{ url('/') }}/assets/js/app.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(() => {
                document.getElementById("preloader").classList.add("fade-out");
                setTimeout(() => {
                    document.getElementById("preloader").style.display = "none";
                    document.getElementById("app-content").style.display = "block";
                }, 500);
            }, 1000); // Simulasi loading selama 1 detik
        });
    </script>
    <script>
        $('#data-table').DataTable();
    </script>
    <script>
        $('.select2').select2();
    </script>
    <script>
        $('#trigger-loading-1').on('click', function(e) {
            $(this).addClass("is-loading");
            setTimeout(function() {
                $("#trigger-loading-1").removeClass("is-loading");
            }, 4000);
            e.preventDefault();
        });
    </script>
    <script>
        $(function() {
            $(document).ready(function() {
                $('.datepicker-input').datepicker({
                    changeMonth: true,
                    changeYear: true,
                    autoclose: true,
                    todayHighlight: true,
                    format: 'dd-mm-yyyy',
                    language: 'id',
                    locale: 'id',
                });
            });
        })
    </script>
    <script>
        $(function() {
            // Summernote
            $('#summernote').summernote({
                fontNames: ['Arial', 'Times New Roman', 'Arial Black'],
                styleTags: ['p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'],
                blockquoteBreakingLevel: 2,
                blockquoteBreakingLevel: 2,
                styleWithSpan: false,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['link', 'picture', 'video', 'table', 'hr']],
                    ['view', ['fullscreen', 'codeview']],
                ]
            });

            // Inisialisasi CodeMirror
            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                mode: "htmlmixed",
                theme: "monokai"
            });
        })
    </script>

</body>

</html>