<x-app title="A-Labs | Pengumuman">
    <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px"> Pengumuman </h5>
    <hr>
    <div class="card shadow-lg" style="margin: auto; border-radius: 10px;">
        <div class="card-body">
            <div class="table-responsive">
                <a href="" data-toggle="modal" data-target="#tambah-pengumuman" class="btn btn-dark float-right ml-2"><i class="fas fa-plus"></i> Tambah Data</a>
                <table id="data-table" class="table table-datatable table-bordered">
                    <thead class="bg-dark">
                        <th width="10px" class="text-center" style="color: white;">No</th>
                        <th class="text-center" style="color: white;">Judul</th>
                        <th class="text-center" style="color: white;">Tanggal Pengiriman</th>
                        <th class="text-center" style="color: white;">Isi</th>
                        <th width="10px" class="text-center" style="color: white;">Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($pengumuman as $pengumuman)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $pengumuman->judul_pesan }}</td>
                            <td class="text-center">{{ $pengumuman->tanggal_string }}</td>
                            <td class="text-center">{{ $pengumuman->pesan }}</td>
                            <td class="text-center">
                                <a href="#hapus{{ $pengumuman->id }}" data-toggle="modal" class="btn btn-danger btn-interactive">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>

                        <x-template.modal.modal-delete id="hapus{{ $pengumuman->id }}"
                            action="{{ url('admin/pengumuman', $pengumuman->id) }}" />
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambah-pengumuman">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Pengumuman</h4>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row satker-group">
                            <div class="form-group col-md-12">
                                <div class="form-group">
                                    <label for="judul_pesan" class="control-label">Judul Pesan</label>
                                    <input type="text" name="judul_pesan" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="message">Pesan:</label>
                                <textarea class="form-control" id="message" name="pesan" rows="4" required></textarea>
                            </div>
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