@foreach (['success', 'warning', 'danger'] as $status)
@if (session($status))
<!-- Modal -->
<div class="modal fade" id="notifModal{{ $status }}" tabindex="-1" aria-labelledby="notifModalLabel{{ $status }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered shadow-sm border-0">
        <div class="modal-content">
            <div class="modal-body text-center">
                <!-- Ikon sesuai status -->
                @if($status == 'success')
                <div class="d-flex justify-content-center align-items-center pt-4">
                    <i class="bi bi-check-circle-fill text-success" style="font-size: 50px;"></i>
                </div>
                @elseif($status == 'warning')
                <div class="d-flex justify-content-center align-items-center pt-4">
                    <i class="bi bi-exclamation-triangle-fill text-warning" style="font-size: 50px;"></i>
                </div>
                @elseif($status == 'danger')
                <div class="d-flex justify-content-center align-items-center pt-4">
                    <i class="bi bi-x-circle-fill text-danger" style="font-size: 50px;"></i>
                </div>
                @endif
                <div class="mt-3 mb-5">
                    <h4 class="text-center text-2xl font-weight-bold">{{ session($status) }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endforeach

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        // Memeriksa apakah ada session yang dikirimkan untuk setiap status
        ['success', 'warning', 'danger'].forEach(status => {
            if (document.querySelector(`#notifModal${status}`)) {
                // Menampilkan modal jika ada session untuk status tersebut
                var myModal = new bootstrap.Modal(document.getElementById(`notifModal${status}`));
                myModal.show();

                // Menutup modal setelah 2000ms (2 detik)
                setTimeout(() => {
                    myModal.hide();
                }, 2000);
            }
        });
    });
</script>