<?php

namespace Database\Seeders;

use App\Src\Infrastructure\SystemField\Persistence\Models\SystemFieldModel;
use Illuminate\Database\Seeder;

class SystemFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SystemFieldModel::firstOrCreate(['name' => 'RUT', 'column' => 'rut', 'required' => true, 'position' => 1]);
        SystemFieldModel::firstOrCreate(['name' => 'Nombre Completo', 'column' => 'fullname', 'required' => true, 'position' => 2]);
        SystemFieldModel::firstOrCreate(['name' => 'Dirección', 'column' => 'address', 'required' => true, 'position' => 3]);
        SystemFieldModel::firstOrCreate(['name' => 'Teléfono Principal', 'column' => 'main_phone', 'required' => true, 'position' => 4]);
        SystemFieldModel::firstOrCreate(['name' => 'Teléfono Secundario', 'column' => 'second_phone', 'required' => true, 'position' => 5]);
        SystemFieldModel::firstOrCreate(['name' => 'Email', 'column' => 'email', 'required' => true, 'position' => 6]);
        SystemFieldModel::firstOrCreate(['name' => 'Monto Deuda Original', 'column' => 'original_mount', 'required' => true, 'position' => 7]);
        SystemFieldModel::firstOrCreate(['name' => 'Monto Deuda Actual', 'column' => 'current_amount', 'required' => true, 'position' => 8]);
        SystemFieldModel::firstOrCreate(['name' => 'Fecha de Vencimiento', 'column' => 'expiration_date', 'required' => true, 'position' => 9]);
        SystemFieldModel::firstOrCreate(['name' => 'Número de Documento', 'column' => 'document_number', 'required' => true, 'position' => 10]);
        SystemFieldModel::firstOrCreate(['name' => 'Producto', 'column' => 'product', 'required' => true, 'position' => 11]);
        SystemFieldModel::firstOrCreate(['name' => 'Sucursal Origen', 'column' => 'origin_branch', 'required' => true, 'position' => 12]);
        SystemFieldModel::firstOrCreate(['name' => 'Días de Mora', 'column' => 'delay_days', 'required' => true, 'position' => 13]);
        SystemFieldModel::firstOrCreate(['name' => 'Tramo de Mora', 'column' => 'delay_stretch', 'required' => true, 'position' => 14]);
    }
}
