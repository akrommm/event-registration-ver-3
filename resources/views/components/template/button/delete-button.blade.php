<form action="{{ url($url, $id) }}" method="post" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
    @csrf
    @method('delete')
    <button class="btn btn-danger btn-interactive"><i class="fas fa-trash"></i></button>
</form>