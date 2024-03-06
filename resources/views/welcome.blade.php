<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('ui/frontend/images/favicon.png') }}" rel="icon">

    <title>Project Allocation & Management System</title>
    <link rel="stylesheet" href="{{ asset('ui/frontend/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('ui/frontend/css/tailwind.output.css') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />


</head>

<body class="antialiased">

    <div class="flex flex-col items-center justify-center min-h-screen bg-center bg-indigo-200 space-y-6">
        <p class="text-3xl font-semibold text-center">
            Welcome to Project Allocation &amp; Management System (PAMS)
        </p>
        <span class="text-xl font-semibold text-center font-mono">Login As: </span>
        <div class="flex flex-col space-y-4 sm:flex-row sm:space-y-0 sm:space-x-6">
            <a href="{{ route('student.login') }}"
                class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded  shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                Student
            </a>

            <a href="{{ route('supervisor.login') }}"
                class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                Supervisor
            </a>
            <a href="{{ route('coordinator.login') }}"
                class="inline-block bg-sky-600 hover:bg-sky-700 text-white font-semibold py-2 px-6 rounded shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                Coordinator
            </a>
        </div>
        <div class="flex sm:flex-row mt-4">
            <div class="flex items-center space-x-1">
                <div class="bg-emerald-700 text-white px-4 py-2 rounded">Login as Guest</div>
                <form id="guestForm" method="POST" action="">
                    @csrf
                    <select name="guest" class="border border-gray-300 p-2 rounded" onchange="submitForm(this)">
                        <option value="choose" class="text-gray-800">Choose</option>
                        <option value="{{ route('guest.student') }}" class="text-gray-800">Student</option>
                        <option value="{{ route('guest.supervisor') }}" class="text-gray-800">Supervisor</option>
                        <option value="{{ route('guest.coordinator') }}" class="text-gray-800">Coordinator</option>
                    </select>
                </form>
            </div>




        </div>
    </div>

    <script>
        function submitForm(selectElement) {
            const selectedValue = selectElement.value;
            
            document.getElementById('guestForm').action = selectedValue;
            document.getElementById('guestForm').submit();
        }
    </script>
</body>

</html>
