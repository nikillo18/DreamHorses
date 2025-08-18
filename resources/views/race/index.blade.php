@vite('resources/css/app.css')
<div class="drawer">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
    <label for="my-drawer" class="btn btn-primary drawer-button">Panel</label>
    <div class="drawer-content">
        <!DOCTYPE html>
        <html lang="en" data-theme="forest">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Lista de carreras</title>
            @vite('resources/css/app.css')
        </head>

        <body class="min-h-screen bg-base-200">
            <div class="container mx-auto p-4">
                <div class="mb-6">
                    <h1 class="text-2xl sm:text-3xl font-bold text-primary text-center sm:text-left mb-2">
                        Lista de Carreras
                    </h1>
                    <div class="flex justify-start">
                        <form action="{{ route('race.create') }}" method="get">
                            <button type="submit" class="btn btn-success">Crear Carrera</button>
                        </form>
                    </div>
                </div>
                <div class="overflow-x-auto rounded-lg shadow">
                    <table class="table table-zebra w-full text-sm">
                        <thead>
                            <tr>
                                <th>Fecha de Carrera</th>
                                <th>Caballo</th>
                                <th>Posicion</th>
                                <th>Distancia</th>
                                <th>Descripcion de la Carrera</th>
                                <th>Jockey</th>
                                @can('caretaker')
                                <th>Acciones</th>
                                @endcan
                            </tr>

                        </thead>
                        <tbody>
                            @foreach ($race as $race)
                                <tr>
                                    <td class="whitespace-nowrap">{{ $race->date }}</td>
                                    <td class="whitespace-nowrap">{{ $race->horse->name }}</td>
                                    <td class="whitespace-nowrap">{{ $race->place }}</td>
                                    <td class="whitespace-nowrap">{{ $race->distance }} km</td>
                                    <td class="max-w-xs break-words">{{ $race->description }}</td>
                                    <td class="whitespace-nowrap">{{ $race->jockey }}</td>
                                    <td class="flex flex-col sm:flex-row gap-2">
                                        @can('caretaker')
                                        <form action="{{ route('race.edit', $race->id) }}" method="get">
                                            <button type="submit" class="btn btn-primary btn-xs w-full">Editar</button>
                                        </form>
                                        <form action="{{ route('race.destroy', $race->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-error btn-xs w-full">Eliminar</button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </body>

        </html>
    </div>
    <div class="drawer-side">
        <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
        <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4">
            <!-- Sidebar content here -->
            <li><a href="{{ route('dashboard') }}" class="btn btn-secondary ml-2">Panel</a></li>
            <li><a href="{{ route('training.index') }}" class="btn btn-secondary ml-2">Entrenamientos</a></li>
            <li> <a href="{{ route('race.index') }}" class="btn btn-secondary ml-2">Carreras</a></li>
        </ul>
    </div>
</div>
