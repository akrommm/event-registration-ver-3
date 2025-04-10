<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ID Card - {{ $registration->nama_peserta ?? '-' }}</title>
    <link rel="shortcut icon" href="{{ url('/')}}/assets/images/logo/A-Labs1.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            height: 100vh;
            margin: 0;
            padding: 1cm;
        }

        .card {
            background: linear-gradient(135deg, #192032, #3a2565);
            width: 250px;
            height: 397px;
            border-radius: 15px;
            color: white;
            padding: 25px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('{{ url($logo->background) }}') no-repeat center;
            background-size: cover;
            opacity: 0.2;
            z-index: 1;
        }

        .card-content {
            position: relative;
            z-index: 2;
            padding-top: 60px;
        }

        .logo-event,
        .logo-hipmi {
            position: absolute;
            top: 15px;
            width: 95px;
            z-index: 3;
        }

        .logo-event {
            left: 15px;
            margin-top: 10px;
        }

        .logo-hipmi {
            right: 15px;
            width: 50px;
            margin-top: 10px;
        }

        .circle-decorations,
        .circle-decorations-2 {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            z-index: 2;
        }

        .circle-decorations {
            top: -30px;
            left: -30px;
            width: 120px;
            height: 120px;
        }

        .circle-decorations-2 {
            bottom: -20px;
            right: -20px;
            width: 90px;
            height: 90px;
        }

        .card h3 {
            margin-bottom: 12px;
            font-size: 22px;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .card p {
            font-size: 16px;
            text-transform: uppercase;
            font-weight: bold;
            background-color: rgba(255, 255, 255, 0.2);
            padding: 7px 15px;
            border-radius: 5px;
            display: inline-block;
        }

        .qr-code img {
            width: 155px;
            margin: 15px 0;
            border-radius: 6px;
        }

        .id-number {
            font-size: 14px;
            color: #cccccc;
            font-weight: bold;
        }

        @media print {
            body {
                background-color: white;
                margin: 0;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                padding: 0;
            }

            body * {
                visibility: hidden;
            }

            .card,
            .card * {
                visibility: visible;
            }

            @page {
                size: F4 portrait;
                margin: 1cm 0 0 1cm;
            }

            .card {
                box-shadow: none;
                position: relative;
                overflow: visible;
                page-break-after: always;
            }
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="circle-decorations"></div>
        <div class="circle-decorations-2"></div>
        <img class="logo-event" src="{{ url($logo->logo_event) }}" alt="Logo Event">
        <img class="logo-hipmi" src="{{ url($logo->logo) }}" alt="Logo HIPMI">
        <div class="card-content">
            <h3>{{ $registration->nama_peserta ?? '-' }}</h3>
            <p>{{ $registration->role }}</p>
            <div class="qr-code">
                <img src="{{ url($registration->qr_code) }}" alt="QR Code">
            </div>
            <div class="id-number">ID: {{ $registration->id_peserta }}</div>
        </div>
    </div>

    <script>
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 1000);
        };
    </script>
</body>

</html>