<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Film;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class FilmFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Film::class;
    public function definition()
    {
        return [
            "nombre"=>$this->faker->firstName(),
            "genero"=>$this->faker->lastName(),
            "descripcion"=>$this->faker->paragraph(),
            "anyo"=>$this->faker->year(),
        ];
    }
}
