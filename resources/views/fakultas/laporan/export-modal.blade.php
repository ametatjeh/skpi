{{-- resources/views/fakultas/laporan/export-modal.blade.php --}}
{{-- Include this modal partial in laporan/index.blade.php --}}

<style>
    .export-modal-overlay {
        display: none;
        position: fixed;
        top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(4px);
    }
    .export-modal-overlay.active { display: flex; animation: fadeIn 0.2s ease; }
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }

    .export-modal {
        background: #fff;
        border-radius: 20px;
        width: 480px;
        max-width: 95vw;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        animation: slideUp 0.3s ease;
    }
    @keyframes slideUp { from { transform: translateY(20px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

    .export-modal-header {
        padding: 20px 24px;
        background: linear-gradient(135deg, #7c3aed, #8b5cf6);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .export-modal-header h3 { font-size: 18px; font-weight: 700; margin: 0; }
    .export-modal-close {
        background: rgba(255,255,255,0.2);
        border: none; color: #fff;
        width: 32px; height: 32px;
        border-radius: 8px; cursor: pointer;
        font-size: 14px; transition: background 0.2s;
    }
    .export-modal-close:hover { background: rgba(255,255,255,0.3); }

    .export-modal-body { padding: 24px; }
    .export-form-group { margin-bottom: 18px; }
    .export-form-group label {
        display: block; font-size: 13px; font-weight: 600; color: #374151; margin-bottom: 8px;
    }
    .export-form-group label i { margin-right: 6px; color: #7c3aed; }
    .export-input, .export-select {
        width: 100%; padding: 10px 14px;
        border: 2px solid #e5e7eb; border-radius: 10px;
        font-size: 14px; color: #111827; background: #fff;
        transition: border-color 0.2s; font-family: 'Inter', sans-serif;
    }
    .export-input:focus, .export-select:focus {
        outline: none; border-color: #7c3aed;
        box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.1);
    }

    .export-format-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 18px; }
    .export-format-btn {
        padding: 16px;
        border: 2px solid #e5e7eb; border-radius: 12px;
        background: #fff; cursor: pointer;
        text-align: center; transition: all 0.2s;
        text-decoration: none; color: inherit;
        display: flex; flex-direction: column;
        align-items: center; gap: 8px;
    }
    .export-format-btn:hover { border-color: #7c3aed; background: #faf5ff; }
    .export-format-btn i { font-size: 28px; }
    .export-format-btn .pdf-icon { color: #ef4444; }
    .export-format-btn .excel-icon { color: #10b981; }
    .export-format-btn span { font-size: 13px; font-weight: 600; color: #374151; }

    .export-modal-footer {
        padding: 16px 24px;
        border-top: 1px solid #e5e7eb;
        display: flex; justify-content: flex-end; gap: 10px;
        background: #f8fafc;
    }
    .btn-cancel {
        padding: 10px 20px; border: 2px solid #e5e7eb; border-radius: 10px;
        background: #fff; color: #6b7280; font-size: 13px; font-weight: 600;
        cursor: pointer; transition: all 0.2s;
    }
    .btn-cancel:hover { background: #f1f5f9; }
</style>

<div class="export-modal-overlay" id="exportModal">
    <div class="export-modal">
        <div class="export-modal-header">
            <h3><i class="fas fa-download" style="margin-right:8px"></i> Export Laporan</h3>
            <button type="button" class="export-modal-close" onclick="closeExportModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="export-modal-body">
            <div class="export-form-group">
                <label><i class="fas fa-filter"></i> Filter Periode</label>
                <div style="display:flex;gap:10px">
                    <input type="date" class="export-input" id="exportDari" value="{{ request('dari') }}">
                    <input type="date" class="export-input" id="exportSampai" value="{{ request('sampai') }}">
                </div>
            </div>

            <div class="export-form-group">
                <label><i class="fas fa-building"></i> Program Studi</label>
                <select class="export-select" id="exportProdi">
                    <option value="">Semua Prodi</option>
                    @foreach($prodis ?? [] as $prodi)
                        <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                    @endforeach
                </select>
            </div>

            <label style="font-size:13px;font-weight:600;color:#374151;margin-bottom:10px;display:block">
                <i class="fas fa-file-export" style="margin-right:6px;color:#7c3aed"></i> Pilih Format
            </label>
            <div class="export-format-grid">
                <a href="#" class="export-format-btn" id="btnExportPdf" onclick="doExport('pdf')">
                    <i class="fas fa-file-pdf pdf-icon"></i>
                    <span>Export PDF</span>
                </a>
                <a href="#" class="export-format-btn" id="btnExportExcel" onclick="doExport('excel')">
                    <i class="fas fa-file-excel excel-icon"></i>
                    <span>Export Excel</span>
                </a>
            </div>
        </div>
        <div class="export-modal-footer">
            <button type="button" class="btn-cancel" onclick="closeExportModal()">Batal</button>
        </div>
    </div>
</div>

<script>
    function openExportModal() {
        document.getElementById('exportModal').classList.add('active');
    }
    function closeExportModal() {
        document.getElementById('exportModal').classList.remove('active');
    }
    function doExport(format) {
        var dari = document.getElementById('exportDari').value;
        var sampai = document.getElementById('exportSampai').value;
        var prodi = document.getElementById('exportProdi').value;
        var params = '?dari=' + dari + '&sampai=' + sampai + '&prodi_id=' + prodi;

        if (format === 'pdf') {
            window.location.href = "{{ route('fakultas.laporan.export.pdf') }}" + params;
        } else {
            window.location.href = "{{ route('fakultas.laporan.export.excel') }}" + params;
        }
        closeExportModal();
    }
    document.getElementById('exportModal').addEventListener('click', function(e) {
        if (e.target === this) closeExportModal();
    });
</script>
