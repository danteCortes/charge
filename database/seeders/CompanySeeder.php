<?php

namespace Database\Seeders;

use App\Src\Infrastructure\Company\Persistence\Models\CompanyModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $argentina = DB::connection('mongodb')->table('countries')->where('alpha2', 'AR')->first();
        $chile = DB::connection('mongodb')->table('countries')->where('alpha2', 'CL')->first();
        $mexico = DB::connection('mongodb')->table('countries')->where('alpha2', 'MX')->first();

        CompanyModel::updateOrCreate(
            ['code' => 'EMP001'],
            ['country_id' => "$argentina->id", 'name' => 'Empresa Demo S.A.', 'fantasy_name' => 'Demo Corp', 'responsible' => 'Juan Pérez', 'status' => true]
        );
        CompanyModel::updateOrCreate(
            ['code' => 'EMP002'],
            ['country_id' => "$chile->id", 'name' => 'Servicios Integrales Ltda.', 'fantasy_name' => 'Servicios Corp', 'responsible' => 'María González', 'status' => true]
        );
        CompanyModel::updateOrCreate(
            ['code' => 'EMP003'],
            ['country_id' => "$mexico->id", 'name' => 'Tecnología Avanzada Inc.', 'fantasy_name' => 'TechAdv', 'responsible' => 'Carlos Rodríguez', 'status' => false]
        );
    }
}
