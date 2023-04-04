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
            
            
            "nombre"=>$this->faker->word(),
            "descripcion"=>$this->faker->paragraph(),
            "anyoLanzamiento"=>$this->faker->numberBetween($min="1985",$max="2023"),
            "generos"=>$this->faker->randomElements($array=["accion","aventura","rpg","misterio","peleas","puzles",
                    "metroidvania","arcade","simulacion","musica","estrategia","historia"],$count=$this->faker->numberBetween($min="1",$max="3")),
            "plataformas"=>$this->faker->randomElements($array=["Switch","PS4","PS3","PS2","PS1","Xbox","Xbox360","XboxOne","XboxSeriesX","PC"],$count=$this->faker->numberBetween($min="1",$max="3")),
            "precio"=>$this->faker->numberBetween($min="0",$max="80"),
        
        ];
    }
}
