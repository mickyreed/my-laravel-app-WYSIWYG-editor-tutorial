<?php
/**

- StaticPageController
-
- Filename: StaticPageController.php
- Location: /App/Http/Controllers
- Project: my-laravel-app
- Date Created: 19/12/2024
-
- Author: Michael Reed
- */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    /**
    _ @return \Illuminate\Contracts\View\Factory|
    \Illuminate\Contracts\View\View|
    \Illuminate\Foundation\Application
    _*/
    public function landingPage()
    {
        return view('landing');
    }
}
