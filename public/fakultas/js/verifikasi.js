/**
 * ============================================================
 * FAKULTAS VERIFIKASI JS - SKPI System
 * Verifikasi page interactions
 * ============================================================
 */

document.addEventListener('DOMContentLoaded', function () {
    // Search/filter handler
    var searchInput = document.getElementById('searchVerifikasi');
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            var query = this.value.toLowerCase();
            var rows = document.querySelectorAll('.verifikasi-table tbody tr');
            rows.forEach(function (row) {
                var text = row.textContent.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });
    }

    // Select all checkbox
    var selectAll = document.getElementById('selectAll');
    if (selectAll) {
        selectAll.addEventListener('change', function () {
            var checkboxes = document.querySelectorAll('.row-checkbox');
            checkboxes.forEach(function (cb) {
                cb.checked = selectAll.checked;
            });
            updateBulkActions();
        });
    }

    // Individual checkboxes
    document.querySelectorAll('.row-checkbox').forEach(function (cb) {
        cb.addEventListener('change', updateBulkActions);
    });

    function updateBulkActions() {
        var checked = document.querySelectorAll('.row-checkbox:checked');
        var bulkBar = document.getElementById('bulkActionBar');
        var countDisplay = document.getElementById('selectedCount');

        if (bulkBar) {
            bulkBar.style.display = checked.length > 0 ? 'flex' : 'none';
        }
        if (countDisplay) {
            countDisplay.textContent = checked.length;
        }
    }

    // Modal open/close
    window.openVerifModal = function (modalId) {
        var modal = document.getElementById(modalId);
        if (modal) modal.classList.add('active');
    };

    window.closeVerifModal = function (modalId) {
        var modal = document.getElementById(modalId);
        if (modal) modal.classList.remove('active');
    };
});
