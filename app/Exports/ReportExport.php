<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ReportExport implements FromCollection, WithHeadings, WithMapping
{
    protected $activities;
    protected $currentRow = 1; // Track current row for mapping

    public function __construct($activities)
    {
        $this->activities = $activities;
    }

    public function collection()
    {
        // Create a new collection with repeated activities based on dependencies
        $expandedCollection = collect();

        foreach ($this->activities as $activity) {
            $dependencies = $activity['issues'] ?? [];
            $count = max(1, count($dependencies));

            // Repeat the activity for each dependency
            for ($i = 0; $i < $count; $i++) {
                $activity['_dependency_index'] = $i;
                $expandedCollection->push($activity);
            }
        }

        return $expandedCollection;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Date',
            'Title',
            'Group',
            'Position',
            'Scope',
            'Estimate Time',
            'Forecast Date',
            'Plan Date',
            'Actual Date',
            'Progress AVG (%)',
            'Supervisor',
            'Dependencies',
        ];
    }

    public function map($activity): array
    {
        // Ambil semua scope dari relasi details.scope dan gabungkan menjadi string
        $scopes = collect($activity['details'] ?? [])
            ->map(function ($detail) {
                return ($detail['scope']['name'] ?? '') . ': ' . ($detail['progress'] ? $detail['progress'].'%' : '');
            })->join(', ');

        // Ambil semua dependency dan gabungkan menjadi string
        $dependencies = collect($activity['issues'] ?? [])
            ->map(function ($issue) {
                return ($issue['category_dependency']['name'] ?? '') . ': ' . ($issue['description'] ?? '');
            })
            ->join(', '); // Gabungkan menjadi string dengan koma sebagai pemisah


        return [
            $activity['id'],
            $activity['date'],
            $activity['title'],
            $activity['group']['name'] ?? '',
            $activity['position']['name'] ?? '',
            $scopes,
            $activity['total_estimate'] . ' ' . $activity['type_estimate'],
            $activity['forecast_date'],
            $activity['plan_date'],
            $activity['actual_date'],
            $activity['progress'] ?? '',
            $activity['supervisor']['name'] ?? '',
            $dependencies,
        ];
    }

    // public function registerEvents(): array
    // {
    //     return [
    //         AfterSheet::class => function(AfterSheet $event) {
    //             $sheet = $event->sheet;
    //             $currentRow = 2; // Start after headers

    //             foreach ($this->activities as $activity) {
    //                 $dependencies = $activity['issues'] ?? [];
    //                 $dependencyCount = max(1, count($dependencies));

    //                 if ($dependencyCount > 1) {
    //                     // Merge cells for all columns except dependencies
    //                     foreach (range('A', 'L') as $column) {
    //                         $sheet->mergeCells(
    //                             "{$column}{$currentRow}:{$column}" . ($currentRow + $dependencyCount - 1)
    //                         );
    //                     }

    //                     // Set vertical alignment to top for merged cells
    //                     $sheet->getStyle("A{$currentRow}:L" . ($currentRow + $dependencyCount - 1))
    //                         ->getAlignment()
    //                         ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
    //                 }

    //                 // Move to next set of rows
    //                 $currentRow += $dependencyCount;
    //             }

    //             // Style the headers
    //             $sheet->getStyle('A1:M1')->applyFromArray([
    //                 'font' => ['bold' => true],
    //                 'fill' => [
    //                     'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
    //                     'startColor' => ['rgb' => 'E2E8F0']
    //                 ]
    //             ]);

    //             // Auto-size columns
    //             foreach (range('A', 'M') as $column) {
    //                 $sheet->getColumnDimension($column)->setAutoSize(true);
    //             }
    //         }
    //     ];
    // }
}
