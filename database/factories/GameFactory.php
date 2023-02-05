<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Game;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Game::class;
    public function definition()
    {
        return [
            "nombre"=>$this->faker->firstName(),
            "plataforma"=>$this->faker->lastName(),
            "descripcion"=>$this->faker->paragraph(),
            "anyo"=>$this->faker->year(),
        ];
    }
}
