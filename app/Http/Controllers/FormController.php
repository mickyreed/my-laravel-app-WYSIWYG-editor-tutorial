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
     * @param  Request  $request
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function submitForm(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Save to the database
        Submission::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        // Redirect with success message
        return redirect()->back()->with('success', 'Form submitted successfully!');
    }
}
