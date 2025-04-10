<div class="modal fade" id="{{ $id ?? '' }}">
    <div class="modal-dialog">
        <form action="{{ $action ?? '' }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{ $slot }}
        </form>
    </div>
    <!-- /.modal-dialog -->
</div>