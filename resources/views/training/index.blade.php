<!DOCTYPE html>
<html lang="en" data-theme="forest">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Lista de Entrenamientos</title>
</head>
<body class="min-h-screen bg-base-200">
    <div class="container mx-auto p-4">
        <div class="mb-6">
            <h1 class="text-2xl sm:text-3xl font-bold text-primary text-center sm:text-left mb-2">
                Lista de Entrenamientos
            </h1>
            <div class="flex justify-start">
                <form action="{{ route('training.create') }}" method="get">
                    <button type="submit" class="btn btn-success">Crear Entrenamiento</button>
                </form>
            </div>
        </div>
        <div class="overflow-x-auto rounded-lg shadow">
            <table class="table table-zebra w-full text-sm">
                <thead>
                    <tr>
                        <th>Caballo</th>
                        <th>Distancia</th>
                        <th>Duración</th>
                        <th>Fecha</th>
                        <th>Comentarios</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($training as $training)
                        <tr>
                            <td class="whitespace-nowrap">{{ $training->horse->name }}</td>
                            <td class="whitespace-nowrap">{{ $training->distance }} km</td>
                            <td class="whitespace-nowrap">{{ $training->duration_minutes }} minutos</td>
                            <td class="whitespace-nowrap">{{ $training->date }}</td>
                            <td class="max-w-xs break-words">{{ $training->comments }}</td>
                            <td class="flex flex-col sm:flex-row gap-2">
                                <form action="{{ route('training.edit', $training->id) }}" method="get">
                                    <button type="submit" class="btn btn-primary btn-xs w-full">Editar</button>
                                </form>
                                <form action="{{ route('training.destroy', $training->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-error btn-xs w-full">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>