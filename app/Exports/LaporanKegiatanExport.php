<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LaporanKegiatanExport implements FromView, WithStyles, WithTitle
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

        // Tambahkan alamat dari koordinat ke masing-masing kegiatan
        foreach ($laporan as $item) {
            $kegiatan = $item->kegiatan;

            if ($kegiatan && $kegiatan->latitude && $kegiatan->longitude) {
                $kegiatan->alamat_terbalik = $this->getAddressFromCoordinates(
                    $kegiatan->latitude,
                    $kegiatan->longitude
                );
            } else {
                $kegiatan->alamat_terbalik = '-';
            }
        }

        return view('laporan_kegiatan.report_excel', [
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
    $sheet->mergeCells('A1:F1')->getStyle('A1')->getFont()->setBold(true);
    $sheet->mergeCells('A2:F2')->getStyle('A2')->getFont()->setBold(true);
    $sheet->mergeCells('A3:F3')->getStyle('A3')->getFont()->setBold(true);
    $sheet->mergeCells('A4:F4')->getStyle('A4')->getFont()->setBold(true);
    $sheet->getStyle('A1:A4')->getAlignment()->setHorizontal('center');

    // Header style
    $sheet->getStyle('A6:F6')->applyFromArray([
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
    $sheet->getStyle("A7:F{$lastRow}")->applyFromArray([
        'borders' => [
            'allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
        ],
    ]);

    // Auto size kolom selain lokasi
    foreach (['A', 'B', 'C', 'D', 'F'] as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    // Wrap dan lebarkan kolom lokasi
    $sheet->getStyle('E')->getAlignment()->setWrapText(true);
    $sheet->getColumnDimension('E')->setWidth(50);

    // Vertikal tengah semua isi
    $sheet->getStyle("A7:F{$lastRow}")->getAlignment()->setVertical('center');

    // Tinggi baris otomatis
    $sheet->getDefaultRowDimension()->setRowHeight(-1);

    return [];
}

    
    

    public function title(): string
    {
        return "Laporan Kegiatan $this->tahun";
    }
}


