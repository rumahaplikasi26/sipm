<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeeExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Employee::select('id', 'employee_id', 'name', 'email', 'phone', 'group_id', 'position_id')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Employee ID',
            'Name',
            'Email',
            'Phone',
            'Group',
            'Position',
        ];
    }
}
