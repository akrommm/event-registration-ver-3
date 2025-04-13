<x-app title="A-Labs | Profile ">
    <div class="card-header">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px"> Profile
        </h5>
    </div>
    <br>
    <div class="row">
        <div class="col-md-3 mb-2">
            <div class="card shadow-lg" style="margin: auto; border-radius: 10px;">
                <div class="card-body">
                    @if ($user->foto)
                    <img src="{{ url($user->foto) }}" class="img-fluid" alt="">
                    @else
                    <img src="{{url('/')}}/assets/images/logo/profile.jpg" class="img-fluid" alt="">
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card shadow-lg" style="margin: auto; border-radius: 10px;">
                <div class="card-header">
                    <a href="{{ url('admin/profile', $user->id) }}/edit" class="btn btn-warning btn-interactive btn-sm float-right mt-3 mb-3">Edit</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <dt class="font-weight-bold">NAMA LENGKAP</dt>
                            <dd>{{ $user->nama }}</dd>
                        </div>
                        <div class="col-md-6">
                            <dt class="font-weight-bold">USERNAME</dt>
                            <dd>{{ $user->username }}</dd>
                        </div>
                        <div class="col-md-12">
                            <dt class="font-weight-bold">EMAIL</dt>
                            <dd>{{ $user->email }}</dd>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>