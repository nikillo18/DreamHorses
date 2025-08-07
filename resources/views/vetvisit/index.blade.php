@vite('resources/css/app.css', 'resources/js/app.js')
<div class="drawer lg:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />

    <div class="drawer-content">
        <div class="p-6 max-w-7xl mx-auto" data-theme="forest">
            <h2 class="text-2xl sm:text-3xl font-bold text-primary mb-6">
                🩺 Visitas Veterinarias
            </h2>

            @if (session('success'))
                <div class="alert alert-success mb-4">{{ session('success') }}</div>
            @endif

            <div class="mb-4">
                <a href="{{ route('vet-visits.create') }}" class="btn btn-primary">
                    ➕ Nueva Visita
                </a>
            </div>

            <div class="overflow-x-auto shadow rounded-lg">
                <table class="table table-zebra w-full text-sm">
                    <thead>
                        <tr>
                            <th>Caballo</th>
                            <th>Veterinario</th>
                            <th>Teléfono</th>
                            <th>Fecha</th>
                            <th>Diagnóstico</th>
                            <th>Tratamiento</th>
                            <th>Próxima Visita</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($visits as $visit)
                            <tr>
                                <td>{{ $visit->horse->name }}</td>
                                <td>{{ $visit->vet_name }}</td>
                                <td>{{ $visit->vet_phone ?? '-' }}</td>
                                <td>{{ $visit->visit_date }}</td>
                                <td class="max-w-xs break-words">{{ $visit->diagnosis }}</td>
                                <td class="max-w-xs break-words">{{ $visit->treatment }}</td>
                                <td>{{ $visit->next_visit ?? '-' }}</td>
                                <td class="flex flex-col sm:flex-row gap-2">
                                    <a href="{{ route('vet-visits.edit', $visit->id) }}" class="btn btn-warning btn-xs">
                                        Editar</a>
                                    <form action="{{ route('vet-visits.destroy', $visit->id) }}" method="POST"
                                        onsubmit="return confirm('¿Eliminar esta visita?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-error btn-xs"> Eliminar</button>
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
            <li class="mb-2"><a href="{{ route('Horseindex') }}" class="btn btn-secondary ml-2">Caballos</a></li>
            <li class="mb-4"><a href="{{ route('calendar.index') }}" class="btn btn-secondary ml-2">Calendario</a>
            </li>

        </ul>
        <div class="flex justify-center items-center mt-4 space-x-2">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-error w-32">Cerrar sesión</button>
            </form>
            <form method="GET" action="{{ route('profile.edit') }}">
                @csrf
                <button type="submit" class="btn btn-secondary w-32">Ver perfil</button>
            </form>
        </div>
    </div>
</div>
