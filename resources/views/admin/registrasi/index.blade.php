<x-app title="A-Labs | Registrasi Event ">
    <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px">Registrasi Event</h5>
    <hr>
    <div class="card shadow-lg" style="margin: auto; border-radius: 10px;">
        <div class="card-body">
            <form action="{{ url('admin/registration') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="nama">Nama Peserta</label>
                    <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukan Nama" required>
                    @error('nama')
                    <p class="text-danger" style="font-size: 12px">* {{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="no_hp">Nomor WhatsApps</label>
                    <input type="text" name="no_hp" id="no_hp" class="form-control" placeholder="Masukan WhatsApps" required>
                    @error('no_hp')
                    <p class="text-danger" style="font-size: 12px">* {{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="photo">Foto</label>
                    <input type="file" name="photo" id="photo" accept=".jpg, .png, .jpeg" class="form-control" required>
                    @error('photo')
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

                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-90 mb-3 btn-interactive" style="font-size: 16px; border-radius: 10px;">Daftar</button>
                </div>
            </form>
        </div>
    </div>
</x-app>