<?php

namespace App\Exports;

use App\Models\Curso;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;

class CursosExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    public function collection()
    {
        // traer id + name para que Eloquent pueda hacer eager load correctamente
        return Curso::with('professionals')
            ->select('id', 'name')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Curso',
            'Professionals',
        ];
    }

    public function map($curso): array
    {
        // Asume que Professional tiene atributo 'name'
        $names = $curso->professionals->pluck('name')->filter()->values()->all();
        $professionalsCsv = empty($names) ? '' : implode(', ', $names);

        return [
            $curso->name,
            $professionalsCsv,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // ajustado al número real de columnas (A:B)
        $sheet->getStyle('A1:B1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4CAF50'],
            ],
            'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => '000000']]],
        ]);

        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle("A2:B{$lastRow}")->applyFromArray([
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => '000000']]],
        ]);
    }
}
