<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Order::class;

     //private 
    public function definition()
    {
        return [
            "client_id"=>Client::inRandomOrder()->first()->id,
            "nombre"=>$this->faker->word(),
            "fecha"=>$this->faker->dateTime("d-m-Y"),
            "descripcion"=>$this->faker->paragraph(),
            //"disponible"=>$this->faker->boolean(),
            
        



           /* DB::table('products')->insert([
                'nombre' => 'Alicates',
                'descripcion' => 'Alicates molones',
                'precio' => 3.20,
            ]);*/

        ];
    }
}
