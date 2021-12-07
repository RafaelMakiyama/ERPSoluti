<?php

namespace Database\Factories;

use App\Models\Pedido;
use Illuminate\Database\Eloquent\Factories\Factory;

class PedidoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pedido::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'codigo' => $this->faker->numberBetween(111111111, 987654321),
            'codigo_cliente' => $this->faker->numberBetween(3, 4),
            'codigo_unidade' => $this->faker->numberBetween(1,2),
            'codigo_produto' => $this->faker->numberBetween(1, 10),
            'data' => $this->faker->dateTime(),
            'referencia' => $this->faker->word,
        ];
    }
}
