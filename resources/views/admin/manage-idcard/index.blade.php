<x-app title="A-Labs | Kelola ID Card ">
    <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px">Data ID Card Panitia</h5>
    <hr>
    <div class="card shadow-lg" style="margin: auto; border-radius: 10px;">
        <div class="card-body">
            <div class="table-responsive">
                <a href="" data-toggle="modal" data-target="#tambah-idcard" class="btn btn-dark float-right ml-2"><i class="fas fa-plus"></i> Tambah Data</a>
                <table id="data-table" class="table table-datatable table-bordered">
                    <thead class="bg-dark">
                        <tr>
                            <th class="text-center text-white" width="10px">No.</th>
                            <th class="text-center text-white">Nama</th>
                            <th class="text-center text-white">ID</th>
                            <th class="text-center text-white">Role</th>
                            <th class="text-center text-white" width="100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peserta->sortByDesc('created_at')->values() as $key => $data)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="text-center">{{ $data->nama_peserta ?? '-' }}</td>
                            <td class="text-center">{{ $data->id_peserta }}</td>
                            <td class="text-center">
                                <span class="badge badge-success">{{ $data->role }}</span>
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

    <div class="modal fade" id="tambah-idcard">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Id card</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukan Nama">
                            @error('nama')
                            <p class="text-danger" style="font-size: 12px">* {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="photo">Pilih Role</label>
                            <select class="form-control" name="role" style="width: 100%;">
                                <option selected="selected">Pilih Role</option>
                                <option value="Panitia">Panitia</option>
                                <option value="PIC">PIC</option>
                                <option value="SC">SC</option>
                                <option value="OC">OC</option>
                                <option value="Tamu Undangan">Tamu Undangan</option>
                                <option value="Peninjau">Peninjau</option>
                                <option value="Media Pers">Media Pers</option>
                                <option value="Media Dokumentasi">Media Dokumentasi</option>
                                <option value="Keamanan">Keamanan</option>
                            </select>
                            @error('role')
                            <p class="text-danger" style="font-size: 12px">* {{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="photo">Pilih Event</label>
                            <select class="form-control" name="id_event" style="width: 100%;">
                                <option selected="selected">Pilih Event</option>
                                @foreach ($list_event as $event)
                                <option value="{{ $event->id }}">{{ $event->nama }}</option>
                                @endforeach
                            </select>
                            @error('id_event')
                            <p class="text-danger" style="font-size: 12px">* {{ $message }}</p>
                            @enderror
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