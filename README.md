# Tutorial - Building a Laravel 11 Application and implementing and customising a WYSIWYG Editor using CKEditor5:

### By Michael Reed

<a name="readme-top"></a>

<br>

#### Built With

[![PHP][Php.com]][Php-url]
[![Tailwindcss][Tailwindcss.com]][Tailwindcss-url]
[![GitHub][GitHub-shield]][GitHub-url]
[![MySQL][MySQL-shield]][MySQL-url]

[![PHPStorm][Jetbrains.com]][PHPStorm-url]
[![Laravel][Laravel.shield]][Laravel-url]
[![HTML][HTML]][HTML-url]
[![CSS][CSS-shield]][CSS-url]

<br>

## Table of Contents

- [Tutorial Part 1 - Building the basic Laravel 11 Application](#tutorial-part-1)

    - [Project Requirements](#step-by-step-guide-to-creating-a-basic-laravel-11-app-including)
    - [Install Laravel 11](#install-laravel-11)
    - [Configure the Application](#configure-the-application)
    - [Create a Static Landing Page](#create-a-static-landing-page)
    - [Adding a Form with Validation and Database Storage](#adding-a-form-with-validation-and-database-storage)
    - [Adding Navigation Buttons to a Laravel Application](#adding-navigation-buttons-to-a-laravel-application)
    - [Styling our App with Tailwind CSS](#styling-our-app-with-tailwind-css)
    - [Displaying the Submissions (with Pagination)](#displaying-the-submissions-with-pagination)
    - [Optional - Seed Test Data](#optional-seed-test-data)
    - [Redirect to the Landing Page](#redirect-to-the-landing-page)
    - [Add a Success Message to the Landing Page](#add-a-success-message-to-the-landing-page)
    - [Tutorial Part 1 Summary](#what-we-achieved-in-this-tutorial)

<br>

- [Tutorial PART 2 - Implementing the WYSIWYG Editor](#tutorial-part-2)

    - [Setup and Package Installation](#setup-aand-package-installation)
    - [Create Helper Functions](#create-helper-functions)
    - [Improving the editor by customising some of our options](#improving-the-editor-by-customising-some-of-our-options)
    - [Add Styles for Paragraph headings](#add-styles-for-paragraph-headings)
    - [Adding more Styling options](#adding-more-styling-options)
    - [Tutorial Part 2 Summary](#what-we-have-achieved)
    - [Final Thoughts](#final-thoughts)
  
  <p align="right">(<a href="#readme-top">back to top</a>)</p>

  <br>
  <br>

# Tutorial Part 1:

# Creating a basic Laravel 11 & Tailwind CSS multi-page Application with navigation, a submittable form, and database

## Step-by-Step Guide to Creating a Basic Laravel 11 App including:

    - A Landing Page and Static Controller
    - A Form Page with a form that saves User Input to a MySql database
    - A MySql Database to hold our data
    - Tailwind CSS Styles
    - Buttons for navigation.
    - A submissions Page to view our saved submissions
    - Pagination for the submissions page with five submissions per page
    - Seeded dummy data to test the pagination
    - Redirection to the landing page with a success message upon a successful submission

<p align="right">(<a href="#readme-top">back to top</a>)</p>

## Install Laravel 11

1. **Ensure prerequisites are installed**:

    - PHP (>= 8.3.1.1)
    - Composer (latest version)
    - MySQL (>=8.0.30)
    - Laragon (>= 6.0 220916) (we will be using PhpMyAdmin to access the database)
    - Laravel 11
    - PhpStorm
   
    <br>

2. **Install Laravel via Composer**:

   ```bash
   composer create-project --prefer-dist laravel/laravel:^11.0 my-laravel-app
   ```

   </br>

3. **Navigate to your project directory**:

   ```bash
   cd my-laravel-app
   ```

   <br>

4. **Run the development server**:

   ```bash
   php artisan serve
   ```

<br>

### The application will be accessible at http://127.0.0.1:8000.

<br>

<p align="right">(<a href="#readme-top">back to top</a>)</p>

## Configure the Application

1. **Set up your environment**:

    - Rename .env.example to .env (if not already done):

   ```bash
   cp .env.example .env
   ```

   <br>

    - Generate an application key:

   ```bash
   php artisan key:generate
   ```

   <br>

2. **Configure database settings**:

    - Open .env and update the database credentials:

   ```dotenv
       DB_CONNECTION=mysql
       DB_HOST=127.0.0.1
       DB_PORT=3306
       DB_DATABASE=my_database
       DB_USERNAME=root
       DB_PASSWORD=
   ```

      <br>

3. **Create the database my_database in MySQL.**
    - Open up Laragon and select Database
    - Log into PhpMyAdmin using the UserName root with no password
    - Create a new database with the name as noted under DB_DATABASE above which in this case is my_database

<br>

4. **Run the migrations**: Apply the changes to create the table in the database:

```bash
  php artisan migrate
```

<p align="right">(<a href="#readme-top">back to top</a>)</p>

## Create a Static Landing Page

1. **Create a Controller**:

   ```bash
   php artisan make:controller StaticPageController
   ```

   <br>

2. **Add a method for the landing page**:

    - Open up PhpStorm and then navigate to and open up your newly created project folder
    - Open app/Http/Controllers/StaticPageController.php and add:

   ```php
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
   ```

 <br>

3. **Create a View for the Landing Page**:

    - Create a new file at resources/views/landing.blade.php:

```bash
touch resources/views/landing.blade.php
```

- We will use bootstrap via cdn for styling for now, using href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
  if this is underlined in phpStorm you may need to click on this to download the library

```html
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Laravel 11 Landing Page</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    />
  </head>
  <body>
    <div class="container text-center mt-5">
      <h1>Welcome to My Laravel 11 App</h1>
      <p>This is a basic landing page built with Laravel.</p>
    </div>
  </body>
</html>
```

   <br>

4. **Define a Route**:

    - Open routes/web.php and update it to the following (commenting out or removing the existing welcome route):

   ```php
       use Illuminate\Support\Facades\Route;
       use App\Http\Controllers\StaticPageController;

       Route::get('/', [StaticPageController::class, 'landingPage'])->name('landing');

       //Route::get('/', function () {
       //    return view('welcome');
       //}) ;
   ```

   <br>

5. **Verify the Landing Page**:  
   Visit http://127.0.0.1:8000 in your browser. You should see the landing page.

This is the basic foundation for our App, we will extend it with a form in the next steps.

<p align="right">(<a href="#readme-top">back to top</a>)</p>


## Adding a Form with Validation and Database Storage:

### Step 1: Create the Database Table

- First, we need to create a table to store the form data.

1. **Generate a Migration File**: Run the following Artisan command to create a migration file:

```bash
    php artisan make:migration create_submissions_table
```

<br>

2. **Define the Table Structure**: Open the generated migration file in database/migrations/
   (e.g., 2024_12_17_000000_create_submissions_table.php) and edit it:

```php
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->text('message');
            $table->timestamps();
        });
    }
```

<br>

3. **Run the Migration**: Apply the changes to create the table in the database:

```bash
    php artisan migrate
```

<br>

### Step 2: Create a Model for the Submissions Table

1. **Generate the Model**: Run the following command:

```bash
    php artisan make:model Submission
```

<br>

2. **Define Fillable Fields**: Open app/Models/Submission.php **and configure the model:**

```php
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
```

<br>

### Step 3: Create a Form Controller

1. **Generate a Controller:** Run the following command:

```bash
    php artisan make:controller FormController
```

<br>

2. **Define Methods in the Controller: Open** app/Http/Controllers/FormController.php **and add the following methods:**

```php
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
```

<br>

### Step 4: Create the Form View

1. **Create the Blade Template: Create a new file at** resources/views/form.blade.php:

```bash
touch resources/views/form.blade.php
```

```html
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Form</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    />
  </head>
  <body>
    <div class="container mt-5">
      <h1>Contact Us</h1>

      @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <form action="{{ route('form.submit') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input
            type="text"
            name="name"
            class="form-control"
            id="name"
            required
          />
          @error('name')
          <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input
            type="email"
            name="email"
            class="form-control"
            id="email"
            required
          />
          @error('email')
          <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
          <label for="message" class="form-label">Message</label>
          <textarea
            name="message"
            class="form-control"
            id="message"
            rows="5"
          ></textarea>
          @error('message')
          <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </body>
</html>
```

<br>

### Step 5: Define Routes

1. **Open** routes/web.php **and add the following routes**:

```php
use App\Http\Controllers\FormController;

Route::get('/form', [FormController::class, 'showForm'])->name('form.show');
Route::post('/form', [FormController::class, 'submitForm'])->name('form.submit');
```

<br>

### Step 6: Test the Form

1. **Visit http://127.0.0.1:8000/form to view the form.**:
2. **Fill in the form and submit.**:
3. **Open up the database in phpMyAdmin to Check your database table submissions to verify the data has been saved.**:

<br>

## Adding Navigation Buttons to a Laravel Application

### Step 1: Update the Landing Page with a Button to the Form Page

1. **Edit the Landing Page Blade Template as shown below**:

```html
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Laravel 11 Landing Page</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    />
  </head>
  <body>
    <div class="container text-center mt-5">
      <h1>Welcome to My Laravel 11 App</h1>
      <p>This is a basic landing page built with Laravel.</p>
      <a href="{{ route('form.show') }}" class="btn btn-primary">Go to Form</a>
    </div>
  </body>
</html>
```

<br>

2. **Check the Route for the Landing Page**:

- Open routes/web.php and add check the following route is correct:

```php
    Route::get('/', [StaticPageController::class, 'landingPage'])->name('landing');
```

<br>

### Step 2: Add a Cancel Button to the Form Page

1. **Update the Form Blade Template**:

- **Edit** resources/views/form.blade.php **to include a cancel button:**

```html
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Form</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    />
  </head>
  <body>
    <div class="container mt-5">
      <h1>Contact Us</h1>

      @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <form action="{{ route('form.submit') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input
            type="text"
            name="name"
            class="form-control"
            id="name"
            required
          />
          @error('name')
          <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input
            type="email"
            name="email"
            class="form-control"
            id="email"
            required
          />
          @error('email')
          <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
          <label for="message" class="form-label">Message</label>
          <textarea
            name="message"
            class="form-control"
            id="message"
            rows="5"
          ></textarea>
          @error('message')
          <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="/" class="btn btn-secondary">Cancel</a>
      </form>
    </div>
  </body>
</html>
```

<br>

### Step 3: Test the Navigation

<br>

1. **Restart your Laravel development server again if required**:

```bash
  php artisan serve
```

2. **On the landing page: http://127.0.0.1:8000/**:

    - Verify the "Go to Form" button redirects to the form page.

3. **On the the form page: http://127.0.0.1:8000/form**:

    - Verify the "Cancel" button redirects back to the landing page.

<br>

## Styling our App with Tailwind CSS

- As you may have noticed the example provided uses Bootstrap via a CDN.
- We will be using Tailwind CSS instead of Bootstrap.
- So let's update the setup to work with Tailwind CSS:
- We will also add "Go to Form" and "Cancel" buttons to make it easy to navigation between the views
  
<br>

### Step 1: Verify Tailwind CSS Installation

- Lets install Tailwind, or if already installed, check that Tailwind CSS and its dependencies are installed correctly:

```bash
  npm install -D tailwindcss postcss autoprefixer
  npx tailwindcss init
```

<br>

### Step 2: Check Your Vite Configuration

- Let's ensure your vite.config.js is set up properly.
- First Let's install npm

```bash
  npm install
```

Open the vite.config.js file and check the following:

```php
  import { defineConfig } from 'vite';
  import laravel from 'laravel-vite-plugin';

  export default defineConfig({
      plugins: [
          laravel({
              input: ['resources/css/app.css', 'resources/js/app.js'],
              refresh: true,
          }),
      ],
  });
```

<br>

### Step 3: Check Your Blade Templates for the Correct References

In both of your Blade templates, ensure the CSS and JS files are being referenced correctly:
removed the existing link references and replace them with the following:

```php
  @vite(['resources/css/app.css', 'resources/js/app.js'])
```

<br>

### Step 4: Verify Tailwind Directives

- Check that resources/css/app.css contains:

```css
@tailwind base;
@tailwind components;
@tailwind utilities;
```

<br>

### Step 5: Run Vite Dev Server

- Start the Vite dev server:

```bash
  npm run dev
```

- If you visit the landing page or form page now, you will see the styles are not working properly.
  This is becuase we have not updated our views to use tailwind css, we will do this next.

<br>

### Step 6: Update the Landing Page to Use Tailwind CSS

- Replace the landing.blade.php content with the following:

```html
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Landing Page</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="text-center">
      <h1 class="text-4xl font-bold text-gray-800">
        Welcome to My Laravel App
      </h1>
      <p class="text-gray-600 mt-4">
        Click the button below to navigate to the form page.
      </p>
      <a
        href="{{ route('form.show') }}"
        class="mt-6 inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded"
      >
        Go to Form
      </a>
    </div>
  </body>
</html>
```

<br>

### Step 7: Update the Form Page to Use Tailwind CSS

- Replace the form.blade.php content with:

```html
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Form</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 w-full max-w-md">
      <h1 class="text-2xl font-bold mb-4">Contact Us</h1>

      @if(session('success'))
      <div
        class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4"
      >
        {{ session('success') }}
      </div>
      @endif

      <form action="{{ route('form.submit') }}" method="POST">
        @csrf
        <div class="mb-4">
          <label for="name" class="block text-gray-700 font-bold mb-2"
            >Name</label
          >
          <input
            type="text"
            name="name"
            id="name"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
            required
          />
          @error('name')
          <small class="text-red-500">{{ $message }}</small> @enderror
        </div>

        <div class="mb-4">
          <label for="email" class="block text-gray-700 font-bold mb-2"
            >Email</label
          >
          <input
            type="email"
            name="email"
            id="email"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
            required
          />
          @error('email')
          <small class="text-red-500">{{ $message }}</small> @enderror
        </div>

        <div class="mb-4">
          <label for="message" class="block text-gray-700 font-bold mb-2"
            >Message</label
          >
          <textarea
            name="message"
            id="message"
            rows="4"
            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
          ></textarea>
          @error('message')
          <small class="text-red-500">{{ $message }}</small> @enderror
        </div>

        <div class="flex items-center justify-between">
          <button
            type="submit"
            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"
          >
            Submit
          </button>
          <a
            href="/"
            class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded"
          >
            Cancel
          </a>
        </div>
      </form>
    </div>
  </body>
</html>
```

### Step 8: Test Your Application

- Access your application at http://127.0.0.1:8000 and check if the styles and scripts load properly now.
- Test the "Go to Form" and "Cancel" buttons to confirm navigation works seamlessly.

<p align="right">(<a href="#readme-top">back to top</a>)</p>


## Displaying the Submissions (with Pagination)

- Lets create a view to display the submissions information,
  and have these use pagination to show 5 submissions per page.
  
<br>

### Step 1: Add a New Method to FormController

- Update your FormController to include an index method for fetching and paginating submissions:

```php
  public function index()
  {
      $submissions = Submission::paginate(5); // Fetch 5 items per page
      return view('submissions', compact('submissions'));
  }
```

<br>

### Step 2: Update the Routes

- Edit the web.php file to define a route for listing submissions:

```PHP
  Route::get('/submissions', [FormController::class, 'index'])->name('form.index');
```

<br>

### Step 3: Create the Submissions Blade View

- Create a new file in resources/views/submissions.blade.php for the submissions list:

```bash
touch resources/views/submissions.blade.php
```

```html
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Submissions</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>

  <body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-6">
      <h1 class="text-3xl font-bold text-center mb-6 text-gray-800">
        Submissions
      </h1>

      <!-- Back Button -->
      <div class="flex justify-end mb-4">
        <a
          href="/"
          class="px-4 py-2 bg-blue-500 text-white rounded shadow hover:bg-blue-600 transition"
        >
          Back to Landing Page
        </a>
      </div>

      <!-- Submissions Table -->
      <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full border-collapse border border-gray-200">
          <thead class="bg-gray-200">
            <tr>
              <th
                class="text-left px-6 py-3 border-b border-gray-300 font-medium text-gray-600"
              >
                Name
              </th>
              <th
                class="text-left px-6 py-3 border-b border-gray-300 font-medium text-gray-600"
              >
                Email
              </th>
              <th
                class="text-left px-6 py-3 border-b border-gray-300 font-medium text-gray-600"
              >
                Message
              </th>
            </tr>
          </thead>
          <tbody>
            @forelse ($submissions as $submission)
            <tr class="hover:bg-gray-50 transition">
              <td class="px-6 py-4 border-b border-gray-300 text-gray-800">
                {{ $submission->name }}
              </td>
              <td class="px-6 py-4 border-b border-gray-300 text-gray-800">
                {{ $submission->email }}
              </td>
              <td
                class="px-6 py-4 border-b border-gray-300 text-gray-800 message-content"
              >
                {{ $submission->message }}
              </td>
            </tr>
            @empty
            <tr>
              <td
                colspan="3"
                class="text-center px-6 py-4 border-b border-gray-300 text-gray-600"
              >
                No submissions found.
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="mt-3 px-6 py-4 flex justify-center">
        {{ $submissions->links('pagination::tailwind') }}
      </div>
    </div>
  </body>
</html>
```

<br>

### Step 4: Update the Landing Page

- Modify resources/views/landing.blade.php to include a button linking to the submissions list:

```html
<a
  href="{{ route('form.index') }}"
  class="mt-6 inline-block bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded"
>
  View Submissions
</a>
```

<br>

### Step 5: Test Your Application

- Ensure you have some data in your submissions table. (eg fill out the form and submit it)

- Access your application at http://127.0.0.1:8000
- Click the View Submissions button. You should see the list of submissions.
  (Note: you will only see the pagination if you have added 5 or more submissions.)

<p align="right">(<a href="#readme-top">back to top</a>)</p>

## Optional - Seed Test Data

- If your submissions table is empty, you can seed some test data:
  
<br>

### Step 1. Create a Seeder

Run:

```bash
  php artisan make:seeder SubmissionSeeder
```

- Edit database/seeders/SubmissionSeeder.php: and add the following

```php

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
```

<br>

### Step 2. Add a Factory (if not already present)

Run:

```bash
  php artisan make:factory SubmissionFactory
```

- Edit database/factories/SubmissionFactory.php:

```php

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
```

<br>

### Step 3. Run the Seeder

```bash
  php artisan db:seed --class=SubmissionSeeder
```

- This will populate your database with dummy data, making it easier to test the pagination

<p align="right">(<a href="#readme-top">back to top</a>)</p>


## Add a Redirect to the Landing Page

- In the FormController method where you handle the form submission (e.g., store method),
  Let's Modify the code, making it more concise, and modifying the redirect() as below to ensure it redirects to the landing page when the submission is successful:
  Our Form.blade.php already has a redirect if the submission doesnt validate, so we dont need to change this.

```php
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
```

<p align="right">(<a href="#readme-top">back to top</a>)</p>

## Add a Success Message to the Landing Page

- In the landing.blade.php file, update this to display a success message using Laravel's session flash data:

```php
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title class="bg-blue-500 text-white p-4">Laravel 11 Landing Page</title>
      @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>

  <body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="text-center">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <h1 class="text-4xl font-bold text-gray-800">Welcome to My Laravel App</h1>

        <p class="text-gray-600 mt-4">Click the button below to navigate to the form page.</p>
        <a href="{{ route('form.show') }}"
          class="mt-6 inline-block bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
            Go to Form
        </a>
        <a href="{{ route('form.index') }}" class="mt-6 inline-block bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded">View Submissions</a>

    </div>
  </body>
</html>
```

<br>

### With these steps above, when you submit the form, you will:

    - Be redirected to the landing page.
    - See a success message if the submission was successful.
    - You can test this by Going to the Form View and making a submission.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<br>

# This completes the Basic Laravel Application!

<br>

## What we achieved in this Tutorial

- We created a Landing Page and a Form to Submit on a separate Page.
- We Styled the Pages using Tailwind, and added some buttons for navigation.
- We added a submissions index page to show our submissions
- We added pagination to the submissions page with five submissions per page
- We Set up the Database and seeded some dummy data to test the pagination
- We added a re-direction to the landing page with an alert message upon a successful submission

  <br>

## In Part 2 of the Tutorial we will

- Introduce a WYSIWYG (What you see is what you get) editor, for better control over the styling of our message content.
- We will introduce a module that saves the message in Markdown, and then on the submissions index page will convert this back to html to display in the view
- We will introduce a 'helper' class to help facilitate this
- We will play with some css to get the stylimg working for some of the elements in the WYSIWYG editor

<br>

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<br>

# Tutorial PART 2

## Step-by-Step Guide to Adding and customising a WYSIWYG Content Editor in Laravel 11

## In Part 1 of our Tutorial:

- We created a Landing Page and a Form to Submit on a separate Page.
- We Styled the Pages using Tailwind, and added some buttons for navigation.
- We added a submissions index page to show our submissions
- We added pagination to the submissions page with five submissions per page
- We Set up the Database and seeded some dummy data to test the pagination
- We added a re-direction to the landing page with an alert message upon a successful submission

## In Part 2 we will:

- Introduce a WYSIWYG (What you see is what you get) editor, for better control over the styling of our message content.
- We will introduce a module that saves the message in Markdown, and then on the submissions index page will convert this back to html to display in the view
- We will introduce a 'helper' class to help facilitate this
- We will play with some css to get the stylimg working for some of the elements in the WYSIWYG editor

  <br>

## Prerequisites

- PHP (>= 8.3.1.1)
- Composer (latest version)
- MySQL (>=8.0.30)
- Laragon (>= 6.0 220916) (we will be using PhpMyAdmin to access the database)
- Laravel 11
- Our Previously built basic Laravel Application (if you havent done this yet, you need to complete this first!)
- 
<p align="right">(<a href="#readme-top">back to top</a>)</p>

## Setup and Package Installation

### Install required packages:

- Lets install the following packages via composer
    - The WYSIWYG Editor - ckeditor/ckeditor
    - html to markdown converter - league/htmlToMarkdown
    - markdown to html converter - league/commonmark library

<br>

```bash
# Install the required packages
composer require ckeditor/ckeditor league/html-to-markdown league/commonmark
```

The league/html-to-markdown and league/commonmark packages are part of the League of Extraordinary Packages,
and can be used in a Laravel 11 application to work with Markdown and HTML conversions.

Basically, Here's what they do:

- league/html-to-markdown - Converts HTML content (eg User input from the WYSIWYG editor) to Markdown format
- league/commonmark - A robust markdown parser & renderer that Converts Markdown content to HTML

<br>

```bash
# Install npm dependencies
npm install @ckeditor/ckeditor5-build-classic
```

- The Classic Version of the CKEditor from https://ckeditor.com
- CKEditor is a modern, feature-rich and customisable JavaScript editor.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

## Create Helper Functions

- ### We will create a 'htmlToMarkdown' function we use the CommonMarkConverter to convert HTML to Markdown
- ### We will also a 'markdownToHtml' function which uses the CommonMarkConverter to convert Markdown back to HTML:

<br>

### Step 1: Create a new PHP file app/helpers.php:

```bash
touch app/helpers.php
```

<br>

- Open app/helper.php and add the code below:

```php
<?php

/**
* helpers
* A helper file with functions to convert HTML to Markdown and Markdown to HTML
* using League\HTMLToMarkdown and League/CommonMark
*
* Filename:        helpers.php
* Location:        app/
* Project:         my-laravel-app
* Date Created:    22/12/2024
*
* Author:          Michael Reed
*
*/

use League\HTMLToMarkdown\HtmlConverter;
use League\CommonMark\CommonMarkConverter;

class ContentConverter
{
    /**
     * Convert HTML to Markdown
     *
     * @param string $html HTML content to convert
     * @return string Markdown content
     */
    public static function htmlToMarkdown($html)
    {
        $converter = new HtmlConverter([
            'strip_tags' => false,
            'remove_nodes' => 'script style',
        ]);

        return $converter->convert($html);
    }

    /**
     * Convert Markdown to HTML
     *
     * @param string $markdown Markdown content to convert
     * @return string HTML content
     */
    public static function markdownToHtml($markdown)
    {
        $converter = new CommonMarkConverter([
            'html_input' => 'allow',
            'allow_unsafe_links' => false,
        ]);

        return $converter->convertToHtml($markdown);
    }
}
```

### Step 2: Update Composer Autoload

- In composer.json, we need to add the helpers.php file to the autoload section as shown below, this will automatically load the helper file when our appplication starts:

```json
"autoload": {
        "psr-4": {
            "App\\": "app/",
            "Database\\Factories\\": "database/factories/",
            "Database\\Seeders\\": "database/seeders/"
        },
        "files": [
            "app/helpers.php"
        ]
    },
    "autoload-dev": {
        "psr-4": {
            "Tests\\": "tests/"
        }
    },
```

- Now, as you have changed the autoload section in your composer.json file to load a helper file, you need to refresh Composer's autoload configuration
- Run the following command to regenerate to autoload files:

```bash
composer dump-autoload
```

By adding "app/helpers.ph" to composer.json and running composer dump-autoload organizes our helper class under a dedicated namespace,
and we can then use this helper class anywhere in the application without manual include statements.

### Step 3: Modify Controller

- Update your Form Controller to use the new helper:

```php
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
```

### Step 4 - Update your resources/js/app.js:

- ckeditor5 requires a license key if you are building a commercial application,
  but for open source applications we can use the 'GPL' license

```php
import './bootstrap';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

document.addEventListener('DOMContentLoaded', () => {
    const messageEditor = document.querySelector('#message');

    if (messageEditor) {

        ClassicEditor
            .create(messageEditor, {
                licenseKey: 'GPL', // Use license key for commercial applications, or 'GPL' for Open source Projects.
                toolbar: ['heading', '|', 'bold', 'italic', '|', 'link', '|', 'redo', 'undo' ],
                placeholder: 'Enter your message here...'
            })
            .catch(error => {
                console.error(error);
            });
    }
});
```
<br>

### Step 5 - Testing your editor

- You should now have a functional CK Editor and be able to save your message content into markdown,
  and convert it back to html to display on the Submissions index view.
  ...But... if you test this you will find that even though bold and italic works well, as does the multi-line saving,
  the paragraph headings are not working - Lets modify some of the code and add some custom css to enable this to be handled, converted and viewed properly

<p align="right">(<a href="#readme-top">back to top</a>)</p>

## Improving the editor by customising some of our options

### Step 1: Open resources/js/app.js and update your code to the following,

- What we are adding is:
    - additional toolbar items
    - An array of default options for Paragraph Heading styles:
    - An option to hide or show the menuBar at the top

<br>

```php
import './bootstrap';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import 'ckeditor5/ckeditor5.css';
import '../css/app.css';

document.addEventListener('DOMContentLoaded', () => {
    const messageEditor = document.querySelector('#message');

    if (messageEditor) {
        ClassicEditor
            .create(messageEditor, {
                licenseKey: 'GPL',
                 toolbar: {
                    items: ['heading', '|', 'bold', 'italic', '|', 'link', '|', 'redo', 'undo' ],
                    shouldNotGroupWhenFull: false
                },

                // Add some Default Paragraph heading styles to select from
                //  Example: When a user selects "Heading 1" from the toolbar,
                //  the editor will format the selected text as an <h1> element,
                //  styled with the class ck-heading_heading1.
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                    ]
                },

                // Hide or Show the menu Bar at the top of the editor
                //  There is a tabbed menu bar available to use, however we will set this as false as we wont be using it
                menuBar: {
                    isVisible: false
                },

                placeholder: 'Enter your message here...',
            })
            .catch(error => {
                console.error(error);
            });
    }
});
```
<br>

### Step 2 - Update your HTML-to-Markdown conversion in your helper file (app/helpers.php):

```php
<?php

/**
* helpers
* helper functions to convert HTML to Markdown and Markdown to HTML
* using League\HTMLToMarkdown and League/CommonMark
*
* Filename:        helpers.php
* Location:        app/
* Project:         my-laravel-app
* Date Created:    22/12/2024
*
* Author:          Michael Reed
*
*/

use League\CommonMark\GithubFlavoredMarkdownConverter;
use League\HTMLToMarkdown\HtmlConverter;
use League\CommonMark\CommonMarkConverter;


if (!function_exists('htmlToMarkdown')) {
    function htmlToMarkdown($html) {
        $converter = new HtmlConverter([
            'header_style' => 'atx', // This ensures # style headers
            'strip_tags' => false,
            'remove_nodes' => 'script style',
        ]);
        return $converter->convert($html);
    }
}

if (!function_exists('markdownToHtml')) {
//    function markdownToHtml($markdown) {
//        $converter = new CommonMarkConverter([
//            'html_input' => 'allow',
//            'allow_unsafe_links' => false,
//        ]);
//        return $converter->convertToHtml($markdown);
//    }
    function markdownToHtml($markdown) {
        $config = [
            'html_input' => 'allow', // this ensures our font colours are displayed in the submissions view
            'allow_unsafe_links' => false,
        ];

        $converter = new GithubFlavoredMarkdownConverter($config);
        return $converter->convert($markdown);
    }
}

```

<br>

### Step 3: Understanding the changes to our functions:

### Firstly in our 'htmlToMarkdown' function which uses the CommonMarkConverter to convert HTML to Markdown:

- 'header_style' => 'atx'

  Specifies the style of headers in the Markdown output.
  "ATX" style means headers will use # symbols (e.g., # Header, ## Subheader) instead of the "Setext" style (e.g., underlined headers using === or ---).
  This ensures compatibility with most Markdown parsers.

- 'strip_tags' => false

  Controls whether non-convertible HTML tags (those that can't be converted to Markdown) are stripped or kept in the output.
  false means such tags are retained as plain text.

- 'remove_nodes' => 'script style'

  Specifies which types of HTML elements to remove entirely during the conversion process.
  Here, `<script>` and `<style>` tags (and their content) will be removed to avoid including unnecessary or potentially unsafe data in the output.

### For the 'markdownToHtml' function which uses the CommonMarkConverter to convert Markdown to HTML:

- #### We are changing this and switching to GitHub Flavored Markdown and changing the function to suit (i have commented out the old function code above and left it as a reference)

- GitHub Flavored Markdown (GFM) is an extended version of CommonMark with additional features, such as:

    - Support for tables.
    - Strikethrough text.
    - Automatic URL linking.
    - Task lists (- [ ] and - [x] syntax).

<br>

- 'html_input' => 'allow'

  Defines how HTML embedded in Markdown should be handled during conversion.
  'strip' removes any HTML tags in the Markdown input, whilst 'allow' enables them. This allows us to display the font colours in our submissions view

- 'allow_unsafe_links' => false

  Prevents unsafe links (e.g., javascript: or other malicious URLs) from being included in the HTML output.
  This is a security measure to protect users from XSS attacks.
  
  <p align="right">(<a href="#readme-top">back to top</a>)</p>

## Add Styles for Paragraph headings

### Step 1 - Let's Add some custom CSS to resources/css/app.css to ensure the headings are visually distinct in the editor on the form View:

```css
/* Preserve the Paragraph Heading Sizes in the Editor */
.ck-content h1 {
  font-size: 2em;
  font-weight: bold;
  margin-bottom: 0.5em;
}
.ck-content h2 {
  font-size: 1.5em;
  font-weight: bold;
  margin-bottom: 0.5em;
}
.ck-content h3 {
  font-size: 1.17em;
  font-weight: bold;
  margin-bottom: 0.5em;
}
```

### Step 2 - And we also need some more CSS in your app.css to ensure the headings are rendered correctly in the submissions index view:

```css
/* Preserve the Paragraph Heading styles in the submissions view */
.message-content h1 {
  font-size: 2em;
  font-weight: bold;
  margin-bottom: 0.5em;
}
.message-content h2 {
  font-size: 1.5em;
  font-weight: bold;
  margin-bottom: 0.5em;
}
.message-content h3 {
  font-size: 1.17em;
  font-weight: bold;
  margin-bottom: 0.5em;
}
```

### Step 3 - In your submissions.blade.php update the table cell to display the converted message

- Comment out or delete:

```php
    {{ $submission->message }}
```

- and change it to be:

```php
    {!! markdownToHtml($submission->message) !!}
```

- This section of code should now look like this:

```php
    @forelse ($submissions as $submission)
        <tr class="hover:bg-gray-50 transition">

            <td class="px-6 py-4 border-b border-gray-300 text-gray-800">{{ $submission->name }}</td>
            <td class="px-6 py-4 border-b border-gray-300 text-gray-800">{{ $submission->email }}</td>
            <td class="px-6 py-4 border-b border-gray-300 text-gray-800 message-content">
                {{!! markdownToHtml($submission->message) !!}}
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="3" class="text-center px-6 py-4 border-b border-gray-300 text-gray-600">
                No submissions found.
            </td>
        </tr>
    @endforelse
```

### Step 4 - Clear your caches and rebuild:

```bash
  php artisan cache:clear
  php artisan view:clear
  npm run dev
```

### Step 5 - Testing our Headings

- Navigate to the form view and create a new submission using one of the Heading styles
- After a successful submission, navigate to the submisssions view and select the last page.
- Your Heading style should now be working correctly.

### These changes should ensure that:

- The heading options are properly available in the editor dropdown and are display correctly in the editor
- The HTML-to-Markdown conversion properly preserves heading levels
- The Markdown-to-HTML conversion properly renders headings
- The rendered headings are properly styled in both the editor and the submissions view

<br>

## Adding more Styling options

- If we look up the possibilities for the CKEditor, we find more options available,
  Curremtly we are using the Classic Editor, but we can unlock and import more options by using the full editor version.
- Let's update our code as follows, and we will add in font sizes and font colours.

<br>

### Step 1 - Modify our app.js to use the full CKEditor and import some of the plugins.

- Visit https://ckeditor.com/ for more editor options.

```php
import './bootstrap';
//import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

import {
    ClassicEditor,
    AutoLink,
    Autosave,
    Bold,
    Essentials,
    FontColor,
    FontSize,
    Heading,
    Italic,
    Link,
    Paragraph,
    SpecialCharacters
} from 'ckeditor5';

import 'ckeditor5/ckeditor5.css';
import '../css/app.css';

document.addEventListener('DOMContentLoaded', () => {
    const messageEditor = document.querySelector('#message');

    if (messageEditor) {
        ClassicEditor
            .create(messageEditor, {
                licenseKey: 'GPL',
               toolbar: {
                    items: [
                        'heading', '|',
                        'fontSize', 'fontColor', '|',
                        'bold', 'italic', '|',
                        'link', '|',
                        'redo', 'undo' ],
                    shouldNotGroupWhenFull: false
                },

                plugins: [
                    AutoLink,
                    Autosave,
                    Bold,
                    Essentials,
                    FontColor,
                    FontSize,
                    Heading,
                    Italic,
                    Link,
                    Paragraph,
                    SpecialCharacters
                ],

                // Add some Default Font Sizes to select from
                fontSize: {
                    options: [10, 12, 14, 'default', 18, 20, 22],
                    supportAllValues: true
                },

                // Add some Default Paragraph heading Sizes to select from
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
                    ]
                },

                // Add Some default colours to select in the editor (Other then the colour Picker)
                fontColor: {
                    colors: [
                        {
                            color: 'rgb(0, 0, 0)',
                            label: 'Black'
                        },
                        {
                            color: 'rgb(230, 0, 0)',
                            label: 'Red'
                        },
                        {
                            color: 'rgb(0, 112, 0)',
                            label: 'Green'
                        },
                        {
                            color: 'rgb(0, 0, 255)',
                            label: 'Blue'
                        },
                        {
                            color: 'rgb(255, 165, 0)',
                            label: 'Orange'
                        },
                        {
                            color: 'rgb(128, 0, 128)',
                            label: 'Purple'
                        }
                    ]
                },

                // Hide or Show the menu Bar at the top of the editor
                 menuBar: {
                    isVisible: false
                },

                placeholder: 'Enter your message...',
            })
            .catch(error => {
                console.error(error);
            });
    }
});
```

<br>

### Step 2 - update our app.css:

```css
@tailwind base;
@tailwind components;
@tailwind utilities;

/* Make the editor height larger to show this is a multiline editor */
.ck-editor__editable_inline {
  min-height: 200px;
}

/* Preserve the Paragraph Heading Sizes in the Editor */
.ck-content h1 {
  font-size: 2em;
  font-weight: bold;
  margin-bottom: 0.5em;
}
.ck-content h2 {
  font-size: 1.5em;
  font-weight: bold;
  margin-bottom: 0.5em;
}
.ck-content h3 {
  font-size: 1.17em;
  font-weight: bold;
  margin-bottom: 0.5em;
}

/* Preserve the Paragraph Heading styles in the submissions view */
.message-content h1 {
  font-size: 2em;
  margin-bottom: 0.5em;
}

.message-content h2 {
  font-size: 1.5em;
  margin-bottom: 0.5em;
}

.message-content h3 {
  font-size: 1.17em;
  margin-bottom: 0.5em;
}

/* Add Blue Underline for Links */
.message-content a {
  color: #0066cc;
  text-decoration: underline;
}
```

<br>

### Step 3 - Test the editor.

- These changes have enabled the use Font Size and Font Colour in the editor.
- Create a message using various font sizes and colours and submit it.
- View the submission on the submission view and check that it displays correctly

<br>

## What we have Achieved

- We have added a WYSIWYG (What you see is what you get) editor, for better control over the styling of our message content.
- We have added a module that saves the message in Markdown, and then on the submissions index page will convert this back to html to display in the view
- We have added a 'helper' class to help facilitate this
- We have added some additional css to get the stylimg working for some of the elements in the WYSIWYG editor
- We have now unlocked some more options for our editor.
    - Added some differnt Font sizes to select from.
    - Added Font Colours (including a few default colours to select from)
  
  <p align="right">(<a href="#readme-top">back to top</a>)</p>

## Final Thoughts

- There is a lot more options that the CKEditor can handle, such as Font types, background colours, numbered and bulleted lists etc.
- This tutorial has given you a good start and provided some basic options for your editor - try adding some more options
  such as background colour, ordered lists or perhaps toggling with the menu visibility.
- What you finally choose to add or what version of the editor you use will depend on ypur use case.
- Visit https://ckeditor.com/ to research and learn more about the different editors and options available for your editor.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

## Contact

Michael Reed - xcal18r@gmail.com

Project GitHub Link: [my-laravel-app-WYSIWYG-editor-tutorial](https://github.com/mickyreed/my-laravel-app-WYSIWYG-editor-tutorial)

<p align="right">(<a href="#readme-top">back to top</a>)</p>

## Credits

### Thankyou for your support in creating this tutorial.

- [North Metro Tafe Perth W.A ](https://www.northmetrotafe.wa.edu.au/)
- [Adrian Gould](https://github.com/AdyGCode)

<p align="right">(<a href="#readme-top">back to top</a>)</p>

## References

### Websites, libraries and media used to create the application and tutorial.

- [Using Helper Functions to Convert Markdown to HTML in Laravel 11 - websilvercraft](https://dev.to/websilvercraft/using-helper-functions-to-convert-markdown-to-html-in-laravel-11-30a)
- [Laravel.com](https://laravel.com)
- [Tailwindcss.com](https://tailwindcss.com/)
- [League\HTMLToMarkdown and League/CommonMark](https://commonmark.thephpleague.com/)
- [CKEditor5](https://ckeditor.com/)

<p align="right">(<a href="#readme-top">back to top</a>)</p>

## License

### MIT License

**Copyright (c) [2025] [Michael Reed]**

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->

[licence-shield]: https://img.shields.io/github/license/adygcode/workopia-laravel-v11.svg?style=for-the-badge
[licence-url]: https://github.com/adygcode/workopia-laravel-v11/blob/main/License.md
[Laravel.shield]: https://img.shields.io/badge/Laravel-%23FF2D20.svg?logo=laravel&logoColor=white
[Laravel-url]: https://laravel.com
[Laragon.com]: https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white
[Laragon-url]: https://laragon.org/
[Tailwindcss.com]: https://img.shields.io/badge/Tailwindcss-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white
[Tailwindcss-url]: https://tailwindcss.com
[Livewire.com]: https://img.shields.io/badge/Livewire-4E56A6?style=for-the-badge&logo=livewire&logoColor=white
[Php.com]: https://img.shields.io/badge/Php-777BB4?style=for-the-badge&logo=php&logoColor=white
[Php-url]: https://inertiajs.com
[Jetbrains.com]: https://img.shields.io/badge/PHPStorm---
[PHPStorm-url]: https://www.jetbrains.com/phpstorm/
[HTML-url]: https://developer.mozilla.org/en-US/docs/Web/HTML
[HTML]: https://img.shields.io/badge/HTML-%23E34F26.svg?logo=html5&logoColor=white
[CSS-shield]: https://img.shields.io/badge/CSS-1572B6?logo=css3&logoColor=fff
[CSS-url]: https://developer.mozilla.org/en-US/docs/Web/CSS
[GitHub-shield]: https://img.shields.io/badge/github-%23121011.svg?style=for-the-badge&logo=github&logoColor=white
[GitHub-url]: https://github.com
[MySQL-shield]: https://img.shields.io/badge/mysql-4479A1.svg?style=for-the-badge&logo=mysql&logoColor=white
[MySQL-url]: https://www.mysql.com/

