<?php

namespace Database\Factories;

use App\Models\WriterModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class WriterModelFactory extends Factory
{
    protected $model = WriterModel::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'portrait_path' => null,
            'bio' => $this->faker->sentence()
        ];
    }
}
