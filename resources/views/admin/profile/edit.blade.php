<x-app title="A-Labs | Edit Profile ">
    <div class="card-header">
        <h5 class="m-0 font-weight-bold text-dark" style="text-align:center; font-size: 25px"> Edit Profile
        </h5>
    </div>
    <br>
    <button onclick="goBack()" class="btn btn-sm btn-primary btn-interactive"><i class="fas fa-arrow-left"></i>
        Kembali</button>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
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
                    <div class="card-title">
                        EDIT DATA ADMIN
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/profile', $user->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="control-label">NAMA LENGKAP</label>
                                    <input type="text" name="nama" class="form-control" value="{{ $user->nama }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="control-label">USERNAME</label>
                                    <input type="text" name="username" class="form-control" value="{{ $user->username }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="control-label">FOTO</label>
                                    <input type="file" name="foto" accept=".jpg, .png, .jpeg" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="" class="control-label">EMAIL</label>
                                    <input type="text" name="email" class="form-control" value="{{ $user->email }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="control-label">PASSWORD</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-primary btn-interactive float-right">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app>