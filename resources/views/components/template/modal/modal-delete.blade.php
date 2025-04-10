<div class="modal fade {{ $class ?? '' }}" id="{{ $id ?? '' }}">
    <div class="modal-dialog shadow-sm border-0 modal-dialog-centered">
        <form action="{{ $action ?? '' }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('delete')
            <div class="modal-content">
                <div class="d-flex justify-content-center align-items-center pt-4">
                    <i class="fas fa-info-circle text-danger" style="font-size: 50px;"></i>
                </div>
                <div class="modal-body">
                    <h2 class="text-center text-2xl font-weight-bold">Yakin ingin menghapus data ini ?!</h2>
                    <p class="text-center font-weight-medium">Data yang telah dihapus tidak bisa dikembalikan lagi!</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-success btn-interactive" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger btn-interactive">Tetap Hapus</button>
                </div>
            </div>
        </form>
    </div>
    <!-- /.modal-dialog -->
</div>