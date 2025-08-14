@vite('resources/css/app.css', 'resources/js/app.js')

<div class="drawer lg:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content bg-gray-950 text-white">
        <!-- Botón hamburguesa -->
        <label for="my-drawer" class="btn btn-primary drawer-button lg:hidden m-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </label>

        <!-- Contenido principal -->
        <div class="p-6 md:p-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-white text-center sm:text-left mb-6">
                📅 Lista de Eventos
            </h1>
            <div class="flex justify-start mb-4">
                <form action="{{ route('calendar.create') }}" method="get">
                    <button type="submit" class="btn bg-green-500 hover:bg-green-600 text-white font-bold">Crear
                        Evento</button>
                </form>
            </div>
            <div class="overflow-x-auto rounded-lg shadow-lg">
                <table class="table-auto w-full text-sm text-left bg-gray-900 text-gray-300">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="p-4">Titulo</th>
                            <th class="p-4">Caballo</th>
                            <th class="p-4">Fecha</th>
                            <th class="p-4">Hora</th>
                            <th class="p-4">Tipo de Evento</th>
                            <th class="p-4">Descripción</th>
                            <th class="p-4">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                            <tr class="border-b border-gray-700 hover:bg-gray-800">
                                <td class="p-4 whitespace-nowrap">{{ $event->title }}</td>
                                <td class="p-4 whitespace-nowrap">{{ $event->horse->name }}</td>
                                <td class="p-4 whitespace-nowrap">{{ $event->event_date }}</td>
                                <td class="p-4 whitespace-nowrap">{{ $event->event_time }}</td>
                                <td class="p-4 whitespace-nowrap">{{ $event->category }}</td>
                                <td class="p-4 max-w-xs break-words">{{ $event->description }}</td>
                                <td class="p-4 flex flex-col md:flex-row gap-2">
                                    <a href="{{ route('calendar.edit', $event) }}"
                                        class="btn btn-warning btn-xs w-full">Editar</a>
                                    <form action="{{ route('calendar.destroy', $event) }}" method="POST" class="w-full"
                                        onsubmit="return confirm('¿Estás seguro de que deseas eliminar este evento?');">
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
    </div>

    <!-- Menú lateral -->
    <div class="drawer-side">
        <label for="my-drawer" class="drawer-overlay"></label>
        <ul class="menu bg-gray-950 min-h-screen w-64 p-4 flex flex-col gap-4 text-white">
            <div>
                <li class="mb-2"><a href="{{ route('dashboard') }}" class="btn btn-primary w-full">Panel principal</a>
                </li>
                <h3 class="text-white text-sm font-semibold">Control</h3>
                <li class="mb-2"><a href="{{ route('training.index') }}"
                        class="btn w-full text-left bg-gray-800 hover:bg-gray-700 px-4 py-2 rounded-md font-semibold">
                        Entrenamientos</a></li>
                <li class="mb-2"><a href="{{ route('Horseindex') }}"
                        class="btn w-full text-left bg-gray-800 hover:bg-gray-700 px-4 py-2 rounded-md font-semibold">
                        Caballos</a></li>
                <li><a href="{{ route('calendar.index') }}"
                        class="btn w-full text-left bg-gray-800 hover:bg-gray-700 px-4 py-2 rounded-md font-semibold">
                        Calendario</a></li>
            </div>
            <hr class="border-gray-700" />
            <div>
                <h3 class="text-white text-sm font-semibold">Gestion</h3>
                <li class="mb-2"><a href="{{ route('race.index') }}"
                        class="btn w-full text-left bg-blue-400 hover:bg-red-200 text-black px-4 py-2 rounded-md font-semibold">
                        Carreras</a></li>
                <li class="mb-2"><a href="{{ route('expenses.index') }}"
                        class="btn w-full text-left  bg-blue-400 hover:bg-red-200 text-black px-4 py-2 rounded-md font-semibold">
                        Gastos</a></li>
                <li class="mb-2"><a href="{{ route('vet-visits.index') }}"
                        class="btn w-full text-left  bg-blue-400 hover:bg-red-200 text-black px-4 py-2 rounded-md font-semibold">
                        Veterinario</a></li>
            </div>


            <div class="mt-auto space-y-2">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="btn w-full bg-rose-600 hover:bg-rose-500 px-4 py-2 rounded-md font-bold"> Cerrar
                        sesión</button>
                </form>
                <form method="GET" action="{{ route('profile.edit') }}">
                    <button type="submit"
                        class="btn w-full bg-sky-700 hover:bg-sky-600 px-4 py-2 rounded-md font-semibold"> Ver
                        perfil</button>
                </form>
            </div>
        </ul>
    </div>
</div>
