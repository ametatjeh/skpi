@extends('fakultas.layouts.app')
@section('title', 'Profil Fakultas')
@push('styles')
<style>
    .profile-header { background:linear-gradient(135deg,#7c3aed 0%,#8b5cf6 50%,#a78bfa 100%); border-radius:20px; padding:32px; margin-bottom:24px; color:#fff; position:relative; overflow:hidden; box-shadow:0 10px 40px rgba(124,58,237,0.25); }
    .profile-header::before { content:''; position:absolute; top:-50%; right:-20%; width:400px; height:400px; background:radial-gradient(circle,rgba(255,255,255,0.1) 0%,transparent 70%); border-radius:50%; }
    .profile-header-content { display:flex; align-items:center; gap:24px; position:relative; z-index:1; }
    .profile-avatar { width:80px; height:80px; border-radius:20px; background:rgba(255,255,255,0.2); backdrop-filter:blur(8px); display:flex; align-items:center; justify-content:center; font-size:32px; font-weight:800; border:3px solid rgba(255,255,255,0.3); }
    .profile-header h1 { font-size:24px; font-weight:800; margin:0 0 6px 0; }
    .profile-header p { font-size:14px; opacity:0.9; margin:0; }
    .profile-badge { display:inline-flex; align-items:center; gap:6px; padding:6px 14px; background:rgba(255,255,255,0.2); backdrop-filter:blur(8px); border-radius:20px; font-size:12px; font-weight:600; margin-top:8px; }

    .info-card { background:#fff; border-radius:16px; border:1px solid #e5e7eb; box-shadow:0 4px 16px rgba(0,0,0,0.04); overflow:hidden; margin-bottom:20px; }
    .info-card-header { padding:18px 24px; border-bottom:1px solid #f1f5f9; display:flex; align-items:center; gap:12px; background:linear-gradient(135deg,#faf5ff,#f3e8ff); }
    .info-card-header-icon { width:40px; height:40px; background:linear-gradient(135deg,#7c3aed,#8b5cf6); color:#fff; border-radius:10px; display:flex; align-items:center; justify-content:center; }
    .info-card-header h3 { font-size:16px; font-weight:700; color:#111827; margin:0; }
    .info-card-body { padding:24px; }
    .info-grid { display:grid; grid-template-columns:repeat(2,1fr); gap:18px; }
    .info-item label { display:block; font-size:12px; font-weight:600; color:#6b7280; text-transform:uppercase; letter-spacing:0.5px; margin-bottom:4px; }
    .info-item span { font-size:15px; font-weight:600; color:#111827; }
    .btn-edit { padding:12px 28px; background:linear-gradient(135deg,#7c3aed,#8b5cf6); color:#fff; border:none; border-radius:10px; font-size:14px; font-weight:600; text-decoration:none; display:inline-flex; align-items:center; gap:8px; transition:all 0.2s; margin-top:20px; }
    .btn-edit:hover { transform:translateY(-2px); box-shadow:0 6px 20px rgba(124,58,237,0.35); }
    @media(max-width:768px) { .info-grid{grid-template-columns:1fr;} .profile-header-content{flex-direction:column;text-align:center;} }
</style>
@endpush
@section('content')
    @php $user = auth('fakultas')->user(); $fakultas = $user->fakultas ?? null; @endphp
    <div class="profile-header">
        <div class="profile-header-content">
            <div class="profile-avatar">{{ strtoupper(substr($user->name ?? 'F', 0, 2)) }}</div>
            <div>
                <h1>{{ $user->name ?? 'Operator Fakultas' }}</h1>
                <p><i class="fas fa-envelope" style="margin-right:6px"></i> {{ $user->email ?? '-' }}</p>
                <div class="profile-badge"><i class="fas fa-shield-alt"></i> Operator Fakultas</div>
            </div>
        </div>
    </div>

    <div class="info-card">
        <div class="info-card-header">
            <div class="info-card-header-icon"><i class="fas fa-university"></i></div>
            <h3>Data Fakultas</h3>
        </div>
        <div class="info-card-body">
            <div class="info-grid">
                <div class="info-item"><label>Nama Fakultas</label><span>{{ $fakultas->nama_fakultas ?? '-' }}</span></div>
                <div class="info-item"><label>Dekan</label><span>{{ $fakultas->dekan ?? '-' }}</span></div>
                <div class="info-item"><label>Akreditasi</label><span>{{ $fakultas->akreditasi ?? '-' }}</span></div>
                <div class="info-item"><label>No. SK</label><span>{{ $fakultas->no_sk ?? '-' }}</span></div>
            </div>
            <a href="{{ route('fakultas.profile.edit') }}" class="btn-edit"><i class="fas fa-edit"></i> Edit Profil</a>
        </div>
    </div>
@endsection
