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
        SystemFieldModel::firstOrCreate(['name' => 'RUT', 'description' => 'rut', 'required' => true]);
        SystemFieldModel::firstOrCreate(['name' => 'Nombre Completo', 'description' => 'fullname', 'required' => true]);
        SystemFieldModel::firstOrCreate(['name' => 'Dirección', 'description' => 'address', 'required' => true]);
        SystemFieldModel::firstOrCreate(['name' => 'Teléfono Principal', 'description' => 'main_phone', 'required' => true]);
        SystemFieldModel::firstOrCreate(['name' => 'Teléfono Secundario', 'description' => 'second_phone', 'required' => true]);
        SystemFieldModel::firstOrCreate(['name' => 'Email', 'description' => 'email', 'required' => true]);
        SystemFieldModel::firstOrCreate(['name' => 'Monto Deuda Original', 'description' => 'original_mount', 'required' => true]);
        SystemFieldModel::firstOrCreate(['name' => 'Monto Deuda Actual', 'description' => 'current_amount', 'required' => true]);
        SystemFieldModel::firstOrCreate(['name' => 'Fecha de Vencimiento', 'description' => 'expiration_date', 'required' => true]);
        SystemFieldModel::firstOrCreate(['name' => 'Número de Documento', 'description' => 'document_number', 'required' => true]);
        SystemFieldModel::firstOrCreate(['name' => 'Producto', 'description' => 'product', 'required' => true]);
        SystemFieldModel::firstOrCreate(['name' => 'Sucursal Origen', 'description' => 'origin_branch', 'required' => true]);
        SystemFieldModel::firstOrCreate(['name' => 'Días de Mora', 'description' => 'delay_days', 'required' => true]);
        SystemFieldModel::firstOrCreate(['name' => 'Tramo de Mora', 'description' => 'delay_stretch', 'required' => true]);
    }
}
