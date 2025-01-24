<?php

/**
 * Submission Model
 * A Model that represents our Input Data being saved from our user Form
 *
 * Filename:        Submission.php
 * Location:        app/Models/
 * Project:         my-laravel-app
 * Date Created:    21/12/2024
 *
 * Author:          Michael Reed
 *
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'message'];
}
