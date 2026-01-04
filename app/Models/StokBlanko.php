<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokBlanko extends Model
{
    use HasFactory;

    protected $table = 'stok_blanko';

    protected $fillable = [
        'tanggal_pengadaan',
        'jumlah_masuk',
        'jumlah_keluar',
        'stok_tersisa',
        'keterangan',
        'petugas_id'
    ];

    protected $casts = [
        'tanggal_pengadaan' => 'date'
    ];

    // ===== RELATIONSHIPS =====

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    // ===== SCOPES =====

    public function scopeByBulan($query, $bulan, $tahun)
    {
        return $query->whereMonth('tanggal_pengadaan', $bulan)
            ->whereYear('tanggal_pengadaan', $tahun);
    }

    // ===== METHODS =====

    public function tambahStok($jumlah, $keterangan = null)
    {
        $this->jumlah_masuk += $jumlah;
        $this->stok_tersisa += $jumlah;
        $this->keterangan = $keterangan ?? $this->keterangan;
        return $this->save();
    }

    public function kurangiStok($jumlah, $keterangan = null)
    {
        if ($this->stok_tersisa < $jumlah) {
            throw new \Exception('Stok tidak mencukupi!');
        }
        $this->jumlah_keluar += $jumlah;
        $this->stok_tersisa -= $jumlah;
        $this->keterangan = $keterangan ?? $this->keterangan;
        return $this->save();
    }

    public function isStokLow()
    {
        return $this->stok_tersisa <= 10; // Warning jika stok <= 10
    }
}
