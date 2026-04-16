<?php

namespace Database\Seeders;

use App\Src\Infrastructure\Layout\Persistence\Models\LayoutModel;
use Illuminate\Database\Seeder;

class LayoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LayoutModel::firstOrCreate(['name' => 'EMPA_clientes']);
        LayoutModel::firstOrCreate(['name' => 'EMPA_deuda']);
        LayoutModel::firstOrCreate(['name' => 'EMPA_pagos']);
        LayoutModel::firstOrCreate(['name' => 'EMPB_clientes']);
        LayoutModel::firstOrCreate(['name' => 'EMPB_saldos']);
        LayoutModel::firstOrCreate(['name' => 'EMPC_telefono']);
        LayoutModel::firstOrCreate(['name' => 'EMPC_ofertas']);
        LayoutModel::firstOrCreate(['name' => 'EMPD_cuota']);
    }
}
