<?php

/**
 * SubmissionSeeder
 *
 * Filename:        SubmissionSeeder.php
 * Location:        /database/seeders/
 * Project:         my-laravel-app
 * Date Created:    21/12/2024
 *
 * Author:          Michael Reed
 *
 */

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Submission;

class SubmissionSeeder extends Seeder
{
    /**
     * Seed the application's Submission database.
     * @return void
     */
    public function run()
    {
        Submission::factory()->count(12)->create(); // Generate 12 test records
    }
}
