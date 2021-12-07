<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'codigo'=> $this->faker->numberBetween(1, 99),
            'nome' => $this->faker->name,
            'cnpj' => $this->faker->numberBetween(11111111111,99999999999),
            'email'=> $this->faker->email(),
            'tipo' => $this->faker->randomElement($array = array ('F','J')),
            'municipio'=> $this->faker->numberBetween(1, 99),
        ];
    }
}
