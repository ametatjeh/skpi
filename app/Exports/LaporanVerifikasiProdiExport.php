<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class LaporanVerifikasiProdiExport implements FromCollection, WithHeadings, WithStyles, WithTitle, ShouldAutoSize, WithEvents
{
    protected $data;
    protected $prodi;
    protected $tahun;

    public function __construct($data, $prodi, $tahun)
    {
        $this->data = $data;
        $this->prodi = $prodi;
        $this->tahun = $tahun;
    }

    public function collection()
    {
        return $this->data->map(function ($item, $index) {
            $kategoriMap = [
                'App\Models\SertifikasiKompetensi' => 'Sertifikasi Kompetensi',
                'App\Models\Prestasi' => 'Prestasi',
                'App\Models\Organisasi' => 'Organisasi',
                'App\Models\PengabdianMasyarakat' => 'Pengabdian Masyarakat',
                'App\Models\KaryaIlmiah' => 'Karya Ilmiah',
                'App\Models\Penghargaan' => 'Penghargaan',
            ];

            $statusMap = [
                'pending' => 'Menunggu',
                'approved' => 'Disetujui',
                'rejected' => 'Ditolak',
                'revision_required' => 'Perlu Revisi',
                'included_in_summary' => 'Termasuk SKPI',
            ];

            return [
                $index + 1,
                $item->mahasiswa->nim ?? '-',
                $item->mahasiswa->nama ?? '-',
                $kategoriMap[$item->verifiable_type] ?? class_basename($item->verifiable_type),
                $item->achievement_name ?? '-',
                $statusMap[$item->status] ?? ucfirst($item->status),
                $item->created_at ? $item->created_at->format('d/m/Y') : '-',
                $item->tanggal_verifikasi ? $item->tanggal_verifikasi->format('d/m/Y') : '-',
                $item->catatan ?? '-',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'NIM',
            'Nama Mahasiswa',
            'Kategori',
            'Nama Achievement',
            'Status',
            'Tanggal Pengajuan',
            'Tanggal Verifikasi',
            'Catatan',
        ];
    }

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
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '2563EB'],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }

    public function title(): string
    {
        return 'Laporan Verifikasi SKPI';
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();

                // Set all borders
                $sheet->getStyle("A1:{$highestColumn}{$highestRow}")
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN);

                // Set header height
                $sheet->getRowDimension(1)->setRowHeight(25);

                // Center align columns
                $sheet->getStyle("A2:A{$highestRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle("F2:F{$highestRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle("G2:G{$highestRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle("H2:H{$highestRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Insert title rows at top
                $sheet->insertNewRowBefore(1, 3);
                
                $prodiName = $this->prodi->nama_prodi ?? 'Program Studi';
                
                $sheet->setCellValue('A1', 'LAPORAN VERIFIKASI SKPI');
                $sheet->setCellValue('A2', $prodiName . ' - Tahun ' . $this->tahun);
                $sheet->setCellValue('A3', 'Dicetak: ' . now()->translatedFormat('d F Y H:i'));

                // Merge title cells
                $sheet->mergeCells("A1:{$highestColumn}1");
                $sheet->mergeCells("A2:{$highestColumn}2");
                $sheet->mergeCells("A3:{$highestColumn}3");

                // Style title
                $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(16);
                $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('A3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('A3')->getFont()->setItalic(true)->setSize(10);

                // Remove borders from title rows
                $sheet->getStyle("A1:{$highestColumn}3")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_NONE);
            },
        ];
    }
}
