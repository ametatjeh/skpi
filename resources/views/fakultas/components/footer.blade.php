{{-- resources/views/fakultas/components/footer.blade.php --}}
<style>
    .fakultas-footer {
        padding: 20px 28px;
        border-top: 1px solid #e5e7eb;
        background: #faf5ff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        font-size: 13px;
        color: #6b7280;
        margin-top: auto;
    }

    .fakultas-footer a {
        color: #7c3aed;
        text-decoration: none;
        font-weight: 600;
    }

    .fakultas-footer a:hover {
        text-decoration: underline;
    }

    .fakultas-footer-brand {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
        color: #374151;
    }

    .fakultas-footer-brand i {
        color: #7c3aed;
    }

    @media (max-width: 768px) {
        .fakultas-footer {
            flex-direction: column;
            text-align: center;
        }
    }
</style>

<footer class="fakultas-footer">
    <div class="fakultas-footer-brand">
        <i class="fas fa-graduation-cap"></i>
        <span>Sistem SKPI &mdash; {{ config('app.name', 'UNIDA') }}</span>
    </div>
    <div>
        &copy; {{ date('Y') }} All rights reserved. <a href="{{ route('home') }}">SKPI UNIDA</a>
    </div>
</footer>
