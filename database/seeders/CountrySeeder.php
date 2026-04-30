<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::connection('mongodb')->table('countries')->upsert(
            [
                ['name' => 'Argentina', 'alpha2' => 'AR', 'alpha3' => 'ARG'],
                ['name' => 'Chile', 'alpha2' => 'CL', 'alpha3' => 'CHL'],
                ['name' => 'México', 'alpha2' => 'MX', 'alpha3' => 'MEX'],
                ['name' => 'Colombia', 'alpha2' => 'CO', 'alpha3' => 'COL'],
                ['name' => 'Perú', 'alpha2' => 'PE', 'alpha3' => 'PER'],
                ['name' => 'Uruguay', 'alpha2' => 'UY', 'alpha3' => 'URY'],
                ['name' => 'Paraguay', 'alpha2' => 'PY', 'alpha3' => 'PRY'],
            ],
            ['name'],
            ['alpha2', 'alpha3']
        );
    }
}
