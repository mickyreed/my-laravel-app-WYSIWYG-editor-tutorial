<?php

/**
 * SubmissionFactory
 *
 * Filename:        SubmissionFactory.php
 * Location:        /database/factories/
 * Project:         my-laravel-app
 * Date Created:    21/12/2024
 *
 * Author:          Michael Reed
 *
 */

namespace Database\Factories;

use App\Models\Submission;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubmissionFactory extends Factory
{
    protected $model = Submission::class;

    /**
     * @return array|mixed[]
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->safeEmail,
            'message' => $this->faker->sentence,
        ];
    }
}
