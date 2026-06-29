/**
 * ============================================================
 * PUSAT BAHASA MAIN JS - SKPI System
 * Common scripts for pusat bahasa portal
 * ============================================================
 */

document.addEventListener('DOMContentLoaded', function () {
    // Auto-hide flash messages
    var flashMessages = document.querySelectorAll('[data-flash]');
    flashMessages.forEach(function (msg) {
        setTimeout(function () {
            msg.style.transition = 'opacity 0.5s ease';
            msg.style.opacity = '0';
            setTimeout(function () {
                msg.remove();
            }, 500);
        }, 5000);
    });

    // Sidebar toggle for mobile
    var sidebarToggle = document.getElementById('sidebarToggle');
    var sidebar = document.getElementById('sidebar');

    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function () {
            sidebar.classList.toggle('mobile-open');
        });
    }

    // Table search
    var searchInputs = document.querySelectorAll('[data-table-search]');
    searchInputs.forEach(function (input) {
        input.addEventListener('input', function () {
            var tableId = this.getAttribute('data-table-search');
            var table = document.getElementById(tableId);
            if (!table) return;

            var query = this.value.toLowerCase();
            var rows = table.querySelectorAll('tbody tr');
            rows.forEach(function (row) {
                var text = row.textContent.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });
    });

    // Confirm delete
    document.querySelectorAll('[data-confirm]').forEach(function (el) {
        el.addEventListener('click', function (e) {
            var message = this.getAttribute('data-confirm') || 'Apakah Anda yakin?';
            if (!confirm(message)) {
                e.preventDefault();
            }
        });
    });
});
