<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanMonev extends Model
{
    use HasFactory;

    protected $table = 'laporan_monev';

    protected $fillable = [
        'periode',
        'prodi_id',
        'fakultas_id',
        'total_pengajuan',
        'total_disetujui',
        'total_ditolak',
        'rata_rata_waktu_proses',
        'catatan_evaluasi',
        'rekomendasi',
        'dibuat_oleh'
    ];

    // ===== RELATIONSHIPS =====

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

    // ===== SCOPES =====

    public function scopeByPeriode($query, $periode)
    {
        return $query->where('periode', $periode);
    }

    public function scopeByProdi($query, $prodiId)
    {
        return $query->where('prodi_id', $prodiId);
    }

    // ===== ACCESSORS =====

    public function getPersentaseSetujuAttribute()
    {
        if ($this->total_pengajuan == 0) return 0;
        return round(($this->total_disetujui / $this->total_pengajuan) * 100, 2);
    }

    public function getPersentaseTolakAttribute()
    {
        if ($this->total_pengajuan == 0) return 0;
        return round(($this->total_ditolak / $this->total_pengajuan) * 100, 2);
    }
}
