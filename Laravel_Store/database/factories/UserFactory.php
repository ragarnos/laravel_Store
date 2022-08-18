<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $role = Role::customer()->first();
        $faker = \Faker\Factory::create();
        return [
            'role_id' => $role->id,
            'name' => $faker->name,
            'surname' => $faker->lastName(),
            'birthdate' => $faker->dateTimeBetween('-70 years', '-18 years')->format('Y-m-d'),
            'email' => $faker->unique()->safeEmail(),
            'phone' => $faker->unique()->e164PhoneNumber,
            'email_verified_at' => now(),
            'password' => Hash::make('test1234'),
            'remember_token' => Str::random(10),
        ];
    }

    public function admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'role_id' => Role::admin()->first()->id,
            ];
        });
    }

    public function withEmail(string $email)
    {
        return $this->state(function (array $attributes) use ($email) {
            return [
                'email' => $email,
            ];
        });
    }
    public function withPassword(string $password)
    {
        return $this->state(function (array $attributes) use ($password) {
            return [
                'password' => Hash::make($password)
            ];
        });
    }
}
