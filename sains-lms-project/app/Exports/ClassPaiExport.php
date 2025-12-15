<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths; // Ganti ShouldAutoSize
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ClassPaiExport implements FromView, WithColumnWidths, WithEvents
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('dashboard.admin.daftar-kelas.export-excel', $this->data);
    }

    // DEFINISI LEBAR KOLOM MANUAL (Agar tidak terlalu sempit)
    public function columnWidths(): array
    {
        return [
            'A' => 10,  // No
            'B' => 18, // NIM (Lebar cukup untuk angka)
            'C' => 35, // Nama (Lebar)
            'D' => 25, // Asal Halaqah
            
            // PRETEST (E-I)
            'E' => 10, 'F' => 12, 'G' => 12, // K, H, M
            'H' => 12, // Total
            'I' => 15, // Ket (Cukup untuk SANGAT BAIK)

            // WEEKLY (J-O) - Kolom kecil untuk angka satuan
            'J' => 6, 'K' => 6, 'L' => 6, 'M' => 6, 'N' => 6, 'O' => 6,

            // POSTTEST (P-T)
            'P' => 12, 'Q' => 12, 'R' => 12,
            'S' => 12, // Total
            'T' => 15, // Ket

            // FINAL (U)
            'U' => 10,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $sheet->getParent()->getDefaultStyle()->getFont()->setName('Arial');
                $sheet->getParent()->getDefaultStyle()->getFont()->setSize(10);
                $sheet->getParent()->getDefaultStyle()->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                $sheet->getParent()->getDefaultStyle()->getAlignment()->setWrapText(true); // Agar teks panjang turun ke bawah
            },
        ];
    }
}