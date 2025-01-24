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
