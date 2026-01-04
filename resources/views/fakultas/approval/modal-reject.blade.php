<div id="modal-reject" class="modal-overlay" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-header">
            <h2>Tolak SKPI</h2>
            <button type="button" class="modal-close" onclick="hideRejectModal()">×</button>
        </div>
        <div class="modal-body">
            <p>Anda akan menolak SKPI mahasiswa ini di level Fakultas.</p>
            <p>Alasan penolakan wajib diisi, minimal 10 karakter.</p>

            <form id="rejectForm" method="POST">
                @csrf
                <textarea name="catatan" rows="3" class="modal-textarea" placeholder="Tuliskan alasan penolakan..." required></textarea>

                <div class="modal-actions">
                    <button type="button" class="btn btn-light" onclick="hideRejectModal()">Batal</button>
                    <button type="submit" class="btn btn-danger">Tolak SKPI</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* gunakan kelas yang sama dengan modal approve */
    .btn-danger {
        background: #dc2626;
        border-color: #dc2626;
        color: #ffffff;
    }

    .btn-danger:hover {
        background: #b91c1c;
    }
</style>

<script>
    function showRejectModal(actionUrl) {
        const form = document.getElementById('rejectForm');
        form.action = actionUrl;
        document.getElementById('modal-reject').style.display = 'flex';
    }

    function hideRejectModal() {
        document.getElementById('modal-reject').style.display = 'none';
    }
</script>
