<x-app title="A-Labs | Dashboard ">

    <h5 class="m-0 font-weight-bold text-dark" style="font-size: 25px">
        Halo, {{ auth()->user()->nama }}
    </h5>
    <hr>
    <p class="mt-0 text-dark" style="font-size: 16px">
        Berikut ini adalah ringkasan informasi yang ada di A-Labs.
    </p>

    <div class="row mt-3">
        <div class="col-lg-3 col-6">
            <!-- Total Event Aktif -->
            <div class="card shadow-lg" style="margin: auto; border-radius: 10px;">
                <div class="card-body">
                    <div class="media align-items-center">
                        <div class="avatar avatar-icon avatar-lg avatar-cyan">
                            <i class="anticon anticon-calendar"></i>
                        </div>
                        <div class="m-l-15">
                            <h2 class="m-b-0">{{ $event }}</h2>
                            <p class="m-b-0 text-muted">Event Aktif</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card shadow-lg" style="margin: auto; border-radius: 10px;">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">
                        <i class="anticon anticon-usergroup-add text-primary"></i> Total Peserta per Event
                    </h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="">
                                <tr>
                                    <th class="text-center">Nama Event</th>
                                    <th class="text-center">Total Pendaftar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($participantsPerEvent as $event)
                                <tr>
                                    <td class="text-center">{{ $event->nama }}</td>
                                    <td class="text-center">{{ $event->total_peserta }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="2" class="text-center text-muted">Belum ada data.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app>