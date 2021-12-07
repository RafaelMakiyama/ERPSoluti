<?php

namespace Database\Factories;

use App\Models\Produto;
use Doctrine\Inflector\Rules\Word;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdutoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Produto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'codigo' => $this->faker->numberBetween(1, 90),
            'codigo_pedido' => $this->faker->numberBetween(4,5),
            'sequencia'=> $this->faker->numberBetween(3, 4),
            'nome' => $this->faker->name(),
            'qtdvendida' =>$this->faker->numberBetween(1, 2),
            'qtdentregue'=> $this->faker->numberBetween(0,1),
            'campo1' => $this->faker->word(1),
            'campo2' => $this->faker->word(1),
            'campo3' => $this->faker->word(1),
        ];
    }
}
