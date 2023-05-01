<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link rel="stylesheet" href="{{ asset('ui/frontend/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('ui/frontend/css/tailwind.output.css') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />


</head>

<body class="antialiased">
    {{--  --}}
    
      

    <div class="relative flex sm:justify-center flex-col sm:items-center min-h-screen  bg-center bg-indigo-200 space-y-12 ">
        <div class="flex justify-center items-center ">
            <p class="text-3xl font-semibold">
                Project Allocation & Management System (PAMS)
            </p>
        </div>

        <div class="flex justify-center items-center  space-x-6">
            <a href="{{ route('student.login') }}"
                class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 rounded shadow-lg  focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 px-10">
                Student Login
            </a>

            <a href="{{ route('supervisor.login') }}"
                class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2  rounded shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 px-10">Faculty Login</a>
            {{-- @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif --}}
        </div>

    </div>
</body>

</html>
