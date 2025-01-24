<?php

/**
 * FormController
 *
 * Filename:        FormController.php
 * Location:        /App/Controllers
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
     * Handle form submission
     * @param  Request  $request
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function submitForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Convert HTML to Markdown before saving
        $markdown = htmlToMarkdown($request->message);

        Submission::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $markdown,
        ]);

        return redirect('/')->with('success', 'Form submitted successfully!');
    }

    /**
     * Return the submissions index view (paginated)
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $submissions = Submission::paginate(5); // Fetch 5 items per page
        return view('submissions', compact('submissions'));
    }

}
