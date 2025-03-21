<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{

    use LocalizeFakerFactoryTrait;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $this->setFakerLocale('it_IT');
        $email =  $this->faker->unique()->safeEmail;
        return [
            'name' => $email,
            'email' => $email,
            'nome' => $this->faker->firstName,
            'cognome' => $this->faker->lastName,
//            'codice_fiscale' => $this->faker->taxId(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

}
