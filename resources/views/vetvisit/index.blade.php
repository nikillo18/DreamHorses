@vite('resources/css/app.css', 'resources/js/app.js')

<div class="drawer lg:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content bg-gray-50 text-gray-800 dark:bg-gray-900 dark:text-gray-100">
        <!-- Botón hamburguesa -->
        <label for="my-drawer"
            class="btn bg-pink-300 hover:bg-pink-400 text-gray-900 dark:bg-pink-400 dark:hover:bg-pink-500 dark:text-gray-900 drawer-button lg:hidden m-4 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </label>

        <!-- Contenido principal -->
        <div class="p-6 md:p-8 max-w-7xl mx-auto">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-gray-100 mb-6">
                🩺 Visitas Veterinarias
            </h2>

            @if (session('success'))
                <div class="bg-green-200 text-green-800 dark:bg-green-700 dark:text-green-100 p-4 rounded-md mb-4">{{ session('success') }}</div>
            @endif

            <div class="mb-4">
                <a href="{{ route('vet-visits.create') }}"
                    class="btn bg-green-300 hover:bg-green-400 dark:bg-green-600 dark:hover:bg-green-500 text-gray-900 font-bold shadow-sm">
                    ➕ Nueva Visita
                </a>
            </div>

            <div class="overflow-x-auto shadow-lg rounded-lg">
                <table class="table-auto w-full text-sm text-left bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100">
                    <thead class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-100">
                        <tr>
                            <th class="p-4">Caballo</th>
                            <th class="p-4">Veterinario</th>
                            <th class="p-4">Teléfono</th>
                            <th class="p-4">Fecha</th>
                            <th class="p-4">Diagnóstico</th>
                            <th class="p-4">Tratamiento</th>
                            <th class="p-4">Próxima Visita</th>
                            <th class="p-4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($visits as $visit)
                            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td class="p-4">{{ $visit->horse->name }}</td>
                                <td class="p-4">{{ $visit->vet_name }}</td>
                                <td class="p-4">{{ $visit->vet_phone ?? '-' }}</td>
                                <td class="p-4">{{ $visit->visit_date }}</td>
                                <td class="p-4 max-w-xs break-words">{{ $visit->diagnosis }}</td>
                                <td class="p-4 max-w-xs break-words">{{ $visit->treatment }}</td>
                                <td class="p-4">{{ $visit->next_visit ?? '-' }}</td>
                                <td class="p-4 flex flex-col sm:flex-row gap-2">
                                    <a href="{{ route('vet-visits.edit', $visit->id) }}"
                                        class="btn btn-xs bg-yellow-300 hover:bg-yellow-400 dark:bg-yellow-500 dark:hover:bg-yellow-400 text-gray-900">Editar</a>
                                    <form action="{{ route('vet-visits.destroy', $visit->id) }}" method="POST"
                                        onsubmit="return confirm('¿Eliminar esta visita?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs bg-red-300 hover:bg-red-400 dark:bg-red-600 dark:hover:bg-red-500 text-gray-900">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Menú lateral -->
    <div class="drawer-side">
        <label for="my-drawer" class="drawer-overlay"></label>
        <ul class="menu bg-pink-100 dark:bg-gray-950 min-h-screen w-64 p-4 flex flex-col gap-4 text-gray-800 dark:text-gray-100">
            <div>
                <li class="mb-2"><a href="{{ route('dashboard') }}" class="btn w-full text-left bg-indigo-200 hover:bg-indigo-300 dark:bg-indigo-500 dark:hover:bg-indigo-400 text-gray-900 px-4 py-2 rounded-md font-semibold shadow-sm">Panel
                        principal</a>
                </li>
                <h3 class="text-gray-700 dark:text-gray-300 text-sm font-semibold">Control</h3>
                <li class="mb-2"><a href="{{ route('training.index') }}"
                        class="btn w-full text-left bg-indigo-200 hover:bg-indigo-300 dark:bg-indigo-500 dark:hover:bg-indigo-400 text-gray-900 px-4 py-2 rounded-md font-semibold shadow-sm">
                        Entrenamientos</a></li>
                <li class="mb-2"><a href="{{ route('Horseindex') }}"
                        class="btn w-full text-left bg-indigo-200 hover:bg-indigo-300 dark:bg-indigo-500 dark:hover:bg-indigo-400 text-gray-900 px-4 py-2 rounded-md font-semibold shadow-sm">
                        Caballos</a></li>
                <li><a href="{{ route('calendar.index') }}"
                        class="btn w-full text-left bg-indigo-200 hover:bg-indigo-300 dark:bg-indigo-500 dark:hover:bg-indigo-400 text-gray-900 px-4 py-2 rounded-md font-semibold shadow-sm">
                        Calendario</a></li>
            </div>
            <hr class="border-gray-300 dark:border-gray-700" />
            <div>
                <h3 class="text-gray-700 dark:text-gray-300 text-sm font-semibold">Gestion</h3>
                <li class="mb-2"><a href="{{ route('race.index') }}"
                        class="btn w-full text-left bg-sky-200 hover:bg-sky-300 dark:bg-sky-500 dark:hover:bg-sky-400 text-gray-900 px-4 py-2 rounded-md font-semibold shadow-sm">
                        Carreras</a></li>
                <li class="mb-2"><a href="{{ route('expenses.index') }}"
                        class="btn w-full text-left  bg-sky-200 hover:bg-sky-300 dark:bg-sky-500 dark:hover:bg-sky-400 text-gray-900 px-4 py-2 rounded-md font-semibold shadow-sm">
                        Gastos</a></li>
                <li class="mb-2"><a href="{{ route('vet-visits.index') }}"
                        class="btn w-full text-left  bg-sky-200 hover:bg-sky-300 dark:bg-sky-500 dark:hover:bg-sky-400 text-gray-900 px-4 py-2 rounded-md font-semibold shadow-sm">
                        Veterinario</a></li>
            </div>


            <div class="mt-auto space-y-2">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="btn w-full bg-rose-300 hover:bg-rose-400 dark:bg-rose-600 dark:hover:bg-rose-500 px-4 py-2 rounded-md font-bold shadow"> Cerrar
                        sesión</button>
                </form>
                <form method="GET" action="{{ route('profile.edit') }}">
                    <button type="submit"
                        class="btn w-full bg-teal-200 hover:bg-teal-300 dark:bg-teal-500 dark:hover:bg-teal-400 text-gray-900 px-4 py-2 rounded-md font-semibold shadow"> Ver
                        perfil</button>
                </form>
            </div>
        </ul>
    </div>
</div>