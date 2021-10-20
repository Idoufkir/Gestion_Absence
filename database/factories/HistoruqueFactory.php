<?php

namespace Database\Factories;

use App\Models\Historique;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class HistoruqueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Historique::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "user_id" => \App\Models\User::factory()->create()->id,
            "motif_id" => \App\Models\Motif::factory()->create()->id,
        ];
    }
}
