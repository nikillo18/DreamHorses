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
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                <h1 class="text-3xl font-bold text-white">🏋️‍♀️ Crear Entrenamiento</h1>
                <a href="{{ route('training.index') }}" class="btn bg-gray-700 hover:bg-gray-600 text-white mt-4 sm:mt-0">Volver a la Lista</a>
            </div>
            <form action="{{ route('training.store') }}" method="post" class="space-y-4 bg-gray-900 p-6 rounded-lg">
                @csrf
                <fieldset class="fieldset">
                    <legend class="text-white">Caballos</legend>
                    <select class="select select-bordered w-full bg-gray-800 text-white" name="horse_id" id="horse_id" required>
                        <option disabled selected>Elija un Caballo</option>
                        @foreach ($horse as $horses)
                            <option value="{{ $horses->id }}">{{ $horses->name }}</option>
                        @endforeach
                    </select>
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-white">Fecha del Entrenamiento</legend>
                    <input type="date" class="input input-bordered w-full bg-gray-800 text-white" name="date" required />
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-white">Distancia</legend>
                    <input type="number" class="input input-bordered w-full bg-gray-800 text-white" name="distance"
                        placeholder="Distancia Recorrida" required />
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-white">Tiempo</legend>
                    <input type="number" class="input input-bordered w-full bg-gray-800 text-white" name="duration_minutes" placeholder="Tiempo"
                        required />
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-white">Tipo de Entrenamiento</legend>
                    <input type="text" class="input input-bordered w-full bg-gray-800 text-white" name="type_training"
                        placeholder="Tipo de Entrenamiento" required />
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-white">Comentarios</legend>
                    <textarea class="textarea textarea-bordered h-24 w-full bg-gray-800 text-white" name="comments" placeholder="comentarios"></textarea>
                </fieldset>
                <button type="submit" class="btn bg-green-500 hover:bg-green-600 text-white font-bold w-full">Crear</button>
            </form>
        </div>
    </div>

    <!-- Menú lateral -->
    <div class="drawer-side">
        <label for="my-drawer" class="drawer-overlay"></label>
        <ul class="menu bg-gray-950 min-h-screen w-64 p-4 flex flex-col gap-4 text-white">
            <div>
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
