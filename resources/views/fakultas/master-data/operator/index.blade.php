@extends('fakultas.layouts.app')
@section('title', 'Daftar Operator')
@push('styles')
<style>
    .page-header { background:linear-gradient(135deg,#7c3aed 0%,#8b5cf6 50%,#a78bfa 100%); border-radius:20px; padding:28px 32px; margin-bottom:24px; color:#fff; position:relative; overflow:hidden; box-shadow:0 10px 40px rgba(124,58,237,0.25); }
    .page-header::before { content:''; position:absolute; top:-50%; right:-20%; width:400px; height:400px; background:radial-gradient(circle,rgba(255,255,255,0.1) 0%,transparent 70%); border-radius:50%; }
    .page-header h1 { font-size:24px; font-weight:800; margin:0 0 6px 0; position:relative; z-index:1; }
    .page-header p { font-size:14px; opacity:0.9; margin:0; position:relative; z-index:1; }
    .header-actions { margin-top:14px; position:relative; z-index:1; }
    .btn-add { padding:10px 22px; background:rgba(255,255,255,0.2); color:#fff; border:none; border-radius:10px; font-size:13px; font-weight:600; text-decoration:none; display:inline-flex; align-items:center; gap:8px; backdrop-filter:blur(4px); transition:all 0.2s; }
    .btn-add:hover { background:rgba(255,255,255,0.3); transform:translateY(-2px); }
    .data-card { background:#fff; border-radius:16px; border:1px solid #e5e7eb; box-shadow:0 4px 16px rgba(0,0,0,0.04); overflow:hidden; }
    .card-header { padding:18px 24px; border-bottom:1px solid #f1f5f9; display:flex; align-items:center; gap:12px; background:linear-gradient(135deg,#faf5ff,#f3e8ff); }
    .card-header-icon { width:40px; height:40px; background:linear-gradient(135deg,#7c3aed,#8b5cf6); color:#fff; border-radius:10px; display:flex; align-items:center; justify-content:center; }
    .card-header h3 { font-size:16px; font-weight:700; color:#111827; margin:0; }
    .modern-table { width:100%; border-collapse:collapse; }
    .modern-table thead th { padding:14px 20px; text-align:left; font-size:12px; font-weight:700; color:#6b7280; text-transform:uppercase; background:#f8fafc; border-bottom:1px solid #e5e7eb; }
    .modern-table tbody td { padding:14px 20px; border-bottom:1px solid #f1f5f9; font-size:14px; color:#374151; }
    .modern-table tbody tr:hover { background:#faf5ff; }
    .btn-sm { padding:6px 14px; border-radius:8px; font-size:12px; font-weight:600; text-decoration:none; display:inline-flex; align-items:center; gap:4px; transition:all 0.2s; }
    .btn-sm.edit { background:#f3e8ff; color:#7c3aed; }
    .btn-sm.delete { background:#fee2e2; color:#dc2626; border:none; cursor:pointer; }
    .empty-state { text-align:center; padding:40px; color:#9ca3af; }
    .empty-state i { font-size:36px; opacity:0.4; display:block; margin-bottom:8px; color:#a78bfa; }
</style>
@endpush

@section('content')
    <div class="page-header">
        <h1><i class="fas fa-users-cog" style="margin-right:10px"></i> Daftar Operator Fakultas</h1>
        <p>Kelola akun operator yang memiliki akses ke dashboard fakultas</p>
        <div class="header-actions">
            <a href="{{ route('fakultas.operators.create') }}" class="btn-add"><i class="fas fa-plus"></i> Tambah Operator</a>
        </div>
    </div>

    <div class="data-card">
        <div class="card-header">
            <div class="card-header-icon"><i class="fas fa-user-shield"></i></div>
            <h3>Operator Aktif</h3>
        </div>
        <div style="overflow-x:auto">
            <table class="modern-table">
                <thead>
                    <tr><th>Nama</th><th>Email</th><th>Status</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($operators ?? [] as $op)
                        <tr>
                            <td><strong>{{ $op->name }}</strong></td>
                            <td>{{ $op->email }}</td>
                            <td>
                                <span style="padding:4px 10px;border-radius:6px;font-size:11px;font-weight:600;{{ $op->is_activated ? 'background:#dcfce7;color:#15803d' : 'background:#fef3c7;color:#92400e' }}">
                                    {{ $op->is_activated ? 'Aktif' : 'Belum Aktif' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('fakultas.operators.edit', $op->id) }}" class="btn-sm edit"><i class="fas fa-edit"></i> Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4"><div class="empty-state"><i class="fas fa-users"></i>Belum ada operator</div></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
