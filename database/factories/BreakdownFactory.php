<?php

namespace Database\Factories;

use App\Models\Breakdown;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class BreakdownFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Breakdown::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $start = Carbon::parse('2021-01-01T00:00:00');
        $end = Carbon::parse('2021-03-01T12:00:00');
        return [
            'starts_at' => $start,
            'ends_at' => $end,
            'time_expression' => $this->faker->regexify('/^([0-9]*[mdhis])(,[0-9]*[mdhis])*$/')
        ];
    }
}
