<!DOCTYPE html>
<html lang="es" data-theme="forest">
<head>
    <meta charset="UTF-8">
    <title>DreamHorse - Bienvenido</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>
<body class="bg-base-200 min-h-screen flex flex-col">

  <div
    class="hero flex-1"
    style="background-image: url('{{ asset('logo/logo1.png') }}');"
  >
    <div class="hero-overlay bg-opacity-60"></div>
    <div class="hero-content text-neutral-content text-center">
      <div class="max-w-md">
        <h1 class="mb-5 text-5xl font-bold">Bienvenido a DreamHorse</h1>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
            <a href="{{ route('login') }}" class="btn btn-primary w-full sm:w-auto">
                Iniciar Sesión
            </a>
            <a href="{{ route('select-role') }}" class="btn btn-secondary w-full sm:w-auto">
                Registrarse
            </a>
        </div>
      </div>
    </div>
  </div>



</body>
</html>
