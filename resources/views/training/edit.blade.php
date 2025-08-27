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
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-100">✏️ Editar Entrenamiento</h1>
                <a href="{{ route('training.index') }}" class="btn bg-indigo-200 hover:bg-indigo-300 dark:bg-indigo-500 dark:hover:bg-indigo-400 text-gray-900 mt-4 sm:mt-0 shadow-sm">Volver a la Lista</a>
            </div>
            <form action="{{ route('training.update', $training->id) }}" method="post" class="space-y-4 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md border border-gray-200 dark:border-gray-700">
                @csrf
                @method('PUT')
                <fieldset class="fieldset">
                    <legend class="text-gray-700 dark:text-gray-300">Caballos</legend>
                    <select class="select select-bordered w-full bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100" name="horse_id" id="horse_id" required>
                        <option disabled selected>Elija un Caballo</option>
                        @foreach ($horse as $horses)
                            <option value="{{ $horses->id }}" {{ $horses->id == $training->horse_id ? 'selected' : '' }}>
                                {{ $horses->name }}
                            </option>
                        @endforeach
                    </select>
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-gray-700 dark:text-gray-300">Fecha del Entrenamiento</legend>
                    <input type="date" class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100" name="date" value="{{ $training->date }}"
                        required />
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-gray-700 dark:text-gray-300">Distancia</legend>
                    <input type="number" class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100" name="distance"
                        placeholder="Distancia Recorrida" value="{{ $training->distance }}" required />
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-gray-700 dark:text-gray-300">Tiempo</legend>
                    <input type="number" class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100" name="duration_minutes" placeholder="Tiempo"
                        value="{{ $training->duration_minutes }}" required />
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-gray-700 dark:text-gray-300">Tipo de Entrenamiento</legend>
                    <input type="text" class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100" name="type_training"
                        placeholder="Tipo de Entrenamiento" value="{{ $training->type_training }}" required />
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-gray-700 dark:text-gray-300">Comentarios</legend>
                    <textarea class="textarea textarea-bordered h-24 w-full bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100" name="comments" placeholder="comentarios">{{ $training->comments }}</textarea>
                </fieldset>
                <button type="submit" class="btn bg-yellow-300 hover:bg-yellow-400 dark:bg-yellow-500 dark:hover:bg-yellow-400 text-gray-900 font-bold w-full shadow-sm">Actualizar</button>
            </form>
        </div>
    </div>

    <!-- Menú lateral -->
    <div class="drawer-side">
        <label for="my-drawer" class="drawer-overlay"></label>
        <ul class="menu bg-pink-100 dark:bg-gray-950 min-h-screen w-64 p-4 flex flex-col gap-4 text-gray-800 dark:text-gray-100">
            <div>
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