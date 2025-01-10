<?php

namespace Database\Seeders;

use App\Models\Scope;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScopeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Scope::create([
            'name' => 'Memasang Instalasi Kabel',
        ]);

        Scope::create([
            'name' => 'Pemeliharaan Kabel',
        ]);

        Scope::create([
            'name' => 'Pemeliharaan Jaringan',
        ]);

        Scope::create([
            'name' => 'Pemeliharaan Kabel dan Jaringan',
        ]);

        Scope::create([
            'name' => 'Pemeliharaan Jaringan dan Instalasi Kabel',
        ]);
    }
}
