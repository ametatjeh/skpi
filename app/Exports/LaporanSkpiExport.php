<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class LaporanSkpiExport implements FromCollection, WithHeadings
{
    protected $datas;

    public function __construct($datas)
    {
        $this->datas = $datas;
    }

    public function collection()
    {
        return $this->datas->map(function ($v) {
            return [
                $v->mahasiswa->nim ?? '-',
                $v->mahasiswa->nama ?? '-',
                $v->mahasiswa->prodi->nama_prodi ?? '-',
                class_basename($v->verifiable_type) ?? '-',
                ucfirst($v->status),
                $v->tanggal_pengajuan ? $v->tanggal_pengajuan->format('d/m/Y') : '-',
                $v->tanggal_verifikasi ? $v->tanggal_verifikasi->format('d/m/Y') : '-',
            ];
        });
    }

    public function headings(): array
    {
        return ['NIM', 'Nama', 'Prodi', 'Kategori', 'Status', 'Tgl Pengajuan', 'Tgl Verifikasi'];
    }
}
