@extends('mahasiswa.layouts.app')

@section('title', 'Daftar Penghargaan')
@section('page_title', 'Penghargaan')
@section('page_icon', 'award')

@section('content')

    <!-- Header dengan Button Tambah -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <div>
            <h2 style="font-size: 24px; font-weight: 800; margin: 0;">Penghargaan</h2>
            <p style="color: var(--muted); margin: 8px 0 0 0;">Kelola semua penghargaan yang pernah diterima</p>
        </div>
        <a href="{{ route('mahasiswa.penghargaan.create') }}" class="btn btn-primary" style="padding: 10px 20px;">
            <i class="fas fa-plus"></i> Tambah Penghargaan
        </a>
    </div>

    <!-- Alert Messages -->
    @if ($message = Session::get('success'))
        <div
            style="padding: 16px; background: #ecfdf5; border-left: 4px solid #10b981; border-radius: 8px; margin-bottom: 24px;">
            <strong style="color: #065f46;">✓ {{ $message }}</strong>
        </div>
    @endif

    @if ($message = Session::get('info'))
        <div
            style="padding: 16px; background: #eff6ff; border-left: 4px solid #3b82f6; border-radius: 8px; margin-bottom: 24px;">
            <strong style="color: #1e40af;">ℹ {{ $message }}</strong>
        </div>
    @endif

    <!-- Summary Cards -->
    <div
        style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 24px;">
        <div class="card"
            style="background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%); color: white; padding: 20px;">
            <div style="font-size: 14px; opacity: 0.9; margin-bottom: 8px;">Draft</div>
            <div style="font-size: 32px; font-weight: 700;">{{ $penghargaan->where('status', 'draft')->count() }}</div>
            <small style="opacity: 0.8;">Belum disubmit</small>
        </div>

        <div class="card"
            style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; padding: 20px;">
            <div style="font-size: 14px; opacity: 0.9; margin-bottom: 8px;">Submitted</div>
            <div style="font-size: 32px; font-weight: 700;">{{ $penghargaan->where('status', 'submitted')->count() }}</div>
            <small style="opacity: 0.8;">Menunggu verifikasi</small>
        </div>

        <div class="card"
            style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; padding: 20px;">
            <div style="font-size: 14px; opacity: 0.9; margin-bottom: 8px;">Approved</div>
            <div style="font-size: 32px; font-weight: 700;">{{ $penghargaan->where('status', 'approved')->count() }}</div>
            <small style="opacity: 0.8;">Disetujui</small>
        </div>

        <div class="card"
            style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; padding: 20px;">
            <div style="font-size: 14px; opacity: 0.9; margin-bottom: 8px;">Rejected</div>
            <div style="font-size: 32px; font-weight: 700;">
                {{ $penghargaan->whereIn('status', ['rejected', 'revision_required'])->count() }}</div>
            <small style="opacity: 0.8;">Ditolak / Perlu revisi</small>
        </div>
    </div>

    <!-- Table/List -->
    <div class="card">
        @if ($penghargaan->count() > 0)
            <div class="table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Penghargaan</th>
                            <th>Tingkat</th>
                            <th>Pemberi</th>
                            <th>Tahun</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penghargaan as $key => $item)
                            <tr>
                                <td style="padding: 16px;">{{ $key + 1 }}</td>
                                <td style="padding: 16px;">
                                    <strong>{{ $item->nama_penghargaan }}</strong>
                                </td>
                                <td style="padding: 16px; text-transform: capitalize;">
                                    {{ $item->tingkat }}
                                </td>
                                <td style="padding: 16px;">{{ $item->pemberi_penghargaan }}</td>
                                <td style="padding: 16px;">{{ $item->tahun_perolehan }}</td>
                                <td style="padding: 16px;">
                                    @if ($item->status == 'draft')
                                        <span class="badge"
                                            style="background: #fef3c7; color: #92400e; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600;">
                                            <i class="fas fa-file"></i> Draft
                                        </span>
                                    @elseif($item->status == 'submitted')
                                        <span class="badge"
                                            style="background: #dbeafe; color: #1e40af; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600;">
                                            <i class="fas fa-clock"></i> Menunggu Verifikasi
                                        </span>
                                    @elseif($item->status == 'approved')
                                        <span class="badge"
                                            style="background: #dcfce7; color: #166534; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600;">
                                            <i class="fas fa-check-circle"></i> Disetujui
                                        </span>
                                    @else
                                        <span class="badge"
                                            style="background: #fee2e2; color: #991b1b; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600;">
                                            <i class="fas fa-times-circle"></i> {{ ucfirst($item->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td style="padding: 16px;">
                                    <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                                        @if ($item->status == 'draft')
                                            <!-- Edit Button -->
                                            <a href="{{ route('mahasiswa.penghargaan.edit', $item->id) }}"
                                                class="btn btn-sm"
                                                style="background: #3b82f6; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px;">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>

                                            <!-- Submit Button -->
                                            <form action="{{ route('mahasiswa.penghargaan.submit', $item->id) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm"
                                                    style="background: #10b981; color: white; padding: 6px 12px; border-radius: 6px; border: none; font-size: 12px; cursor: pointer;"
                                                    onclick="return confirm('Submit untuk verifikasi? Data tidak bisa diedit setelah disubmit.')">
                                                    <i class="fas fa-paper-plane"></i> Submit
                                                </button>
                                            </form>

                                            <!-- Delete Button -->
                                            <form action="{{ route('mahasiswa.penghargaan.destroy', $item->id) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm"
                                                    style="background: #ef4444; color: white; padding: 6px 12px; border-radius: 6px; border: none; font-size: 12px; cursor: pointer;"
                                                    onclick="return confirm('Yakin hapus?')">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        @elseif($item->status == 'submitted')
                                            <!-- Disabled Button -->
                                            <button class="btn btn-sm" disabled
                                                style="background: #9ca3af; color: white; padding: 6px 12px; border-radius: 6px; border: none; font-size: 12px; cursor: not-allowed;">
                                                <i class="fas fa-clock"></i> Menunggu Verifikasi
                                            </button>
                                        @else
                                            <!-- View Button -->
                                            <a href="{{ route('mahasiswa.penghargaan.show', $item->id) }}"
                                                class="btn btn-sm"
                                                style="background: #6b7280; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 12px;">
                                                <i class="fas fa-eye"></i> Detail
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div style="padding: 60px 24px; text-align: center;">
                <i class="fas fa-inbox" style="font-size: 64px; color: #e5e7eb; margin-bottom: 16px; display: block;"></i>
                <h3 style="color: var(--muted); font-size: 16px; margin-bottom: 8px;">Belum ada data</h3>
                <p style="color: var(--muted); font-size: 14px; margin-bottom: 24px;">Mulai dengan menambahkan penghargaan
                    baru</p>
                <a href="{{ route('mahasiswa.penghargaan.create') }}" class="btn btn-primary" style="padding: 10px 20px;">
                    <i class="fas fa-plus"></i> Tambah Penghargaan
                </a>
            </div>
        @endif
    </div>

@endsection
