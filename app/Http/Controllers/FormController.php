<?php

/**
 * FormController
 *
 * Filename:        FormController.php
 * Location:        /App/Http/Controllers
 * Project:         my-laravel-app
 * Date Created:    19/12/2024
 *
 * Author:          Michael Reed
 *
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submission;

class FormController extends Controller
{
    /**
     * Show the form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function showForm()
    {
        return view('form');
    }

    /**
     * Return the submissions index view (paginated)
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function submitForm(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // Save the data to the database
        Submission::create($request->all());

        // Redirect to the landing page with a success message
        return redirect('/')->with('success', 'Form submitted successfully!');
    }

    public function index()
    {
        $submissions = Submission::paginate(5); // Fetch 5 items per page
        return view('submissions', compact('submissions'));
    }
}
