<?php

namespace Database\Seeders;

use App\Src\Infrastructure\Company\Persistence\Models\CompanyModel;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CompanyModel::firstOrCreate(['code' => 'EMP001', 'name' => 'Empresa Demo S.A.']);
        CompanyModel::firstOrCreate(['code' => 'EMP002', 'name' => 'Servicios Integrales Ltda.']);
        CompanyModel::firstOrCreate(['code' => 'EMP003', 'name' => 'Tecnología Avanzada Inc.']);
    }
}
