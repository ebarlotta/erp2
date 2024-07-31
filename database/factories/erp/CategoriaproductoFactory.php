<?php

namespace Database\Factories\erp;

use App\Models\Empresa;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriaproductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'empresa_id' => Empresa::inRandomOrder()->value('id') ?: Empresa::factory(1)->create(),
        ];
    }
}
