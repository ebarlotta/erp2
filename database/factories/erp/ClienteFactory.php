<?php

namespace Database\Factories\erp;

use App\Models\erp\Cliente;

use App\Models\Empresa;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cliente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'direccion'=> $this->faker->city(),
            'cuil'=> $this->faker->numberBetween(20000000,40000000),
            'telefono'=> $this->faker->numberBetween(2634000000,40000000),
            'empresa_id' => Empresa::inRandomOrder()->value('id') ?: Empresa::factory(1)->create(),
        ];
    }
}
