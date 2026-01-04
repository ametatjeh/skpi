@extends('prodi.layouts.app')

@section('title', 'Kelola CPL Prodi')

@section('content')
<style>
    /* ============ PREMIUM CPL MANAGEMENT STYLES ============ */
    .cpl-container * {
        box-sizing: border-box;
    }
    
    .cpl-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 16px;
    }
    
    /* Page Header */
    .page-header {
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        border-radius: 20px;
        padding: 28px 32px;
        margin-bottom: 24px;
        color: #fff;
        box-shadow: 0 8px 32px rgba(30, 64, 175, 0.25);
    }
    
    .page-header-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
    }
    
    .page-header-left {
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
    
    .page-header h1 {
        font-size: 24px;
        font-weight: 800;
        margin: 0 0 4px 0;
    }
    
    .page-header p {
        font-size: 14px;
        opacity: 0.9;
        margin: 0;
    }
    
    /* Stats Row */
    .stats-row {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }
    
    .stat-card {
        background: #fff;
        border-radius: 16px;
        padding: 20px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        display: flex;
        align-items: center;
        gap: 16px;
    }
    
    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
    }
    
    .stat-card.total .stat-icon { background: #dbeafe; color: #1e40af; }
    .stat-card.sikap .stat-icon { background: #dcfce7; color: #15803d; }
    .stat-card.pengetahuan .stat-icon { background: #fef3c7; color: #92400e; }
    .stat-card.keterampilan .stat-icon { background: #f3e8ff; color: #7c3aed; }
    
    .stat-value {
        font-size: 24px;
        font-weight: 800;
        color: #111827;
    }
    
    .stat-label {
        font-size: 12px;
        color: #6b7280;
        margin-top: 2px;
    }
    
    /* Alert Messages */
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
    
    .alert-success {
        background: linear-gradient(135deg, #dcfce7 0%, #bbf7d0 100%);
        color: #15803d;
        border: 1px solid #86efac;
    }
    
    .alert-error {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        color: #b91c1c;
        border: 1px solid #f87171;
    }
    
    .alert-close {
        margin-left: auto;
        background: none;
        border: none;
        cursor: pointer;
        opacity: 0.7;
        font-size: 18px;
    }
    
    /* Filter Section */
    .filter-section {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        padding: 20px 24px;
        margin-bottom: 24px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }
    
    .filter-form {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        align-items: center;
    }
    
    .filter-input, .filter-select {
        padding: 10px 14px;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        font-size: 14px;
        min-width: 160px;
        transition: all 0.2s;
    }
    
    .filter-input:focus, .filter-select:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    .filter-btn {
        padding: 10px 20px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
        text-decoration: none;
    }
    
    .filter-btn.primary {
        background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
        color: #fff;
    }
    
    .filter-btn.secondary {
        background: #f3f4f6;
        color: #374151;
    }
    
    /* Section Card */
    .section-card {
        background: #fff;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        overflow: hidden;
        margin-bottom: 24px;
    }
    
    .section-header {
        padding: 18px 24px;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .section-title {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 16px;
        font-weight: 700;
        color: #111827;
    }
    
    .section-title i {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
        color: #fff;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
    }
    
    .section-badge {
        padding: 6px 14px;
        background: #dbeafe;
        color: #1e40af;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
    }
    
    .section-body {
        padding: 24px;
    }
    
    /* Add Form */
    .add-form {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
    }
    
    .form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    
    .form-group.full-width {
        grid-column: 1 / -1;
    }
    
    .form-label {
        font-size: 13px;
        font-weight: 600;
        color: #374151;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }
    
    .form-input, .form-select, .form-textarea {
        padding: 12px 14px;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        font-size: 14px;
        transition: all 0.2s;
        width: 100%;
    }
    
    .form-input:focus, .form-select:focus, .form-textarea:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    .form-textarea {
        min-height: 80px;
        resize: vertical;
    }
    
    .form-actions {
        grid-column: 1 / -1;
        display: flex;
        gap: 12px;
        padding-top: 8px;
    }
    
    .btn {
        padding: 12px 24px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
        text-decoration: none;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
        color: #fff;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.35);
    }
    
    /* CPL Table */
    .cpl-table-wrapper {
        overflow-x: auto;
    }
    
    .cpl-table {
        width: 100%;
        min-width: 700px;
        border-collapse: collapse;
    }
    
    .cpl-table th,
    .cpl-table td {
        padding: 16px 20px;
        text-align: left;
        border-bottom: 1px solid #f1f5f9;
    }
    
    .cpl-table th {
        background: #f8fafc;
        font-size: 12px;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }
    
    .cpl-table tbody tr:hover {
        background: #f8fafc;
    }
    
    .cpl-table tbody tr:last-child td {
        border-bottom: none;
    }
    
    .kode-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        color: #1e40af;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
    }
    
    .kategori-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .kategori-badge.sikap { background: #dcfce7; color: #15803d; }
    .kategori-badge.pengetahuan { background: #fef3c7; color: #92400e; }
    .kategori-badge.keterampilan_umum { background: #dbeafe; color: #1e40af; }
    .kategori-badge.keterampilan_khusus { background: #f3e8ff; color: #7c3aed; }
    
    .deskripsi-text {
        font-size: 14px;
        color: #374151;
        line-height: 1.5;
        max-width: 400px;
    }
    
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
    }
    
    .status-badge.aktif { background: #dcfce7; color: #15803d; }
    .status-badge.nonaktif { background: #f3f4f6; color: #6b7280; }
    
    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 8px;
    }
    
    .btn-action {
        padding: 8px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }
    
    .btn-edit {
        background: #fef3c7;
        color: #92400e;
    }
    
    .btn-edit:hover {
        background: #fde68a;
    }
    
    .btn-delete {
        background: #fee2e2;
        color: #b91c1c;
    }
    
    .btn-delete:hover {
        background: #fecaca;
    }
    
    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 48px 20px;
        color: #9ca3af;
    }
    
    .empty-state i {
        font-size: 48px;
        margin-bottom: 16px;
        opacity: 0.5;
    }
    
    .empty-state h4 {
        font-size: 16px;
        font-weight: 600;
        color: #6b7280;
        margin-bottom: 4px;
    }
    
    /* Modal */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(4px);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }
    
    .modal-overlay.show {
        opacity: 1;
        visibility: visible;
    }
    
    .modal-content {
        background: #fff;
        border-radius: 20px;
        max-width: 600px;
        width: 90%;
        transform: scale(0.9);
        transition: transform 0.3s ease;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        overflow: hidden;
    }
    
    .modal-overlay.show .modal-content {
        transform: scale(1);
    }
    
    .modal-header {
        padding: 20px 24px;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .modal-header h3 {
        font-size: 18px;
        font-weight: 700;
        color: #111827;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .modal-header h3 i {
        color: #3b82f6;
    }
    
    .modal-close {
        background: none;
        border: none;
        font-size: 24px;
        color: #9ca3af;
        cursor: pointer;
        transition: color 0.2s;
    }
    
    .modal-close:hover {
        color: #374151;
    }
    
    .modal-body {
        padding: 24px;
    }
    
    .modal-form {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }
    
    .modal-actions {
        grid-column: 1 / -1;
        display: flex;
        gap: 12px;
        justify-content: flex-end;
        padding-top: 16px;
        border-top: 1px solid #e5e7eb;
    }
    
    .btn-secondary {
        background: #f3f4f6;
        color: #374151;
    }
    
    .btn-secondary:hover {
        background: #e5e7eb;
    }
    
    /* Pagination */
    .pagination-wrapper {
        padding: 16px 24px;
        border-top: 1px solid #e5e7eb;
        display: flex;
        justify-content: center;
    }
    
    /* Responsive */
    @media (max-width: 1024px) {
        .stats-row {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .add-form {
            grid-template-columns: 1fr;
        }
    }
    
    @media (max-width: 768px) {
        .page-header-content {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .stats-row {
            grid-template-columns: 1fr 1fr;
        }
        
        .filter-form {
            flex-direction: column;
        }
        
        .filter-input, .filter-select {
            width: 100%;
        }
        
        .modal-form {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="cpl-container">
    {{-- Page Header --}}
    <div class="page-header">
        <div class="page-header-content">
            <div class="page-header-left">
                <div class="header-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div>
                    <h1>Kelola CPL Prodi</h1>
                    <p>Atur daftar Capaian Pembelajaran Lulusan untuk program studi Anda</p>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Stats Row --}}
    @php
        $totalCpl = $cpl->total();
        $sikapCount = $cpl->where('kategori', 'sikap')->count();
        $pengetahuanCount = $cpl->where('kategori', 'pengetahuan')->count();
        $keterampilanCount = $cpl->whereIn('kategori', ['keterampilan_umum', 'keterampilan_khusus'])->count();
    @endphp
    
    <div class="stats-row">
        <div class="stat-card total">
            <div class="stat-icon">
                <i class="fas fa-list-alt"></i>
            </div>
            <div>
                <div class="stat-value">{{ $totalCpl }}</div>
                <div class="stat-label">Total CPL</div>
            </div>
        </div>
        
        <div class="stat-card sikap">
            <div class="stat-icon">
                <i class="fas fa-heart"></i>
            </div>
            <div>
                <div class="stat-value">{{ $sikapCount }}</div>
                <div class="stat-label">Sikap</div>
            </div>
        </div>
        
        <div class="stat-card pengetahuan">
            <div class="stat-icon">
                <i class="fas fa-brain"></i>
            </div>
            <div>
                <div class="stat-value">{{ $pengetahuanCount }}</div>
                <div class="stat-label">Pengetahuan</div>
            </div>
        </div>
        
        <div class="stat-card keterampilan">
            <div class="stat-icon">
                <i class="fas fa-tools"></i>
            </div>
            <div>
                <div class="stat-value">{{ $keterampilanCount }}</div>
                <div class="stat-label">Keterampilan</div>
            </div>
        </div>
    </div>
    
    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
            <button class="alert-close" onclick="this.parentElement.remove()">×</button>
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ session('error') }}</span>
            <button class="alert-close" onclick="this.parentElement.remove()">×</button>
        </div>
    @endif
    
    @if($errors->any())
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <div>
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
            <button class="alert-close" onclick="this.parentElement.remove()">×</button>
        </div>
    @endif
    
    {{-- Filter Section --}}
    <div class="filter-section">
        <form method="GET" action="{{ route('prodi.cpl.index') }}" class="filter-form">
            <input type="text" name="q" value="{{ request('q') }}" class="filter-input" placeholder="Cari kode atau deskripsi...">
            
            <select name="kategori" class="filter-select">
                <option value="">Semua Kategori</option>
                @foreach($kategori as $k)
                    <option value="{{ $k }}" {{ request('kategori') === $k ? 'selected' : '' }}>
                        {{ \Illuminate\Support\Str::title(str_replace('_', ' ', $k)) }}
                    </option>
                @endforeach
            </select>
            
            <select name="status" class="filter-select">
                <option value="">Semua Status</option>
                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Nonaktif</option>
            </select>
            
            <button type="submit" class="filter-btn primary">
                <i class="fas fa-search"></i> Filter
            </button>
            <a href="{{ route('prodi.cpl.index') }}" class="filter-btn secondary">
                <i class="fas fa-redo"></i> Reset
            </a>
        </form>
    </div>
    
    {{-- Add CPL Section --}}
    <div class="section-card">
        <div class="section-header">
            <div class="section-title">
                <i class="fas fa-plus-circle"></i>
                Tambah CPL Baru
            </div>
        </div>
        
        <div class="section-body">
            <form method="POST" action="{{ route('prodi.cpl.store') }}" class="add-form">
                @csrf
                <div class="form-group">
                    <label class="form-label">Kode CPL</label>
                    <input type="text" name="kode" class="form-input" required placeholder="Contoh: CPL-P01" value="{{ old('kode') }}">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Kategori</label>
                    <select name="kategori" class="form-select" required>
                        @foreach($kategori as $k)
                            <option value="{{ $k }}">
                                {{ \Illuminate\Support\Str::title(str_replace('_', ' ', $k)) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>
                </div>
                
                <div class="form-group full-width">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-textarea" required placeholder="Uraikan capaian pembelajaran...">{{ old('deskripsi') }}</textarea>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan CPL
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    {{-- CPL List --}}
    <div class="section-card">
        <div class="section-header">
            <div class="section-title">
                <i class="fas fa-list"></i>
                Daftar CPL
            </div>
            <span class="section-badge">{{ $cpl->total() }} CPL</span>
        </div>
        
        @if($cpl->count())
            <div class="cpl-table-wrapper">
                <table class="cpl-table">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Kategori</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cpl as $row)
                            <tr>
                                <td>
                                    <span class="kode-badge">
                                        <i class="fas fa-hashtag"></i>
                                        {{ $row->kode }}
                                    </span>
                                </td>
                                <td>
                                    @php
                                        $kategoriClass = str_replace(' ', '_', strtolower($row->kategori));
                                    @endphp
                                    <span class="kategori-badge {{ $kategoriClass }}">
                                        {{ \Illuminate\Support\Str::title(str_replace('_', ' ', $row->kategori)) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="deskripsi-text">{{ $row->deskripsi }}</div>
                                </td>
                                <td>
                                    @if($row->status)
                                        <span class="status-badge aktif">
                                            <i class="fas fa-check-circle"></i> Aktif
                                        </span>
                                    @else
                                        <span class="status-badge nonaktif">
                                            <i class="fas fa-minus-circle"></i> Nonaktif
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button type="button" class="btn-action btn-edit"
                                            onclick="openEditModal({{ $row->id }}, @js($row->kode), @js($row->kategori), @js($row->deskripsi), {{ (int)$row->status }})">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <form action="{{ route('prodi.cpl.destroy', $row->id) }}" method="POST" style="display:inline;"
                                            onsubmit="return confirm('Hapus CPL ini?')">
                                            @csrf @method('DELETE')
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
            
            @if($cpl->hasPages())
                <div class="pagination-wrapper">
                    {{ $cpl->links() }}
                </div>
            @endif
        @else
            <div class="empty-state">
                <i class="fas fa-folder-open"></i>
                <h4>Belum Ada Data CPL</h4>
                <p>Tambahkan CPL baru menggunakan form di atas.</p>
            </div>
        @endif
    </div>
</div>

{{-- Edit Modal --}}
<div class="modal-overlay" id="editModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3><i class="fas fa-edit"></i> Edit CPL</h3>
            <button class="modal-close" onclick="closeEditModal()">×</button>
        </div>
        <div class="modal-body">
            <form id="editForm" method="POST" class="modal-form">
                @csrf
                @method('PATCH')
                
                <div class="form-group">
                    <label class="form-label">Kode CPL</label>
                    <input type="text" id="e_kode" name="kode" class="form-input" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select id="e_status" name="status" class="form-select">
                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Kategori</label>
                    <select id="e_kategori" name="kategori" class="form-select" required>
                        @foreach($kategori as $k)
                            <option value="{{ $k }}">
                                {{ \Illuminate\Support\Str::title(str_replace('_', ' ', $k)) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group full-width">
                    <label class="form-label">Deskripsi</label>
                    <textarea id="e_deskripsi" name="deskripsi" class="form-textarea" required></textarea>
                </div>
                
                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeEditModal()">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function openEditModal(id, kode, kategori, deskripsi, status) {
    const modal = document.getElementById('editModal');
    const form = document.getElementById('editForm');
    
    form.action = '{{ url("prodi/cpl") }}/' + id;
    document.getElementById('e_kode').value = kode;
    document.getElementById('e_kategori').value = kategori;
    document.getElementById('e_deskripsi').value = deskripsi;
    document.getElementById('e_status').value = String(status ? 1 : 0);
    
    modal.classList.add('show');
}

function closeEditModal() {
    document.getElementById('editModal').classList.remove('show');
}

// Close modal on overlay click
document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeEditModal();
    }
});

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeEditModal();
    }
});
</script>
@endpush
