@vite('resources/css/app.css', 'resources/js/app.js')
<div class="drawer lg:drawer-open" data-theme="forest">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />

    <div class="drawer-content">
        <label for="my-drawer" class="btn btn-primary drawer-button lg:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </label>
        <!-- Page content here -->
        <!DOCTYPE html>
        <html lang="en" data-theme="forest">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Lista de carreras</title>
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
                                <th>Jokey</th>
                                <th>Acciones</th>
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
                                        <form action="{{ route('race.edit', $race->id) }}" method="get">
                                            <button type="submit" class="btn btn-primary btn-xs w-full">Editar</button>
                                        </form>
                                        <form action="{{ route('race.destroy', $race->id) }}" method="POST">
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
    </div>
    <div class="drawer-side">
        <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
        <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4">
            <!-- Sidebar content here -->
            <li class="mb-2"><a href="{{ route('dashboard') }}" class="btn btn-primary ml-2">Panel</a>
            <li class="mb-2"><a href="{{ route('training.index') }}" class="btn btn-primary ml-2">Entrenamientos</a>
            </li>

            <li class="mb-2"><a href="{{ route('expenses.index') }}" class="btn btn-info ml-2">Gastos</a></li>
            <li class="mb-2"><a href="{{ route('vet-visits.index') }}" class="btn btn-warning ml-2">Veterinario</a>
            </li>
            <li class="mb-2"><a href="{{ route('Horseindex') }}" class="btn btn-secondary ml-2">Caballos</a></li>
            <li class="mb-4"><a href="{{ route('calendar.index') }}" class="btn btn-secondary ml-2">Calendario</a>
            </li>

            <div class="flex flex-col justify-center items-center mt-4 space-y-2 w-full">
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="btn btn-error w-full">Cerrar sesión</button>
                </form>
                <form method="GET" action="{{ route('profile.edit') }}" class="w-full">
                    @csrf
                    <button type="submit" class="btn btn-secondary w-full">Ver perfil</button>
                </form>
            </div>
        </ul>

    </div>
</div>
