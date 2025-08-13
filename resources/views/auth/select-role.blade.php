<!DOCTYPE html>
<html lang="es" data-theme="forest">
<head>
    <meta charset="UTF-8">
    <title>Seleccionar Rol</title>
    @vite('resources/css/app.css')
</head>
<body class="flex items-center justify-center min-h-screen bg-base-200">
    <div class="card w-96 bg-base-100 shadow-xl p-6">
        <h2 class="text-2xl font-bold mb-6 text-center">Selecciona tu rol</h2>

        <div class="flex flex-col gap-4">
            <a href="{{ route('register', ['role' => 'boss']) }}" class="btn btn-primary">Jefe</a>
            <a href="{{ route('register', ['role' => 'caretakers']) }}" class="btn btn-secondary">Cuidador</a>
            <a href="{{ route('register', ['role' => 'veterinarian']) }}" class="btn btn-accent">Veterinario</a>
        </div>
    </div>
</body>
</html>
