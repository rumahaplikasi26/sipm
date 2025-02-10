<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class SupervisorSheet implements FromCollection, WithHeadings, WithTitle
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::role('Supervisor')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
        ];
    }

    public function title(): string
    {
        return 'Supervisors';
    }
}
