<!DOCTYPE html>
<html lang="es" data-theme="forest">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>DreamHorse - Bienvenido</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-base-200 min-h-screen flex flex-col">

    <!-- Hero -->
    <section class="flex-1 flex items-center justify-center text-center p-6">
        <div class="max-w-2xl mx-auto">
            <img src="{{ asset('logo/logo1.png') }}" alt="DreamHorse Logo" class="w-64 mx-auto mb-8" />

            <h1 class="text-5xl font-bold mb-4">
                Bienvenido a <span class="text-primary">DreamHorse</span>
            </h1>

            <p class="text-lg text-base-content/80 mb-8">
                Tu portal para gestionar y administrar caballos.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('login') }}"
                    class="btn btn-primary btn-lg rounded-full shadow-lg hover:shadow-xl transition-shadow duration-300">
                    Iniciar Sesión
                </a>
                <a href="{{ route('select-role') }}"
                    class="btn btn-outline btn-lg rounded-full shadow-lg hover:shadow-xl transition-shadow duration-300">
                    Registrarse
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="p-4 text-center text-sm text-base-content/70">
        © {{ date('Y') }} DreamHorse · Todos los derechos reservados
    </footer>

</body>

</html>
