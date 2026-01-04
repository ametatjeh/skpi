<?php

namespace App\Exports;

use App\Models\DraftSkpi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SkpiExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    /**
     * Query data untuk export
     */
    public function collection()
    {
        return DraftSkpi::with(['mahasiswa.prodi.fakultas', 'prodi'])
            ->latest()
            ->get();
    }

    /**
     * Header kolom Excel
     */
    public function headings(): array
    {
        return [
            'No',
            'Nomor SKPI',
            'NIM',
            'Nama Mahasiswa',
            'Program Studi',
            'Fakultas',
            'Status',
            'Tanggal Dibuat',
            'Tanggal Pengesahan',
        ];
    }

    /**
     * Mapping data ke kolom
     */
    public function map($draftSkpi): array
    {
        static $no = 0;
        $no++;

        return [
            $no,
            $draftSkpi->nomor_skpi ?? '-',
            $draftSkpi->mahasiswa->nim ?? '-',
            $draftSkpi->mahasiswa->nama ?? '-',
            // Coba ambil nama prodi dari relasi prodi langsung, jika tidak ada baru dari mahasiswa->prodi
            $draftSkpi->prodi->nama_prodi ?? $draftSkpi->mahasiswa->prodi->nama_prodi ?? '-', 
            $draftSkpi->mahasiswa->prodi->fakultas->nama_fakultas ?? '-',
            $this->formatStatus($draftSkpi->status),
            $draftSkpi->created_at ? $draftSkpi->created_at->format('d/m/Y') : '-',
            $draftSkpi->tanggal_pengesahan ? $draftSkpi->tanggal_pengesahan->format('d/m/Y') : '-',
        ];
    }

    /**
     * Helper status formatter
     */
    private function formatStatus($status)
    {
        return match($status) {
            'draft' => 'Draft',
            'submitted' => 'Diajukan',
            'diverifikasi_prodi' => 'Diverifikasi Prodi',
            'approved' => 'Disetujui',
            'final_issued' => 'Final',
            'final' => 'Final',
            'rejected' => 'Ditolak',
            default => ucfirst($status),
        };
    }

    /**
     * Style untuk Excel
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Header row styling
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '1E40AF'],
                ],
            ],
        ];
    }
}
