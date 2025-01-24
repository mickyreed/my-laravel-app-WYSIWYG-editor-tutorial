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
