<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <title>Code Checker</title>
</head>

<body class="flex items-center justify-center h-screen">


    <form class="w-1/2 mx-auto" action="{{ url('/check') }}" method="POST">
        @csrf
        <div x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 2000)">
            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100  dark:text-green-400"
                    role="alert">
                    <span class="font-medium">{{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-100 dark:text-red-400" role="alert">
                    <span class="font-medium">{{ session('error') }}
                </div>
            @endif
        </div>


        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow">
            <h1 class="text-indigo-600 text-3xl font-bold">Code Checker</h1>
            <p class="mb-3 text-gray-500 dark:text-gray-400 mt-3 p-2">
                The Open and Close Bracket Checker Web App is a user-friendly tool designed to assist developers and programmers in verifying the correctness of code syntax, particularly focusing on the matching of opening and closing brackets.
            </p>


            <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                message</label>
            <textarea id="code" rows="8" name="code"
                class="block p-2.5 w-full text-sm text-gray-900 bg-wheat-300 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Enter you code here..." required></textarea>
            <button type="submit"
                class="mt-3 text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 mx-auto">Check</button>
        </div>
    </form>



</html>
