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
        SystemFieldModel::firstOrCreate(['name' => 'RUT', 'column' => 'rut', 'position' => 1, 'required' => true, 'table_name' => 'customers']);
        SystemFieldModel::firstOrCreate(['name' => 'Nombre Completo', 'column' => 'fullname', 'position' => 2, 'required' => true, 'table_name' => 'customers']);
        SystemFieldModel::firstOrCreate(['name' => 'Dirección', 'column' => 'address', 'position' => 3, 'required' => true, 'table_name' => 'customers']);
        SystemFieldModel::firstOrCreate(['name' => 'Teléfono Principal', 'column' => 'main_phone', 'position' => 4, 'required' => true, 'table_name' => 'customers']);
        SystemFieldModel::firstOrCreate(['name' => 'Teléfono Secundario', 'column' => 'second_phone', 'position' => 5, 'required' => true, 'table_name' => 'customers']);
        SystemFieldModel::firstOrCreate(['name' => 'Email', 'column' => 'email', 'position' => 6, 'required' => true, 'table_name' => 'customers']);
        SystemFieldModel::firstOrCreate(['name' => 'Monto Deuda Original', 'column' => 'original_mount', 'position' => 7, 'required' => true, 'table_name' => 'debts']);
        SystemFieldModel::firstOrCreate(['name' => 'Monto Deuda Actual', 'column' => 'current_amount', 'position' => 8, 'required' => true, 'table_name' => 'debts']);
        SystemFieldModel::firstOrCreate(['name' => 'Fecha de Vencimiento', 'column' => 'expiration_date', 'position' => 9, 'required' => true, 'table_name' => 'debts']);
        SystemFieldModel::firstOrCreate(['name' => 'Número de Documento', 'column' => 'document_number', 'position' => 10, 'required' => true, 'table_name' => 'debts']);
        SystemFieldModel::firstOrCreate(['name' => 'Producto', 'column' => 'product', 'position' => 11, 'required' => true, 'table_name' => 'products']);
        SystemFieldModel::firstOrCreate(['name' => 'Sucursal Origen', 'column' => 'origin_branch', 'position' => 12, 'required' => true, 'table_name' => 'products']);
        SystemFieldModel::firstOrCreate(['name' => 'Días de Mora', 'column' => 'delay_days', 'position' => 13, 'required' => true, 'table_name' => 'debts']);
        SystemFieldModel::firstOrCreate(['name' => 'Tramo de Mora', 'column' => 'delay_stretch', 'position' => 14, 'required' => true, 'table_name' => 'debts']);
    }
}
