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
        <div class="p-6 md:p-8">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-gray-100 mb-6 flex items-center gap-2">🐎 Listado de Caballos
            </h2>

            @if (session('success'))
                <div class="bg-green-200 text-green-800 dark:bg-green-700 dark:text-green-100 p-4 rounded-md mb-4">
                    {{ session('success') }}
                </div>
            @endif
            @role('caretaker|boss')
            <div class="mb-4">
                <a href="{{ route('CreateHorse') }}"
                    class="btn bg-green-300 hover:bg-green-400 dark:bg-green-600 dark:hover:bg-green-500 text-gray-900 font-bold shadow-sm">Crear caballo</a>
            </div>
            @endrole
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($horses as $horse)
                    <div class="bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 rounded-2xl shadow-xl p-6 w-full max-w-sm flex flex-col gap-4 border border-gray-200 dark:border-gray-700">
                        <figure>
                            <img src="{{ $horse->photos->first() ? asset('storage/' . $horse->photos->first()->path) : ($horse->photo_path ? asset('storage/' . $horse->photo_path) : 'https://images.unsplash.com/photo-1615989275591-9fdbfe661ec1?q=80&w=1332&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D') }}"
                                class="w-full h-48 object-cover rounded-md" />
                        </figure>
                        <div class="space-y-1">
                            <h2 class="text-xl font-semibold text-indigo-600 dark:text-indigo-300">{{ $horse->name }}</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Cuidador: <span
                                    class="text-gray-800 dark:text-gray-100">{{ $horse->caretaker->name ?? 'Sin cuidador' }}</span></p>
                        </div>
                        <div class="card-actions justify-end mt-4">
                            <a href="{{ route('horses.show', $horse->id) }}"
                                class="btn btn-sm bg-indigo-200 hover:bg-indigo-300 dark:bg-indigo-500 dark:hover:bg-indigo-400 text-gray-900">
                                Ver información
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Menú lateral -->
    <div class="drawer-side">
        <label for="my-drawer" class="drawer-overlay"></label>
        <ul class="menu bg-pink-100 dark:bg-gray-950 min-h-screen w-64 p-4 flex flex-col gap-4 text-gray-800 dark:text-gray-100">
            <div>
                <li class="mb-2"><a href="{{ route('dashboard') }}" class="btn w-full text-left bg-indigo-200 hover:bg-indigo-300 dark:bg-indigo-500 dark:hover:bg-indigo-400 text-gray-900 px-4 py-2 rounded-md font-semibold shadow-sm">Panel principal</a>
                </li>
                <h3 class="text-gray-700 dark:text-gray-300 text-sm font-semibold">Control</h3>
                <li class="mb-2"><a href="{{ route('training.index') }}"
                        class="btn w-full text-left bg-indigo-200 hover:bg-indigo-300 dark:bg-indigo-500 dark:hover:bg-indigo-400 text-gray-900 px-4 py-2 rounded-md font-semibold shadow-sm">
                        Entrenamientos</a></li>
                <li class="mb-2"><a href="{{ route('Horseindex') }}"
                        class="btn w-full text-left bg-indigo-200 hover:bg-indigo-300 dark:bg-indigo-500 dark:hover:bg-indigo-400 text-gray-900 px-4 py-2 rounded-md font-semibold shadow-sm">
                        Caballos</a></li>
               <li class="mb-2"><a href="{{ route('calendar.index') }}"
                        class="btn w-full text-left bg-indigo-200 hover:bg-indigo-300 dark:bg-indigo-500 dark:hover:bg-indigo-400 text-gray-900 px-4 py-2 rounded-md font-semibold shadow-sm">
                        Calendario</a></li>
                        @role('boss')
                <li><a href="{{ route('caretakers.index') }}"
                        class="btn w-full text-left bg-indigo-200 hover:bg-indigo-300 dark:bg-indigo-500 dark:hover:bg-indigo-400 text-gray-900 px-4 py-2 rounded-md font-semibold shadow-sm">
                        Cuidadores</a></li>
                        @endrole
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