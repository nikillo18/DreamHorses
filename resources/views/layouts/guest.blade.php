<!DOCTYPE html>
<html lang="es" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-base-100 min-h-screen flex flex-col transition-colors duration-300">

    <!-- Hero -->
    <section class="flex flex-1 items-center justify-center relative overflow-hidden px-6">

        <!-- Marca de agua con logo -->
        <div class="absolute inset-0 flex items-center justify-center opacity-10 dark:opacity-20">
            <a href="/">
                <img src="{{ asset('logo/logo1.png') }}" alt="DreamHorse Logo" class="max-w-md w-full object-contain" />
            </a>
        </div>

        <!-- Contenido -->
        <div class="relative z-10 w-full sm:max-w-md mt-6 px-6 py-4">
            {{ $slot }}
        </div>
    </section>

</body>

</html>