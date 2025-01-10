<?php

namespace Database\Seeders;

use App\Models\CategoryDependency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryDependencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoryDependency::create([
            'name' => 'Waiting Material',
            'slug' => 'waiting-material',
        ]);

        CategoryDependency::create([
            'name' => 'Waiting Equipment',
            'slug' => 'waiting-equipment',
        ]);

        CategoryDependency::create([
            'name' => 'Waiting Labor',
            'slug' => 'waiting-labor',
        ]);

        CategoryDependency::create([
            'name' => 'Waiting Other',
            'slug' => 'waiting-other',
        ]);

        CategoryDependency::create([
            'name' => 'Drawing Revision',
            'slug' => 'drawing-revision',
        ]);

        CategoryDependency::create([
            'name' => 'Waiting Approval',
            'slug' => 'waiting-approval',
        ]);
    }
}
