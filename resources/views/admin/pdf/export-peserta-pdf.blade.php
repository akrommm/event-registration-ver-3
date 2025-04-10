<!DOCTYPE html>
<html>

<head>
    <title>Data Peserta {{ $event->nama }}</title>
    <link rel="shortcut icon" href="{{ url('/')}}/assets/images/logo/HIPMI.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #333;
            line-height: 1.6;
        }

        .container {
            margin: 20px auto;
            max-width: 800px;
        }

        h2,
        p {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #555;
            color: #fff;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .status-success {
            color: #28a745;
            font-weight: bold;
        }

        .status-danger {
            color: #dc3545;
            font-weight: bold;
        }

        .summary {
            margin-top: 20px;
            font-size: 16px;
        }

        .summary .highlight {
            font-weight: bold;
            color: #555;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Data Peserta Terdaftar untuk Event: <span style="color: #555;">{{ $event->nama }}</span></h2>
        <p class="summary">
            Total Peserta: <span class="highlight">{{ count($peserta) }}</span> |
            Sudah Check-In: <span class="highlight">{{ $peserta->where('checked', true)->count() }}</span> |
            Belum Check-In: <span class="highlight">{{ $peserta->where('checked', false)->count() }}</span>
        </p>

        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Peserta</th>
                    <th>ID Peserta</th>
                    <th>Status Check-In</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($peserta as $key => $data)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $data->nama_peserta }}</td>
                    <td>{{ $data->id_peserta }}</td>
                    <td>
                        @if ($data->checked)
                        <span class="status-success">Sudah Check-In</span>
                        @else
                        <span class="status-danger">Belum Check-In</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td>Belum ada data.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>

<script>
    window.onload = function() {
        setTimeout(function() {
            window.print(); // Menunggu 1 detik sebelum mencetak
        }, 1000);
    };
</script>

</html>