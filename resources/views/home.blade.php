<!DOCTYPE html>
<html lang="en" x-data="{ darkMode: (localStorage.getItem('darkMode') === 'true') || (document.documentElement.classList.contains('dark')) }" :class="{ 'dark': darkMode }"
    @toggle-dark-mode.window="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//unpkg.com/alpinejs" defer></script>
    <title>Code Checker</title>
    @vite('resources/css/app.css')
</head>

<body class="flex items-center justify-center h-screen bg-gray-100 dark:bg-gray-900 transition-colors duration-500">

    <!-- Dark Mode Toggle Checkbox -->
    <div class="absolute top-4 right-4 flex items-center">
        <label for="dark-mode-toggle" class="mr-2 text-gray-900 dark:text-gray-300">Dark Mode</label>
        <input type="checkbox" id="dark-mode-toggle" x-model="darkMode"
            @change="localStorage.setItem('darkMode', darkMode)"
            class="toggle-checkbox appearance-none w-10 h-5 rounded-full bg-gray-200 checked:bg-blue-500 checked:before:translate-x-full before:content-[''] before:block before:w-5 before:h-5 before:rounded-full before:bg-white before:transition-transform duration-300 cursor-pointer">
    </div>

    <form class="w-1/2 mx-auto" action="{{ url('/check') }}" method="POST">
        @csrf
        <div x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 2000)">
            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100 dark:bg-green-800 dark:text-green-300"
                    role="alert">
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            @if (session('error'))
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100 dark:bg-red-800 dark:text-red-300"
                    role="alert">
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            @endif
        </div>

        <div
            class="p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg shadow transition-colors duration-500">
            <h1 class="text-indigo-600 dark:text-indigo-400 text-3xl font-bold">Code Checker</h1>
            <p class="mb-3 text-gray-500 dark:text-gray-400 mt-3 p-2">
                The Open and Close Bracket Checker Web App is a user-friendly tool designed to assist developers and
                programmers in verifying the correctness of code syntax, particularly focusing on the matching of
                opening and closing brackets.
            </p>

            <textarea id="code" rows="8" name="code"
                class="block p-2.5 w-full text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 rounded-lg border border-gray-300 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Enter your code here..." required></textarea>

            <button type="submit"
                class="mt-3 text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 mx-auto">
                Check
            </button>
        </div>
    </form>

    <style>
        /* Custom styles for the toggle switch */
        .toggle-checkbox:checked {
            background-color: #8442f5;
        }

        .toggle-checkbox:before {
            transform: translateX(0);
        }

        .toggle-checkbox:checked:before {
            transform: translateX(100%);
        }
    </style>
</body>

</html>
