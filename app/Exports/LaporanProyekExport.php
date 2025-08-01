<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanProyekExport implements FromView, WithStyles, WithTitle
{
    protected $laporan;
    protected $nomorUrut;
    protected $bulanRomawi;
    protected $tahun;

    public function __construct($laporan, $nomorUrut, $bulanRomawi, $tahun)
    {
        $this->laporan = $laporan;
        $this->nomorUrut = $nomorUrut;
        $this->bulanRomawi = $bulanRomawi;
        $this->tahun = $tahun;
    }

    public function view(): View
    {
        $laporan = $this->laporan;

        foreach ($laporan as $item) {
            $proyek = $item->proyek;

            if ($proyek && $proyek->latitude && $proyek->longitude) {
                $item->proyek->lokasi_nama = $this->getAddressFromCoordinates(
                    $proyek->latitude,
                    $proyek->longitude
                );
            } else {
                $item->proyek->lokasi_nama = $proyek->lokasi ?? '-';
            }
        }

        return view('laporan_proyek.report_excel', [
            'laporan' => $laporan,
            'nomorUrutFormatted' => $this->nomorUrut,
            'bulanRomawiFormatted' => $this->bulanRomawi,
            'tahun' => $this->tahun
        ]);
    }

    protected function getAddressFromCoordinates($lat, $lng)
    {
        try {
            $url = "https://nominatim.openstreetmap.org/reverse?format=json&lat={$lat}&lon={$lng}&addressdetails=1";
            $opts = ['http' => ['header' => "User-Agent: laporan-export\r\n"]];
            $context = stream_context_create($opts);
            $response = file_get_contents($url, false, $context);
            $data = json_decode($response, true);
            return $data['display_name'] ?? '-';
        } catch (\Exception $e) {
            return '-';
        }
    }

    public function styles(Worksheet $sheet)
    {
        // Merge & center title rows
        $sheet->mergeCells('A1:M1')->getStyle('A1')->getFont()->setBold(true);
        $sheet->mergeCells('A2:M2')->getStyle('A2')->getFont()->setBold(true);
        $sheet->mergeCells('A3:M3')->getStyle('A3')->getFont()->setBold(true);
        $sheet->mergeCells('A4:M4')->getStyle('A4')->getFont()->setBold(true);
        $sheet->getStyle('A1:A4')->getAlignment()->setHorizontal('center');
    
        // Header style
        $sheet->getStyle('A6:M6')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['rgb' => 'FFFF00'],
            ],
            'alignment' => ['horizontal' => 'center'],
            'borders' => [
                'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            ],
        ]);
    
        // Border style for content rows
        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle("A7:M{$lastRow}")->applyFromArray([
            'borders' => [
                'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            ],
        ]);
    
        // Auto size kolom selain lokasi
        foreach (['A', 'C', 'D', 'E', 'G','H', 'I', 'M'] as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
        
        // Wrap dan lebarkan kolom lokasi
        $sheet->getStyle('F')->getAlignment()->setWrapText(true);
        $sheet->getColumnDimension('F')->setWidth(50);
        
        // Bungkus teks dan batasi lebar untuk kolom J, K, L (Keterangan, Kendala, Evaluasi)
        foreach (['B', 'J', 'K', 'L'] as $col) {
            $sheet->getStyle($col)->getAlignment()->setWrapText(true);
            $sheet->getColumnDimension($col)->setWidth(30); // Bisa ubah ke 25 jika ingin lebih kecil
        }
    
        // Vertikal tengah semua isi
        $sheet->getStyle("A7:M{$lastRow}")->getAlignment()->setVertical('center');
    
        // Tinggi baris otomatis
        $sheet->getDefaultRowDimension()->setRowHeight(-1);
    
        return [];
    }    

    public function title(): string
    {
        return "Laporan Proyek {$this->tahun}";
    }
}
