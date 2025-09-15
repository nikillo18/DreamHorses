@vite('resources/css/app.css', 'resources/js/app.js')

<div class="drawer lg:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content bg-base-100 text-base-content">
        <!-- Botón hamburguesa -->
        <label for="my-drawer" class="btn btn-primary drawer-button lg:hidden m-4 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </label>

        <!-- Contenido principal -->
        <div class="p-6 md:p-8">
            <div class="mb-6">
                <h1 class="text-2xl sm:text-3xl font-bold text-base-content text-center sm:text-left mb-2">
                    Lista de Entrenamientos
                </h1>
                @role('caretaker')
                    <div class="flex justify-start">
                        <a href="{{ route('training.create') }}" class="btn btn-success font-bold shadow-sm">Crear
                            Entrenamiento</a>
                    </div>
                @endrole
                 <div class="p-6 md:p-2">
                 @if($horseId)
        <a href="{{ route('horses.show', $horseId) }}" 
           class="btn btn-sm btn-secondary mb-4">⬅ Volver al caballo</a>
    @endif
    </div>
            </div>
            <div class="overflow-x-auto rounded-lg shadow-lg">
                <table class="table-auto w-full text-sm text-left bg-base-200 text-base-content">
                    <thead class="bg-base-300 text-base-content">
                        <tr>
                            <th class="p-4">Caballo</th>
                            <th class="p-4">Distancia</th>
                            <th class="p-4">Duración</th>
                            <th class="p-4">Fecha</th>
                            <th class="p-4">Entrenamiento</th>
                            <th class="p-4">Comentarios</th>
                            @role('caretaker')
                                <th class="p-4">Acciones</th>
                            @endrole
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($training as $training)
                            <tr class="border-b border-base-300 hover:bg-base-300">
                                <td class="p-4 whitespace-nowrap">{{ $training->horse->name }}</td>
                                <td class="p-4 whitespace-nowrap">{{ $training->distance }} km</td>
                                <td class="p-4 whitespace-nowrap">{{ $training->duration_minutes }} minutos</td>
                                <td class="p-4 whitespace-nowrap">{{ $training->date }}</td>
                                <td class="p-4 whitespace-nowrap">{{ $training->type_training }}</td>
                                <td class="p-4 max-w-xs break-words">{{ $training->comments }}</td>
                                <td class="p-4 flex flex-col md:flex-row gap-2">
                                    @role('caretaker')
                                        <a href="{{ route('training.edit', $training->id) }}"
                                            class="btn btn-xs btn-warning">Editar</a>
                                        <form action="{{ route('training.destroy', $training->id) }}" method="POST"
                                            class="w-full">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-xs btn-error">Eliminar</button>
                                        </form>

                                    </td>
                                </tr>
                            @endrole
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Menú lateral -->
 <div class="drawer-side">
        <label for="my-drawer" class="drawer-overlay"></label>
        <ul class="menu bg-base-200 min-h-screen w-64 p-4 flex flex-col gap-4 text-base-content">
            <div>
                <li class="mb-2"><a href="{{ route('dashboard') }}" class="btn btn-primary w-full text-left">Panel
                        principal</a>
                </li>
                <h3 class="text-base-content/70 text-sm font-semibold">Control</h3>
                <li class="mb-2"><a href="{{ route('training.index') }}" class="btn btn-primary w-full text-left">
                        Entrenamientos</a></li>
                <li class="mb-2"><a href="{{ route('Horseindex') }}" class="btn btn-primary w-full text-left">
                        Caballos</a></li>
                <li class="mb-2"><a href="{{ route('calendar.index') }}" class="btn btn-primary w-full text-left">
                        Eventos</a></li>
                @role('boss')
                    <li><a href="{{ route('caretakers.index') }}" class="btn btn-primary w-full text-left">
                            Cuidadores</a></li>
                @endrole
            </div>
            <div class="divider"></div>
            <div>
                <h3 class="text-base-content/70 text-sm font-semibold">Gestion</h3>
                <li class="mb-2"><a href="{{ route('race.index') }}" class="btn btn-secondary w-full text-left">
                        Carreras</a></li>
                <li class="mb-2"><a href="{{ route('expenses.index') }}" class="btn btn-secondary w-full text-left">
                        Gastos</a></li>
                <li class="mb-2"><a href="{{ route('expenses.chart') }}"
                        class="btn btn-secondary w-full text-left">
                        Gráfico de Gastos</a></li>
                <li class="mb-2"><a href="{{ route('vet-visits.index') }}"
                        class="btn btn-secondary w-full text-left">
                        Veterinario</a></li>
                <li class="mb-2"><a href="{{ route('blacksmiths.index') }}"
                        class="btn btn-primary w-full text-left">
                        Herradura</a></li>
            </div>


            <div class="mt-auto space-y-2">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-error w-full">
                        Cerrar
                        sesión</button>
                </form>
                <form method="GET" action="{{ route('profile.edit') }}">
                    <button type="submit" class="btn btn-info w-full">
                        Ver
                        perfil</button>
                </form>
            </div>
        </ul>
    </div>
</div>

