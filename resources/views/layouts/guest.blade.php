<!DOCTYPE html>
<html lang="es" data-theme="forest">

<head>
    <meta charset="UTF-8" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-base-200 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md mx-auto">
        <div class="text-center mb-8">
            <a href="/">
                <img src="{{ asset('logo/logo1.png') }}" alt="DreamHorse Logo" class="w-48 mx-auto" />
            </a>
        </div>

        <div class="bg-base-100 rounded-2xl shadow-xl p-8">
            {{ $slot }}
        </div>
    </div>

</body>

</html>
