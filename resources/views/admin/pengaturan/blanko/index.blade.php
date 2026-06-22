@extends('admin.layouts.app')

@section('title', 'Manajemen Stok Blanko SKPI')

@push('styles')
<style>
    /* ============ PREMIUM STOK BLANKO STYLES ============ */
    .blanko-container {
        max-width: 1200px;
        margin: 0 auto;
    }
    
    .page-header {
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        border-radius: 20px;
        padding: 28px 32px;
        margin-bottom: 24px;
        color: #fff;
        box-shadow: 0 8px 32px rgba(59, 130, 246, 0.25);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }
    
    .header-content {
        display: flex;
        align-items: center;
        gap: 16px;
    }
    
    .header-icon {
        width: 56px;
        height: 56px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }
    
    .header-text h1 {
        font-size: 24px;
        font-weight: 800;
        margin: 0 0 4px 0;
    }
    
    .header-text p {
        font-size: 14px;
        opacity: 0.9;
        margin: 0;
    }
    
    .btn-add {
        padding: 12px 24px;
        background: #fff;
        color: #1e3a8a;
        border-radius: 12px;
        font-size: 14px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }
    
    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 255, 255, 0.3);
    }
    
    /* Stats Row */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-bottom: 24px;
    }
    
    .stat-card {
        background: #fff;
        border-radius: 16px;
        padding: 24px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        display: flex;
        align-items: center;
        gap: 16px;
    }
    
    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }
    
    .stat-card.masuk .stat-icon { background: #dcfce7; color: #15803d; }
    .stat-card.keluar .stat-icon { background: #fee2e2; color: #b91c1c; }
    .stat-card.sisa .stat-icon { background: #dbeafe; color: #1e40af; }
    
    .stat-info h4 {
        font-size: 13px;
        color: #6b7280;
        margin: 0 0 4px 0;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .stat-info .stat-value {
        font-size: 28px;
        font-weight: 800;
        color: #111827;
        margin: 0;
    }
    
    /* Alerts */
    .alert {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 18px;
        border-radius: 12px;
        margin-bottom: 20px;
        font-size: 14px;
        font-weight: 500;
    }
    
    .alert-success { background: #dcfce7; color: #15803d; border: 1px solid #86efac; }
    .alert-error { background: #fee2e2; color: #b91c1c; border: 1px solid #f87171; }
    
    /* Table Card */
    .section-card {
        background: #fff;
        border-radius: 20px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.04);
        overflow: hidden;
    }
    
    .section-header {
        padding: 20px 24px;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .section-title {
        font-size: 16px;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }
    
    .table-responsive {
        overflow-x: auto;
    }
    
    .custom-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .custom-table th {
        background: #fafbfc;
        padding: 16px 20px;
        text-align: left;
        font-size: 12px;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .custom-table td {
        padding: 16px 20px;
        border-bottom: 1px solid #f1f5f9;
        font-size: 14px;
        color: #374151;
        vertical-align: middle;
    }
    
    .custom-table tbody tr:hover {
        background: #f8fafc;
    }
    
    .custom-table tbody tr:last-child td {
        border-bottom: none;
    }
    
    .badge-jumlah {
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 13px;
    }
    
    .badge-masuk { background: #dcfce7; color: #15803d; }
    .badge-keluar { background: #fee2e2; color: #b91c1c; }
    
    .action-buttons {
        display: flex;
        gap: 8px;
    }
    
    .btn-action {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        font-size: 14px;
    }
    
    .btn-edit { background: #dbeafe; color: #1e40af; }
    .btn-edit:hover { background: #bfdbfe; }
    
    .btn-delete { background: #fee2e2; color: #b91c1c; }
    .btn-delete:hover { background: #fecaca; }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }
    
    .empty-state i {
        font-size: 64px;
        color: #d1d5db;
        margin-bottom: 16px;
    }
    
    .empty-state h3 {
        font-size: 18px;
        font-weight: 700;
        color: #374151;
        margin-bottom: 8px;
    }
    
    .empty-state p {
        font-size: 14px;
        color: #6b7280;
    }
    
    /* Modal */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        backdrop-filter: blur(4px);
    }
    
    .modal-overlay.show {
        display: flex;
        animation: fadeIn 0.2s ease;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    .modal-content {
        background: #fff;
        border-radius: 20px;
        width: 100%;
        max-width: 500px;
        overflow: hidden;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        transform: scale(0.95);
        transition: transform 0.2s ease;
    }
    
    .modal-overlay.show .modal-content {
        transform: scale(1);
    }
    
    .modal-header {
        padding: 20px 24px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .modal-header h3 {
        margin: 0;
        font-size: 18px;
        font-weight: 700;
        color: #111827;
    }
    
    .modal-close {
        background: none;
        border: none;
        font-size: 20px;
        color: #6b7280;
        cursor: pointer;
    }
    
    .modal-body {
        padding: 24px;
    }
    
    .form-group {
        margin-bottom: 16px;
    }
    
    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }
    
    .form-input {
        width: 100%;
        padding: 10px 14px;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        font-size: 14px;
        transition: border-color 0.2s;
    }
    
    .form-input:focus {
        outline: none;
        border-color: #3b82f6;
    }
    
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }
    
    .modal-footer {
        padding: 16px 24px;
        background: #f8fafc;
        border-top: 1px solid #e5e7eb;
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }
    
    .btn-cancel {
        padding: 10px 20px;
        background: #fff;
        border: 1px solid #d1d5db;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        cursor: pointer;
    }
    
    .btn-submit {
        padding: 10px 20px;
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        border: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        color: #fff;
        cursor: pointer;
    }
    
    @media (max-width: 768px) {
        .stats-row {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="blanko-container">
    {{-- Page Header --}}
    <div class="page-header">
        <div class="header-content">
            <div class="header-icon">
                <i class="fas fa-boxes"></i>
            </div>
            <div class="header-text">
                <h1>Stok Blanko SKPI</h1>
                <p>Manajemen ketersediaan kertas blanko hologram untuk cetak SKPI</p>
            </div>
        </div>
        <button class="btn-add" onclick="openModal('add')">
            <i class="fas fa-plus"></i> Tambah Data
        </button>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
            <button class="alert-close" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
        </div>
    @endif
    
    @if($errors->any())
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            Terdapat kesalahan pada input Anda.
            <button class="alert-close" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>
        </div>
    @endif

    {{-- Stats Row --}}
    <div class="stats-row">
        <div class="stat-card masuk">
            <div class="stat-icon"><i class="fas fa-arrow-down"></i></div>
            <div class="stat-info">
                <h4>Total Masuk</h4>
                <div class="stat-value">{{ number_format($totalMasuk ?? 0, 0, ',', '.') }}</div>
            </div>
        </div>
        <div class="stat-card keluar">
            <div class="stat-icon"><i class="fas fa-arrow-up"></i></div>
            <div class="stat-info">
                <h4>Total Keluar</h4>
                <div class="stat-value">{{ number_format($totalKeluar ?? 0, 0, ',', '.') }}</div>
            </div>
        </div>
        <div class="stat-card sisa">
            <div class="stat-icon"><i class="fas fa-box"></i></div>
            <div class="stat-info">
                <h4>Stok Tersedia</h4>
                <div class="stat-value">{{ number_format($stokTersedia ?? 0, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>

    {{-- Table Section --}}
    <div class="section-card">
        <div class="section-header">
            <i class="fas fa-list" style="width:36px;height:36px;background:#3b82f6;color:#fff;display:flex;align-items:center;justify-content:center;border-radius:10px;"></i>
            <h3 class="section-title">Riwayat Stok Blanko</h3>
        </div>
        
        @if(count($data) > 0)
            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Pengadaan</th>
                            <th>Jumlah Masuk</th>
                            <th>Jumlah Keluar</th>
                            <th>Stok Tersisa</th>
                            <th>Keterangan</th>
                            <th style="width: 100px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $idx => $item)
                            <tr>
                                <td>{{ $idx + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_pengadaan)->format('d M Y') }}</td>
                                <td>
                                    @if($item->jumlah_masuk > 0)
                                        <span class="badge-jumlah badge-masuk">+{{ $item->jumlah_masuk }}</span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    @if($item->jumlah_keluar > 0)
                                        <span class="badge-jumlah badge-keluar">-{{ $item->jumlah_keluar }}</span>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td><strong>{{ $item->stok_tersisa }}</strong></td>
                                <td>{{ $item->keterangan ?? '-' }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn-action btn-edit" onclick="openModal('edit', {{ json_encode($item) }})">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <form action="{{ route('admin.blanko.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-clipboard-list"></i>
                <h3>Belum ada data</h3>
                <p>Klik tombol "Tambah Data" untuk menambahkan stok blanko</p>
            </div>
        @endif
    </div>
</div>

{{-- Modal Form --}}
<div class="modal-overlay" id="formModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 id="modalTitle">Tambah Data Stok</h3>
            <button class="modal-close" onclick="closeModal()"><i class="fas fa-times"></i></button>
        </div>
        <form id="blankoForm" method="POST" action="{{ route('admin.blanko.store') }}">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">
            
            <div class="modal-body">
                <div class="form-group">
                    <label class="form-label">Tanggal Pengadaan / Transaksi <span style="color:#ef4444">*</span></label>
                    <input type="date" name="tanggal_pengadaan" id="tanggal_pengadaan" class="form-input" required value="{{ date('Y-m-d') }}">
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Jumlah Masuk <span style="color:#ef4444">*</span></label>
                        <input type="number" name="jumlah_masuk" id="jumlah_masuk" class="form-input" required min="0" value="0">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Jumlah Keluar <span style="color:#ef4444">*</span></label>
                        <input type="number" name="jumlah_keluar" id="jumlah_keluar" class="form-input" required min="0" value="0">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" class="form-input" rows="3" placeholder="Contoh: Pengadaan blanko bulan November"></textarea>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="closeModal()">Batal</button>
                <button type="submit" class="btn-submit"><i class="fas fa-save"></i> Simpan Data</button>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
    function openModal(mode, data = null) {
        const modal = document.getElementById('formModal');
        const form = document.getElementById('blankoForm');
        const modalTitle = document.getElementById('modalTitle');
        const formMethod = document.getElementById('formMethod');
        
        if (mode === 'edit' && data) {
            modalTitle.textContent = 'Edit Data Stok';
            form.action = `/admin/blanko/${data.id}`;
            formMethod.value = 'PUT';
            
            document.getElementById('tanggal_pengadaan').value = data.tanggal_pengadaan.split(' ')[0];
            document.getElementById('jumlah_masuk').value = data.jumlah_masuk;
            document.getElementById('jumlah_keluar').value = data.jumlah_keluar;
            document.getElementById('keterangan').value = data.keterangan || '';
        } else {
            modalTitle.textContent = 'Tambah Data Stok';
            form.action = '{{ route("admin.blanko.store") }}';
            formMethod.value = 'POST';
            
            document.getElementById('tanggal_pengadaan').value = '{{ date("Y-m-d") }}';
            document.getElementById('jumlah_masuk').value = '0';
            document.getElementById('jumlah_keluar').value = '0';
            document.getElementById('keterangan').value = '';
        }
        
        modal.classList.add('show');
    }
    
    function closeModal() {
        document.getElementById('formModal').classList.remove('show');
    }
    
    // Close modal when clicking outside
    document.getElementById('formModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
</script>
@endpush
