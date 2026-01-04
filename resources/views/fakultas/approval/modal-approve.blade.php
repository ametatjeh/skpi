<div id="modal-approve" class="modal-overlay" style="display:none;">
    <div class="modal-dialog">
        <div class="modal-header">
            <h2>Setujui SKPI</h2>
            <button type="button" class="modal-close" onclick="hideApproveModal()">×</button>
        </div>
        <div class="modal-body">
            <p>Anda akan menyetujui SKPI mahasiswa ini di level Fakultas.</p>
            <p>Jika perlu, tuliskan catatan singkat (opsional).</p>

            <form id="approveForm" method="POST">
                @csrf
                <textarea name="catatan" rows="3" class="modal-textarea" placeholder="Catatan persetujuan (opsional)"></textarea>

                <div class="modal-actions">
                    <button type="button" class="btn btn-light" onclick="hideApproveModal()">Batal</button>
                    <button type="submit" class="btn btn-success">Setujui SKPI</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.35);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 50;
    }

    .modal-dialog {
        width: 100%;
        max-width: 480px;
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.25);
        overflow: hidden;
        font-size: 14px;
    }

    .modal-header {
        padding: 10px 14px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-header h2 {
        margin: 0;
        font-size: 16px;
    }

    .modal-close {
        background: none;
        border: none;
        font-size: 18px;
        cursor: pointer;
        line-height: 1;
    }

    .modal-body {
        padding: 12px 16px 16px;
    }

    .modal-textarea {
        width: 100%;
        padding: 8px;
        border-radius: 4px;
        border: 1px solid #d1d5db;
        resize: vertical;
        font-size: 14px;
        margin-top: 6px;
    }

    .modal-actions {
        margin-top: 12px;
        display: flex;
        justify-content: flex-end;
        gap: 8px;
    }

    .btn {
        padding: 6px 10px;
        border-radius: 4px;
        font-size: 13px;
        border: 1px solid transparent;
        cursor: pointer;
    }

    .btn-light {
        background: #f9fafb;
        border-color: #d1d5db;
        color: #374151;
    }

    .btn-light:hover {
        background: #e5e7eb;
    }

    .btn-success {
        background: #16a34a;
        border-color: #16a34a;
        color: #ffffff;
    }

    .btn-success:hover {
        background: #15803d;
    }
</style>

<script>
    function showApproveModal(actionUrl) {
        const form = document.getElementById('approveForm');
        form.action = actionUrl;
        document.getElementById('modal-approve').style.display = 'flex';
    }

    function hideApproveModal() {
        document.getElementById('modal-approve').style.display = 'none';
    }
</script>
