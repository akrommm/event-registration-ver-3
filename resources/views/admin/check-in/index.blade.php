<x-app title="A-Labs | Check In Event ">
    <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px">Check In</h5>
    <hr>

    <div class="container text-center ">
        <!-- Card Wrapper -->
        <div class="card shadow-lg" style="width: 300px; margin: auto; border-radius: 15px;">
            <div class="card-body">
                <h5 class="card-title text-dark font-weight-bold mb-4" style="font-size: 20px;">Pilih Metode Check-In</h5>
                <!-- Button for Manual Check-In -->
                <button id="manualCheckInBtn" class="btn btn-primary w-100 mb-3 btn-interactive" style="font-size: 16px; border-radius: 10px;">
                    <i class="anticon anticon-user-add"></i> Check In Manual
                </button>
                <!-- Button for QR Code Check-In -->
                <button id="qrCheckInBtn" class="btn btn-success w-100 mb-3 btn-interactive" style="font-size: 16px; border-radius: 10px;">
                    <i class="anticon anticon-scan"></i> Check In dengan QR Code
                </button>
            </div>

                <!-- Section to Display QR Scanner -->
            <div id="reader" class="mt-4" style="width: 300px; height: 250px; margin: auto; display: none;">
                <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-2 text-dark font-weight-bold">Memulai Scanner QR Code...</p>
                <p class="text-muted" style="font-size: 14px;">Pastikan kamera perangkat Anda diizinkan untuk digunakan.</p>
            </div>

            <p class="text-center text-danger" style="font-size: 14px; margin-top: 10px;">
                <small>*Pastikan peserta memiliki ID Peserta atau QR Code untuk proses check-in.</small>
            </p>
        </div>
    </div>

    <!-- Modal Check In Manual -->
    <div class="modal fade" id="manualCheckInModal" tabindex="-1" aria-labelledby="manualCheckInModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="manualCheckInModalLabel">Check In Manual</h5>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body">
                    <form id="manualCheckInForm">
                        <div class="mb-3">
                            <label for="manualParticipantId" class="form-label">ID Peserta</label>
                            <input type="text" class="form-control" id="manualParticipantId" name="manualParticipantId" placeholder="Masukkan ID Peserta" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger btn-interactive" data-dismiss="modal">Tutup</button>
                    <button type="button" id="searchManualParticipant" class="btn btn-primary btn-interactive">Cari Peserta</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Preview Check-In -->
    <div class="modal fade" id="checkInModal" tabindex="-1" aria-labelledby="checkInModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" style="text-align: center; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                    <!-- Status Peserta -->
                    <h3 id="previewStatus" class="font-weight-bold text-warning mb-2"></h3>
                    
                    <!-- Menampilkan Data -->
                    <div class="mb-1" id="ktaContainer" style="display: none;">
                        <img id="previewPhoto" src="" alt="Kartu Tanda Anggota" class="img-fluid" style="width: 200px; height: auto; border: 3px solid #00c9a7; display: none;">
                        <div id="noParticipantMessage" class="text-danger" style="display: none;">
                            <h5>Peserta Tidak Ditemukan</h5>
                        </div>
                    </div>

                </div>
                <div id="detail" style="display: none;" class="mt-0 mb-3">
                    <table class="mx-auto">
                        <tr>
                            <td style="width: 120px;" class="font-weight-bold text-start pe-2">Nama</td>
                            <td style="width: 10px;" class="text-center pe-2">:</td>
                            <td style="width: 200px;" class="font-weight-bold text-start" id="previewNama"></td>
                        </tr>
                        <tr>
                            <td style="width: 120px;" class="font-weight-bold text-start pe-2">No. Whatsapp</td>
                            <td style="width: 10px;" class="text-center pe-2">:</td>
                            <td style="width: 200px;" class="font-weight-bold text-start" id="previewNoHp"></td>
                        </tr>
                        <tr>
                            <td style="width: 120px;" class="font-weight-bold text-start pe-2">ID Peserta</td>
                            <td style="width: 10px;" class="text-center pe-2">:</td>
                            <td style="width: 200px;" class="font-weight-bold text-start" id="previewId"></td>
                        </tr>
                    </table>
                </div>
                
                <div class="m-5 text-center">
                    <div id="checkInContainer" style="display: none;">
                        <button id="confirmCheckInBtn" class="btn btn-success btn-interactive w-90" style="font-size: 16px; border-radius: 10px;">Check In</button>
                    </div>
                </div>
                <div class="m-5 text-center mb-5">
                    <button type="button" class="btn btn-danger btn-interactive w-90" style="font-size: 16px; border-radius: 10px;" data-bs-dismiss="modal" onclick="window.location.reload();">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script> -->

    <script>
        let html5QrCode;

        document.getElementById('searchManualParticipant').addEventListener('click', function () {
            const participantIdManual = document.getElementById('manualParticipantId').value;

            if (participantIdManual) {
                fetch(`{{ route('admin.get-participant', ['id_peserta' => '__ID__']) }}`.replace('__ID__', participantIdManual), {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const participantData = data.data;

                            if ( participantData.role === 'Peserta') {
                                // Menampilkan data jika role adalah Peserta

                                document.getElementById('ktaContainer').style.display = 'block';
                                document.getElementById('previewPhoto').src = "{{ asset('/') }}" + participantData.photo;
                                document.getElementById('previewPhoto').style.display = 'block';
                                document.getElementById('noParticipantMessage').style.display = 'none';
                                document.getElementById('previewStatus').innerHTML = 'Peserta Terdeteksi!';
                                document.getElementById('checkInContainer').style.display = 'block';
                                document.getElementById('detail').style.display = 'block';
                                document.getElementById('previewNama').innerHTML = participantData.nama_peserta;
                                document.getElementById('previewNoHp').innerHTML = participantData.no_hp;
                                document.getElementById('previewId').innerHTML = participantData.id_peserta;
                            } else {
                                // Menampilkan tombol Check In jika selain Peserta
                                document.getElementById('previewStatus').innerHTML = participantData.role + ' Terdeteksi!';
                                document.getElementById('ktaContainer').style.display = 'none';
                                document.getElementById('checkInContainer').style.display = 'block';
                            }

                            $('#checkInModal').modal('show').on('hidden.bs.modal', function () {
                            // Ketika modal manualCheckInModal sudah tertutup, buka checkInModal
                            $('#manualCheckInModal').modal('hide');
                        });
                            window.participantId = participantIdManual;
                        } else {
                           // Peserta tidak ditemukan, tampilkan pesan
                            document.getElementById('noParticipantMessage').style.display = 'block';
                            document.getElementById('previewStatus').innerText = 'Data Tidak Ditemukan';

                            // Menyembunyikan data peserta
                            document.getElementById('previewPhoto').style.display = 'none';
                            document.getElementById('checkInButton').style.display = 'none';

                            // Menampilkan modal
                            $('#checkInModal').modal('show');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert("Terjadi kesalahan saat mencari Data.");
                    });
            } else {
                alert("Harap masukkan ID.");
            }
        });

        function onScanSuccess(decodedText, decodedResult) {
            console.log('QR Code detected: ', decodedText);

            const participantId = decodedText;

            fetch(`{{ route('admin.get-participant', ['id_peserta' => '__ID__']) }}`.replace('__ID__', participantId), {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {

                        const participantData = data.data;
                        // Menampilkan data peserta di modal
                            
                            if ( participantData.role === 'Peserta') {
                                // Menampilkan data jika role adalah Peserta
                                document.getElementById('ktaContainer').style.display = 'block';
                                document.getElementById('previewPhoto').src = "{{ asset('/') }}" + participantData.photo;
                                document.getElementById('previewPhoto').style.display = 'block';
                                document.getElementById('noParticipantMessage').style.display = 'none';
                                document.getElementById('previewStatus').innerHTML = 'Peserta Terdeteksi!';
                                document.getElementById('checkInContainer').style.display = 'block';
                                document.getElementById('detail').style.display = 'block';
                                document.getElementById('previewNama').innerHTML = participantData.nama_peserta;
                                document.getElementById('previewNoHp').innerHTML = participantData.no_hp;
                                document.getElementById('previewId').innerHTML = participantData.id_peserta;
                            } else {
                                // Menampilkan tombol Check In jika selain Peserta
                                document.getElementById('previewStatus').innerHTML = participantData.role + ' Terdeteksi!';
                                document.getElementById('ktaContainer').style.display = 'none';
                                document.getElementById('checkInContainer').style.display = 'block';
                            }

                        $('#checkInModal').modal('show');
                        window.participantId = decodedText;

                        if (html5QrCode) {
                            html5QrCode.stop().then(() => {
                                document.getElementById("reader").style.display = "none";
                            });
                        }
                    } else {
                        // Peserta tidak ditemukan, tampilkan pesan
                        document.getElementById('noParticipantMessage').style.display = 'block';
                        document.getElementById('previewStatus').innerText = 'Data Tidak Ditemukan';

                        // Menyembunyikan data peserta
                        document.getElementById('previewPhoto').style.display = 'none';
                        document.getElementById('checkInButton').style.display = 'none';

                        // Menampilkan modal
                        $('#checkInModal').modal('show');
                    }
                });
        }

        function onScanError(errorMessage) {
            console.warn('Scan error: ', errorMessage);
        }

        document.getElementById('qrCheckInBtn').addEventListener('click', function () {
            document.getElementById("reader").style.display = "block";

            if (!html5QrCode) {
                html5QrCode = new Html5Qrcode("reader");
                html5QrCode.start({ facingMode: "environment" }, { fps: 10, qrbox: 250 }, onScanSuccess, onScanError);
            }
        });

        document.getElementById('manualCheckInBtn').addEventListener('click', function () {
            const manualModal = new bootstrap.Modal(document.getElementById('manualCheckInModal'));
            manualModal.show();
        });

        // document.getElementById('submitManualCheckIn').addEventListener('click', function () {
        //     const participantIdManual = document.getElementById('manualParticipantId').value;

        //     if (participantIdManual) {
        //         fetch('{{ route('admin.check-in.validate') }}', {
        //             method: 'POST',
        //             headers: {
        //                 'Content-Type': 'application/json',
        //                 'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //             },
        //             body: JSON.stringify({ participant_id: participantIdManual })
        //         })
        //             .then(response => response.json())
        //             .then(data => {
        //                 if (data.success) {
        //                     $('#manualCheckInModal').modal('hide');
        //                     window.location.reload();
        //                 } else {
        //                     alert(data.message);
        //                 }
        //             })
        //             .catch(error => {
        //                 console.error('Error:', error);
        //                 alert("Gagal memproses check-in peserta.");
        //             });
        //     } else {
        //         alert("Harap masukkan ID Peserta.");
        //     }
        // });

        document.getElementById('confirmCheckInBtn').addEventListener('click', function () {
            const participantId = window.participantId;

            if (participantId) {
                fetch('{{ route('admin.check-in.validate') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ participant_id: participantId })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            $('#checkInModal').modal('hide');
                            window.location.reload();
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert("Gagal memproses check-in peserta.");
                    });
            }
        });
    </script>
    <style>
        /* Membalik tampilan kamera (mirror effect) */
        #reader video {
            transform: scaleX(-1); /* Membalik tampilan video secara horizontal */
        }

        /* Menyesuaikan ukuran reader untuk tampilan responsif */
        #reader {
            width: 80vw; /* 80% dari lebar viewport */
            height: 50vh; /* 50% dari tinggi viewport */
            max-width: 600px; /* Ukuran maksimum lebar */
            max-height: 400px; /* Ukuran maksimum tinggi */
            margin: 0 auto; /* Centering reader */
        }
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

        /* Media query untuk perangkat dengan lebar lebih kecil dari 768px (misalnya, ponsel) */
        @media (max-width: 768px) {
            #reader {
                width: 90vw; /* Mengatur lebar ke 90% pada perangkat lebih kecil */
                height: 40vh; /* Mengatur tinggi menjadi 40% pada perangkat lebih kecil */
            }
        }

        @media (max-width: 500px) {
            #reader {
                width: 95vw; /* Mengatur lebar menjadi lebih besar pada perangkat ponsel sangat kecil */
                height: 50vh; /* Menyesuaikan dengan ketinggian layar */
            }
        }
    </style>
</x-app>

