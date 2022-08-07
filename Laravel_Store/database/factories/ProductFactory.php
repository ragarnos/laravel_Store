<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class ProductFactory extends Factory
{

    public function definition()
    {
        $fake = \Faker\Factory::create();
        return [
            'title' => $fake->unique()->word(),
            'description' => $fake->paragraph(rand(1, 5)),
            'short_description' => $fake->words(5, true),
            'SKU' => $fake->unique()->ean8(),
            'price' => $fake->randomFloat(2, 10, 100),
            'discount' => rand(0, 90),
            'in_stock' => rand(0, 15),
            'thumbnail' => $fake->imageUrl(category:'animals', randomize: true),
        ];
    }
}
