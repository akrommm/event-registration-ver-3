<x-app title="A-Labs | Manajemen Event ">
    <div class="card-header py-2">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px">Detail Event
        </h5>
    </div>
    <br>
    <x-template.button.back-button url="admin/event" />
    <div class="card shadow-lg" style="margin: auto; border-radius: 10px;">
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

    <div class="row mt-5">
        <div class="col-lg-4 col-6 mt-2">
            <!-- small box -->
            <div class="card shadow-lg" style="margin: auto; border-radius: 10px;">
                <div class="card-body">
                    <div class="media align-items-center">
                        <div class="avatar avatar-icon avatar-lg avatar-blue">
                            <i class="anticon anticon-usergroup-add"></i>
                        </div>
                        <div class="m-l-15">
                            <h2 class="m-b-0">{{ $terdaftar }}</h2>
                            <p class="m-b-0 text-muted">Peserta Terdaftar</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-6 mt-2">
            <!-- small box -->
            <div class="card shadow-lg" style="margin: auto; border-radius: 10px;">
                <div class="card-body">
                    <div class="media align-items-center">
                        <div class="avatar avatar-icon avatar-lg avatar-cyan">
                            <i class="anticon anticon-user-add"></i>
                        </div>
                        <div class="m-l-15">
                            <h2 class="m-b-0">{{ $hadir }}</h2>
                            <p class="m-b-0 text-muted">Peserta Hadir</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-6 mt-2">
            <!-- small box -->
            <div class="card shadow-lg" style="margin: auto; border-radius: 10px;">
                <div class="card-body">
                    <div class="media align-items-center">
                        <div class="avatar avatar-icon avatar-lg avatar-red">
                            <i class="anticon anticon-user-delete"></i>
                        </div>
                        <div class="m-l-15">
                            <h2 class="m-b-0">{{ $tidakHadir }}</h2>
                            <p class="m-b-0 text-muted">Peserta Tidak Hadir</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Peserta -->
    <div class="card-header py-2 mt-5">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px">Data Peserta
        </h5>
    </div>
    <br>

    <div class="card shadow-lg" style="margin: auto; border-radius: 10px;">
        <div class="card-body">
            <div class="table-responsive">
                <a href="{{ route('admin.export-peserta-pdf', $event->id) }}" target="_blank" class="btn btn-danger float-right ml-2 btn-interactive">
                    <i class="fas fa-file-pdf"></i> Export PDF
                </a>
                <table id="data-table" class="table table-datatable table-bordered">
                    <thead class="bg-dark">
                        <tr>
                            <th class="text-center text-white" width="10px">No.</th>
                            <th class="text-center text-white">Nama Peserta</th>
                            <th class="text-center text-white">ID Peserta</th>
                            <th class="text-center text-white">Check In</th>
                            <th class="text-center text-white" width="100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peserta as $key => $data)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="text-center">{{ $data->nama_peserta }}</td>
                            <td class="text-center">{{ $data->id_peserta }}</td>
                            <td class="text-center">
                                @if ($data->checked)
                                <span class="badge badge-success">Sudah Check In</span>
                                @else
                                <span class="badge badge-danger">Belum Check In</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="#hapus{{ $data->id }}" data-toggle="modal" class="btn btn-danger btn-interactive">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a href="{{ route('admin.download.idcard', $data->id) }}" target="_blank" class="btn btn-primary btn-interactive">
                                        <i class="fas fa-print"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <x-template.modal.modal-delete id="hapus{{ $data->id }}"
                            action="{{ url('admin/delete-peserta', $data->id) }}" />
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</x-app>