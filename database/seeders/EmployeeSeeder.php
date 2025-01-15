<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::create([
            'id' => 20221224,
            'name' => 'Achmad Fatoni',
            'email' => 'ahmad.fatoni@mindotek.com',
            'phone' => '6289676490971',
            'position_id' => 1,
            'group_id' => 1
        ]);
    }
}
