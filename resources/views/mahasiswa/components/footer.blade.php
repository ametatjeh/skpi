{{-- resources/views/mahasiswa/components/footer.blade.php --}}
<style>
    .mahasiswa-footer {
        padding: 20px 28px;
        border-top: 1px solid #e5e7eb;
        background: #f0f9ff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        font-size: 13px;
        color: #6b7280;
        margin-top: auto;
    }

    .mahasiswa-footer a {
        color: #0891b2;
        text-decoration: none;
        font-weight: 600;
    }

    .mahasiswa-footer a:hover {
        text-decoration: underline;
    }

    .mahasiswa-footer-brand {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
        color: #374151;
    }

    .mahasiswa-footer-brand i {
        color: #0891b2;
    }

    @media (max-width: 768px) {
        .mahasiswa-footer {
            flex-direction: column;
            text-align: center;
        }
    }
</style>

<footer class="mahasiswa-footer">
    <div class="mahasiswa-footer-brand">
        <i class="fas fa-graduation-cap"></i>
        <span>Sistem SKPI &mdash; {{ config('app.name', 'UNIDA') }}</span>
    </div>
    <div>
        &copy; {{ date('Y') }} All rights reserved. <a href="{{ route('home') }}">SKPI UNIDA</a>
    </div>
</footer>
