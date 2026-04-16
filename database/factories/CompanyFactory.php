<?php

namespace Database\Factories;

use App\Models\Model;
use App\Src\Infrastructure\Company\Persistence\Models\CompanyModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
 */
class CompanyFactory extends Factory
{
    protected $model = CompanyModel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => "EMP{$this->faker->numerify()}",
            'name' => $this->faker->company(),
        ];
    }
}
