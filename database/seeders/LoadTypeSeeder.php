<?php

namespace Database\Seeders;

use App\Src\Infrastructure\LoadType\Persistence\Models\LoadTypeModel;
use Illuminate\Database\Seeder;

class LoadTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LoadTypeModel::firstOrCreate(['name' => 'Clientes']);
        LoadTypeModel::firstOrCreate(['name' => 'Deuda']);
        LoadTypeModel::firstOrCreate(['name' => 'Teléfono']);
        LoadTypeModel::firstOrCreate(['name' => 'Pagos']);
        LoadTypeModel::firstOrCreate(['name' => 'Cuota']);
        LoadTypeModel::firstOrCreate(['name' => 'Saldos']);
        LoadTypeModel::firstOrCreate(['name' => 'Ofertas']);
    }
}
