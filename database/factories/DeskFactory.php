<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Desk>
 */
class DeskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    private static $desk_number = 1;

    public function definition(): array
    {
        return [
            'area_id' => '1',
            'desk_number' => self::$desk_number++,
        ];
    }
}
