<?php

namespace App\Exports;

use App\Models\Uniform;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class UniformsExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        return Uniform::select(
            'ID',
            'shirt_size',
            'pants_size',
            'lab_coat',
            'shoe_size'
        )->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Talla Camisa',
            'Talla Pantaló',
            'Bata',
            'Talla Sabates',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:G1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF']
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4CAF50'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);
    }
}
