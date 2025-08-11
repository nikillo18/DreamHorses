@vite('resources/css/app.css', 'resources/js/app.js')
<div class="drawer lg:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />

    <div class="drawer-content">
        <label for="my-drawer" class="btn btn-primary drawer-button lg:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </label>
        <div class="container mx-auto p-4">
            <h1 class="text-2xl sm:text-3xl font-bold text-primary text-center sm:text-left mb-6">
                Lista de Eventos
            </h1>
            <div class="flex justify-start mb-4">
                <form action="{{ route('calendar.create') }}" method="get">
                    <button type="submit" class="btn btn-success">Crear Evento</button>
                </form>
            </div>
            <div class="overflow-x-auto rounded-lg shadow">
                <table class="table table-zebra w-full text-sm">
                    <thead>
                        <tr>
                            <th>Titulo</th>
                            <th>Caballo</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Tipo de Evento</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                            <tr>
                                <td class="whitespace-nowrap">{{ $event->title }}</td>
                                <td class="whitespace-nowrap">{{ $event->horse->name }}</td>
                                <td class="whitespace-nowrap">{{ $event->event_date }}</td>
                                <td class="whitespace-nowrap">{{ $event->event_time }}</td>
                                <td class="whitespace-nowrap">{{ $event->category }}</td>
                                <td class="max-w-xs break-words">{{ $event->description }}</td>
                                <td class="flex flex-col sm:flex-row gap-2">
                                    <form action="{{ route('calendar.edit', $event) }}" method="get"
                                        style="display:inline;">
                                        <button type="submit" class="btn btn-primary btn-xs w-full">Editar</button>
                                    </form>
                                    <form action="{{ route('calendar.destroy', $event) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-error btn-xs w-full"
                                            onclick="return confirm('¿Estás seguro de que deseas eliminar este evento?');">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="drawer-side">
        <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
        <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4">
            <!-- Sidebar content here -->
            <li class="mb-2"><a href="{{ route('dashboard') }}" class="btn btn-primary ml-2">Panel</a>
            <li class="mb-2"><a href="{{ route('training.index') }}" class="btn btn-primary ml-2">Entrenamientos</a>
            </li>
            <li class="mb-2"> <a href="{{ route('race.index') }}" class="btn btn-secondary ml-2">Carreras</a></li>
            <li class="mb-2"><a href="{{ route('expenses.index') }}" class="btn btn-info ml-2">Gastos</a></li>
            <li class="mb-2"><a href="{{ route('vet-visits.index') }}" class="btn btn-warning ml-2">Veterinario</a>
            </li>
            <li class="mb-2"><a href="{{ route('Horseindex') }}" class="btn btn-secondary ml-2">Caballos</a></li>


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
