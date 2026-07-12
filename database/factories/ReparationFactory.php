<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Vehicule;

class ReparationFactory extends Factory
{
    protected $model = \App\Models\Reparation::class;

    public function definition()
    {
        return [
            'vehicule_id'=>Vehicule::factory(),
            'date'=>$this->faker->date(),
            'duree_main_oeuvre'=>$this->faker->randomElement(['1h','2h','3h']),
            'objet_reparation'=>$this->faker->sentence,
        ];
    }
}