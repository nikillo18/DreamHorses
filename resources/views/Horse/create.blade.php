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
            <h1 class="text-3xl font-bold mb-6 text-gray-800 dark:text-gray-100"> Registrar Caballo</h1>
            <a href="{{ route('Horseindex') }}"
                class="btn bg-indigo-200 hover:bg-indigo-300 dark:bg-indigo-500 dark:hover:bg-indigo-400 text-gray-900 ml-2 shadow-sm">Volver
                a la Lista</a>
            <form action="{{ route('StoreHorse') }}" method="POST" enctype="multipart/form-data"
                class="space-y-4 bg-white dark:bg-gray-800 p-6 rounded-lg mt-4 shadow-md border border-gray-200 dark:border-gray-700">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <fieldset class="fieldset">
                        <legend class="text-gray-700 dark:text-gray-300">Nombre</legend>
                        <input type="text" name="name" id="name"
                            class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100"
                            placeholder="Ej. Relámpago" />
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="text-gray-700 dark:text-gray-300">Raza</legend>
                        <input type="text" name="breed" id="breed"
                            class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100"
                            placeholder="Ej. Pura Sangre" />
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="text-gray-700 dark:text-gray-300">Color</legend>
                        <input type="text" name="color" id="color"
                            class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100"
                            placeholder="Ej. Castaño" />
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="text-gray-700 dark:text-gray-300">Número de Microchip</legend>
                        <input type="text" name="number_microchip" id="number_microchip"
                            class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100"
                            placeholder="Ej. 1234567AJF" />
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="text-gray-700 dark:text-gray-300">Fecha de nacimiento</legend>
                        <input type="date" name="birth_date" id="birth_date"
                            class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100" />
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="text-gray-700 dark:text-gray-300">Género</legend>
                        <select name="gender" id="gender"
                            class="select select-bordered w-full bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100">
                            <option disabled selected>Seleccione género</option>
                            <option value="male">Macho</option>
                            <option value="female">Hembra</option>
                        </select>
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="text-gray-700 dark:text-gray-300">Padre</legend>
                        <input type="text" name="father_name" id="father_name"
                            class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100"
                            placeholder="Ej. Viento" />
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="text-gray-700 dark:text-gray-300">Madre</legend>
                        <input type="text" name="mother_name" id="mother_name"
                            class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100"
                            placeholder="Ej. Rayo" />
                    </fieldset>

                    <fieldset class="fieldset md:col-span-2">
                        <legend class="text-gray-700 dark:text-gray-300">Cuidador</legend>
                        <select name="caretaker_id" id="caretaker_id"
                            class="select select-bordered w-full bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100">
                            <option disabled selected>Seleccione cuidador</option>
                            @foreach ($caretakers as $caretaker)
                                <option value="{{ $caretaker->id }}">{{ $caretaker->name }}</option>
                            @endforeach
                        </select>
                    </fieldset>

                    <fieldset class="fieldset md:col-span-2">
                        <legend class="text-gray-700 dark:text-gray-300">Fotos del Caballo</legend>
                        <input type="file" name="photos[]" id="photos" multiple accept="image/*"
                            class="file-input file-input-bordered w-full bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100" />
                    </fieldset>
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="btn bg-green-300 hover:bg-green-400 dark:bg-green-600 dark:hover:bg-green-500 text-gray-900 w-full shadow-sm">
                        Guardar Caballo
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Menú lateral -->
      <div class="drawer-side">
        <label for="my-drawer" class="drawer-overlay"></label>
        <ul
            class="menu bg-base-200 min-h-screen w-64 p-4 flex flex-col gap-4 text-base-content">
            <div>
                <h3 class="text-base-content/70 text-sm font-semibold">Control</h3>
                <li class="mb-2"><a href="{{ route('training.index') }}"
                        class="btn btn-primary w-full text-left">
                        Entrenamientos</a></li>
                <li class="mb-2"><a href="{{ route('Horseindex') }}"
                        class="btn btn-primary w-full text-left">
                        Caballos</a></li>
                <li class="mb-2"><a href="{{ route('calendar.index') }}"
                        class="btn btn-primary w-full text-left">
                        Eventos</a></li>

                @role('boss')
                    <li><a href="{{ route('caretakers.index') }}"
                            class="btn btn-primary w-full text-left">
                            Cuidadores</a></li>
                @endrole
            </div>
            <div class="divider"></div>
            <div>
                <h3 class="text-base-content/70 text-sm font-semibold">Gestion</h3>
                <li class="mb-2"><a href="{{ route('race.index') }}"
                        class="btn btn-secondary w-full text-left">
                        Carreras</a></li>
                <li class="mb-2"><a href="{{ route('expenses.index') }}"
                        class="btn btn-secondary w-full text-left">
                        Gastos</a></li>
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
                    <button type="submit"
                        class="btn btn-error w-full">
                        Cerrar
                        sesión</button>
                </form>
                <form method="GET" action="{{ route('profile.edit') }}">
                    <button type="submit"
                        class="btn btn-info w-full">
                        Ver
                        perfil</button>
                </form>
            </div>
        </ul>
    </div>
</div>

