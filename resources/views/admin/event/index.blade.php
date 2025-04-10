<x-app title="A-Labs | Manajemen Event ">
    <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px">Manajemen Event</h5>
    <hr>
    <div class="card shadow-lg" style="margin: auto; border-radius: 10px;">
        <div class="card-body">
            <div class="table-responsive">
                <a href="" data-toggle="modal" data-target="#tambah-event" class="btn btn-dark float-right ml-2"><i class="fas fa-plus"></i> Tambah Event</a>
                <table id="data-table" class="table table-bordered">
                    <thead class="bg-dark">
                        <tr>
                            <th style="width: 1%; color: white;">No</th>
                            <th class="text-center" style="color: white;" width="230px">Nama Event</th>
                            <th class="text-center" style="color: white;" width="230px">Tanggal</th>
                            <th class="text-center" style="color: white;" width="230px">Tempat</th>
                            <th class="text-center" style="color: white;" width="230px">Status</th>
                            <th class="text-center" style="color: white;" width="120px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $event->nama }}</td>
                            <td class="text-center">{{ $event->waktu->format('d M Y, H:i') }}</td>
                            <td class="text-center">{{ $event->tempat }}</td>
                            <td class="text-center">
                                <label class="btn {{ $event->status == 1 ? 'btn-success' : 'btn-warning' }}">
                                    {{ $event->status == 1 ? 'Publish' : 'Draft' }}
                                </label>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <x-template.button.info-button url="admin/event" id="{{ $event->id }}" />
                                    <a href="#edit{{ $event->id }}" data-toggle="modal" class="btn btn-warning btn-interactive">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#hapus{{ $event->id }}" data-toggle="modal" class="btn btn-danger btn-interactive">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <x-template.modal.modal-delete id="hapus{{ $event->id }}"
                            action="{{ url('admin/event', $event->id) }}" />

                        <x-template.modal.modaledit id="edit{{ $event->id }}"
                            action="{{ url('admin/event', $event->id) }}">

                            <div class="modal-content modal-lg">
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit Data Event</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="nama" class="control-label">Nama Event</label>
                                                <input type="text" id="nama" name="nama" class="form-control" value="{{$event->nama}}">
                                                @error('nama')
                                                <p class="text-danger" style="font-size: 12px">* {{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="waktu" class="control-label">Tanggal Event</label>
                                                <input type="datetime-local" id="waktu" name="waktu" class="form-control" value="{{$event->waktu}}">
                                                @error('waktu')
                                                <p class="text-danger" style="font-size: 12px">* {{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="tempat" class="control-label">Tempat Event</label>
                                                <input type="text" id="tempat" name="tempat" class="form-control" value="{{$event->tempat}}">
                                                @error('tempat')
                                                <p class="text-danger" style="font-size: 12px">* {{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="status" class="control-label">Status</label>
                                                <select class="form-control" name="status" id="status" required>
                                                    @if ($event->status == 2)
                                                    <option value="2">Draft</option>
                                                    <option value="1">Publish</option>
                                                    @else
                                                    <option value="1">Publish</option>
                                                    <option value="2">Draft</option>
                                                    @endif
                                                </select>
                                                @error('status')
                                                <p class="text-danger" style="font-size: 12px">* {{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="gambar" class="control-label">Gambar</label>
                                                <input type="file" id="gambar" name="gambar" class="form-control" value="{{$event->gambar}}">
                                                @error('gambar')
                                                <p class="text-danger" style="font-size: 12px">* {{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="">Deskripsi</label>
                                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" id="summernote" cols="50" rows="10">{{ $event->deskripsi }}</textarea>
                                            @error('deskripsi')
                                            <p class="text-danger" style="font-size: 12px; margin-bottom: 0px; padding-bottom: 0px">* {{ $message }}</p style="font-size: 12px">
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-danger btn-interactive"
                                        data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary btn-interactive">Simpan</button>
                                </div>
                            </div>
                        </x-template.modal.modaledit>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Event -->
    <div class="modal fade" id="tambah-event">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Event</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="nama" class="control-label">Nama Event</label>
                                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukan Nama" required>
                                    @error('nama')
                                    <p class="text-danger" style="font-size: 12px">* {{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="waktu" class="control-label">Tanggal Event</label>
                                    <input type="datetime-local" id="waktu" name="waktu" class="form-control" required>
                                    @error('waktu')
                                    <p class="text-danger" style="font-size: 12px">* {{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="tempat" class="control-label">Tempat Event</label>
                                    <input type="text" id="tempat" name="tempat" class="form-control" placeholder="Masukan Tempat" required>
                                    @error('tempat')
                                    <p class="text-danger" style="font-size: 12px">* {{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="status" class="control-label">Status</label>
                                    <select class="form-control" name="status" id="status" required>
                                        <option value="">Pilih Status</option>
                                        <option value="1">Publish</option>
                                        <option value="2">Draft</option>
                                    </select>
                                    @error('status')
                                    <p class="text-danger" style="font-size: 12px">* {{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="gambar" class="control-label">Gambar</label>
                                    <input type="file" id="gambar" name="gambar" class="form-control" required>
                                    @error('gambar')
                                    <p class="text-danger" style="font-size: 12px">* {{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" placeholder="Masukan Deskripsi" name="deskripsi" id="summernote" cols="50" rows="10" required></textarea>
                                @error('deskripsi')
                                <p class="text-danger" style="font-size: 12px; margin-bottom: 0px; padding-bottom: 0px">* {{ $message }}</p style="font-size: 12px">
                                @enderror
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12 modal-footer justify-content-between">
                                <button type="button" class="btn btn-danger btn-interactive"
                                    data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary btn-interactive">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app>