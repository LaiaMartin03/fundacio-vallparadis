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
        return Curso::with('professionals')
            ->select('id', 'name', 'forcem', 'hours', 'modality', 'type', 'info', 'start_date', 'finish_date', 'certification')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nom del Curs',
            'Forcem',
            'Hores',
            'Modalitat',
            'Tipus',
            'Informació',
            'Data Inici',
            'Data Fi',
            'Certificació',
            'Professionals Assignats'
        ];
    }

    public function map($curso): array
    {
        // Obtener nombres de profesionales
        $names = $curso->professionals->pluck('name')->filter()->values()->all();
        $professionalsCsv = empty($names) ? 'Cap professional assignat' : implode(', ', $names);

        return [
            $curso->id,
            $curso->name,
            $curso->forcem,
            $curso->hours,
            $curso->modality,
            $curso->type,
            $curso->info ?? '',
            $curso->start_date ? \Carbon\Carbon::parse($curso->start_date)->format('d/m/Y') : '',
            $curso->finish_date ? \Carbon\Carbon::parse($curso->finish_date)->format('d/m/Y') : '',
            $curso->certification ?? '',
            $professionalsCsv,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:K1')->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'FF9740'],
            ],
            'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => '000000']]],
        ]);

        $lastRow = $sheet->getHighestRow();
        $sheet->getStyle("A2:K{$lastRow}")->applyFromArray([
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => '000000']]],
            'alignment' => ['vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP],
        ]);

        foreach ($sheet->getRowDimensions() as $rowDimension) {
            $rowDimension->setRowHeight(-1);
        }

        $sheet->getStyle('G:G')->getAlignment()->setWrapText(true);
    }
}