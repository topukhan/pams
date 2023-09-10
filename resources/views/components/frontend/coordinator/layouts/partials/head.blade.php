<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PAMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

    @vite('resources/css/app.css')

    <link rel="stylesheet" href="{{ asset('ui/frontend/css/tailwind.output.css') }}" />
    <link rel="stylesheet" href="{{ asset('ui/frontend/css/app.css') }}" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="{{ asset('ui/frontend/js/init-alpine.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
    {{-- <script src="{{ asset('ui/frontend/js/charts-lines.js') }}" defer></script>
    <script src="{{ asset('ui/frontend/js/charts-pie.js') }}" defer></script>
    <script src="{{ asset('ui/frontend/js/app.js') }}" defer></script> --}}
</head>
