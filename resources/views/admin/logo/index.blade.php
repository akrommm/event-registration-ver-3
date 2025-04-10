<x-app title="A-Labs | Logo ID Card ">
    <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px">Logo ID Card</h5>
    <hr>
    <div class="card shadow-lg" style="margin: auto; border-radius: 10px;">
        <div class="card-body">
            <div class="table-responsive">
                <a href="" data-toggle="modal" data-target="#tambah-logo" class="btn btn-dark float-right ml-2"><i class="fas fa-plus"></i> Tambah Logo</a>
                <table id="data-table" class="table table-bordered">
                    <thead class="bg-dark">
                        <tr>
                            <th style="width: 1%; color: white;">No</th>
                            <th class="text-center" style="color: white;" width="230px">Logo</th>
                            <th class="text-center" style="color: white;" width="230px">Logo Event</th>
                            <th class="text-center" style="color: white;" width="230px">Background</th>
                            <th class="text-center" style="color: white;" width="120px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logo as $logo)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">
                                <img src="{{ url($logo->logo) }}" alt="Logo" width="100">
                            </td>
                            <td class="text-center">
                                <img src="{{ url($logo->logo_event) }}" alt="Logo Event" width="100">
                            </td>
                            <td class="text-center">
                                <img src="{{ url($logo->background) }}" alt="Background" width="100">
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="#edit{{ $logo->id }}" data-toggle="modal" class="btn btn-warning btn-interactive">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#hapus{{ $logo->id }}" data-toggle="modal" class="btn btn-danger btn-interactive">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <x-template.modal.modal-delete id="hapus{{ $logo->id }}"
                            action="{{ url('admin/logo-idcard', $logo->id) }}" />

                        <x-template.modal.modaledit id="edit{{ $logo->id }}"
                            action="{{ url('admin/logo-idcard', $logo->id) }}">

                            <div class="modal-content modal-lg">
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit Data Logo</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="gambar" class="control-label">Logo</label>
                                                <input type="file" id="logo" name="logo" class="form-control">
                                                @error('logo')
                                                <p class="text-danger" style="font-size: 12px">* {{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="gambar" class="control-label">Logo Event</label>
                                                <input type="file" id="logo_event" name="logo_event" class="form-control">
                                                @error('logo_event')
                                                <p class="text-danger" style="font-size: 12px">* {{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="gambar" class="control-label">Background</label>
                                                <input type="file" id="background" name="background" class="form-control">
                                                @error('background')
                                                <p class="text-danger" style="font-size: 12px">* {{ $message }}</p>
                                                @enderror
                                            </div>
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
    <div class="modal fade" id="tambah-logo">
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
                                    <label for="gambar" class="control-label">Logo</label>
                                    <input type="file" id="logo" name="logo" class="form-control" required>
                                    @error('logo')
                                    <p class="text-danger" style="font-size: 12px">* {{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="gambar" class="control-label">Logo Event</label>
                                    <input type="file" id="logo_event" name="logo_event" class="form-control" required>
                                    @error('logo_event')
                                    <p class="text-danger" style="font-size: 12px">* {{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="gambar" class="control-label">Background</label>
                                    <input type="file" id="background" name="background" class="form-control" required>
                                    @error('background')
                                    <p class="text-danger" style="font-size: 12px">* {{ $message }}</p>
                                    @enderror
                                </div>
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