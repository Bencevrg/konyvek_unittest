<?php

namespace Database\Factories;

use App\Models\BookModel;
use App\Models\WriterModel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $books = BookModel::factory()->create();
        return [
            //
        ];
    }
}
