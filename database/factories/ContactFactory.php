<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

class ContactFactory extends Factory
{
    protected $model = \App\Models\Contact::class;

    public function definition()
    {
        $faker = FakerFactory::create('ja_JP');

        return[
            'name' => $faker->name(),
            'email' => $faker->safeEmail(),
            'message' => $faker->realText(50),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}