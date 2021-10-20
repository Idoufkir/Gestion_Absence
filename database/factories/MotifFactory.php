<?php

namespace Database\Factories;

use App\Models\Motif;
use Illuminate\Database\Eloquent\Factories\Factory;

class MotifFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Motif::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'Motifname' => $this->faker->Motifname(),
        ];
    }
}
