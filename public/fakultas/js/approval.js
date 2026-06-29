/**
 * ============================================================
 * FAKULTAS APPROVAL JS - SKPI System
 * Handles approval/rejection actions for fakultas verifikasi
 * ============================================================
 */

document.addEventListener('DOMContentLoaded', function () {
    // Confirm approve action
    document.querySelectorAll('.btn-approve-action').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            if (!confirm('Apakah Anda yakin ingin menyetujui pengajuan ini?')) {
                e.preventDefault();
            }
        });
    });

    // Confirm reject action
    document.querySelectorAll('.btn-reject-action').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            if (!confirm('Apakah Anda yakin ingin menolak pengajuan ini?')) {
                e.preventDefault();
            }
        });
    });

    // Toggle catatan textarea on reject
    document.querySelectorAll('.btn-toggle-catatan').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var targetId = this.getAttribute('data-target');
            var target = document.getElementById(targetId);
            if (target) {
                target.style.display = target.style.display === 'none' ? 'block' : 'none';
            }
        });
    });
});
