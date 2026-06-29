/**
 * ============================================================
 * FAKULTAS DASHBOARD JS - SKPI System
 * Dashboard interactions and initialization
 * ============================================================
 */

document.addEventListener('DOMContentLoaded', function () {
    // Auto-hide flash messages after 5 seconds
    var flashMessages = document.querySelectorAll('.flash-message');
    flashMessages.forEach(function (msg) {
        setTimeout(function () {
            msg.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            msg.style.opacity = '0';
            msg.style.transform = 'translateY(-10px)';
            setTimeout(function () {
                msg.remove();
            }, 500);
        }, 5000);
    });

    // Notification bell toggle
    var notifBell = document.getElementById('notificationBell');
    var notifDropdown = document.getElementById('notificationDropdown');

    if (notifBell && notifDropdown) {
        notifBell.addEventListener('click', function (e) {
            e.stopPropagation();
            notifDropdown.classList.toggle('show');
        });

        document.addEventListener('click', function () {
            if (notifDropdown.classList.contains('show')) {
                notifDropdown.classList.remove('show');
            }
        });
    }

    // Stats card counter animation
    document.querySelectorAll('.stat-counter').forEach(function (counter) {
        var target = parseInt(counter.getAttribute('data-target')) || 0;
        var duration = 1000;
        var start = 0;
        var startTime = null;

        function animate(currentTime) {
            if (!startTime) startTime = currentTime;
            var progress = Math.min((currentTime - startTime) / duration, 1);
            counter.textContent = Math.floor(progress * target);
            if (progress < 1) {
                requestAnimationFrame(animate);
            } else {
                counter.textContent = target;
            }
        }

        requestAnimationFrame(animate);
    });
});
