<!DOCTYPE html>
<html lang="es" data-theme="light">

<head>
    <meta charset="UTF-8" />
    <title>DreamHorse - Bienvenido</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')
</head>

<body class="bg-base-100 min-h-screen flex flex-col transition-colors duration-300">

    <!-- Hero -->
    <section class="flex flex-1 items-center justify-center relative overflow-hidden px-6">

        <!-- Marca de agua con logo -->
        <div class="absolute inset-0 flex items-center justify-center opacity-10 dark:opacity-20">
            <img src="{{ asset('logo/logo1.png') }}" alt="DreamHorse Logo" class="max-w-md w-full object-contain" />
        </div>

        <!-- Contenido -->
        <div class="relative z-10 text-center max-w-2xl">
            <h1 class="text-4xl md:text-6xl font-extrabold mb-4 text-base-content">
                Bienvenido a <span class="text-primary">DreamHorse</span>
            </h1>
            <p class="text-lg md:text-xl text-base-content/70 mb-8">
                Tu portal para gestionar y administar caballos.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('login') }}"
                    class="btn btn-primary btn-lg w-full sm:w-auto rounded-full shadow-md hover:scale-105 transition">
                    Iniciar Sesión
                </a>
                <a href="{{ route('select-role') }}"
                    class="btn btn-outline btn-lg w-full sm:w-auto rounded-full shadow-md hover:scale-105 transition">
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
