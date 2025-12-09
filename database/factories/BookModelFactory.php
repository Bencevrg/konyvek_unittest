<?php

namespace Database\Factories;

use App\Models\BookModel;
use App\Models\WriterModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookModelFactory extends Factory
{
   protected $model = BookModel::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'author_id' => WriterModel::factory(),
            'image_path' => null,
            'iban' => $this->faker->unique()->isbn13(),
            'price' => $this->faker->randomFloat(2, 5, 200),
            'description' => $this->faker->paragraph(),
            'genre' => 'Novel'
        ];
    }
}
