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
        $argentina = \DB::connection('mongodb')->table('countries')->where('alpha2', 'AR')->first();
        $chile = \DB::connection('mongodb')->table('countries')->where('alpha2', 'CL')->first();
        $mexico = \DB::connection('mongodb')->table('countries')->where('alpha2', 'MX')->first();

        CompanyModel::firstOrCreate(['country_id' => "$argentina->id", 'code' => 'EMP001', 'name' => 'Empresa Demo S.A.', 'status' => true]);
        CompanyModel::firstOrCreate(['country_id' => "$chile->id", 'code' => 'EMP002', 'name' => 'Servicios Integrales Ltda.', 'status' => true]);
        CompanyModel::firstOrCreate(['country_id' => "$mexico->id", 'code' => 'EMP003', 'name' => 'Tecnología Avanzada Inc.', 'status' => false]);
    }
}
