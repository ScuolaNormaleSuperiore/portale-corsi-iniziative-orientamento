<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use Faker\Generator as Faker;
use Faker\Factory as FakerFactory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
trait LocalizeFakerFactoryTrait
{
    public function setFakerLocale($locale) {
        $this->faker = FakerFactory::create($locale);
    }

}