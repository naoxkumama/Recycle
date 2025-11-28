<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

class ReservationFactory extends Factory
{
    protected $model = \App\Models\Reservation::class;

    public function definition()
    {
        $faker = FakerFactory::create('ja_JP');
        return[
            'name' => $faker->name(),
            'phone' => $faker->phoneNumber(),
            'first' => $faker->date(),
            'second' => $faker->date(),
            'third' => $faker->date(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}