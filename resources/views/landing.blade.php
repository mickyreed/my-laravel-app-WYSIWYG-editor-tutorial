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
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
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
    <a
        href="{{ route('form.index') }}"
        class="mt-6 inline-block bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded"
    >
        View Submissions
    </a>
</div>
</body>
</html>
