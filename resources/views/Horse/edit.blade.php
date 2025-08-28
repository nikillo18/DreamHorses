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
            <h1 class="text-3xl font-bold mb-6 text-gray-800 dark:text-gray-100"> Editar Caballo: {{ $horse->name }}
            </h1>
            <a href="{{ route('Horseindex') }}"
                class="btn bg-indigo-200 hover:bg-indigo-300 dark:bg-indigo-500 dark:hover:bg-indigo-400 text-gray-900 ml-2 shadow-sm">Volver
                a la Lista</a>

            <form action="{{ route('horses.update', $horse->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-4 bg-white dark:bg-gray-800 p-6 rounded-lg mt-4 shadow-md border border-gray-200 dark:border-gray-700">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <fieldset class="fieldset">
                        <legend class="text-gray-700 dark:text-gray-300">Nombre</legend>
                        <input type="text" name="name" value="{{ old('name', $horse->name) }}"
                            placeholder="Nombre"
                            class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100" />
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="text-gray-700 dark:text-gray-300">Raza</legend>
                        <input type="text" name="breed" value="{{ old('breed', $horse->breed) }}"
                            placeholder="Raza"
                            class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100" />
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="text-gray-700 dark:text-gray-300">Color</legend>
                        <input type="text" name="color" value="{{ old('color', $horse->color) }}"
                            placeholder="Color"
                            class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100" />
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="text-gray-700 dark:text-gray-300">Fecha de Nacimiento</legend>
                        <input type="date" name="birth_date" value="{{ old('birth_date', $horse->birth_date) }}"
                            class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100" />
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="text-gray-700 dark:text-gray-300">Género</legend>
                        <select name="gender"
                            class="select select-bordered w-full bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100">
                            <option value="male" {{ $horse->gender == 'male' ? 'selected' : '' }}>Macho</option>
                            <option value="female" {{ $horse->gender == 'female' ? 'selected' : '' }}>Hembra</option>
                        </select>
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="text-gray-700 dark:text-gray-300">Padre</legend>
                        <input type="text" name="father_name" value="{{ old('father_name', $horse->father_name) }}"
                            placeholder="Padre"
                            class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100" />
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="text-gray-700 dark:text-gray-300">Madre</legend>
                        <input type="text" name="mother_name" value="{{ old('mother_name', $horse->mother_name) }}"
                            placeholder="Madre"
                            class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100" />
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="text-gray-700 dark:text-gray-300">Cuidador</legend>
                        <select name="caretaker_id"
                            class="select select-bordered w-full bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100">
                            @foreach ($caretakers as $caretaker)
                                <option value="{{ $caretaker->id }}"
                                    {{ $horse->caretaker_id == $caretaker->id ? 'selected' : '' }}>
                                    {{ $caretaker->name }}
                                </option>
                            @endforeach
                        </select>
                    </fieldset>
                </div>

                <div class="space-y-2 mt-6">
                    <label class="text-gray-700 dark:text-gray-300 font-semibold"> Fotos actuales:</label>
                    @if ($horse->photos->count())
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                            @foreach ($horse->photos as $photo)
                                <img src="{{ asset('storage/' . $photo->path) }}"
                                    class="w-full h-32 object-cover rounded-lg border-2 border-gray-300 dark:border-gray-700" />
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-gray-500 dark:text-gray-400">Este caballo no tiene fotos guardadas.</p>
                    @endif
                </div>


                <fieldset class="fieldset mt-6">
                    <legend class="text-gray-700 dark:text-gray-300">Agregar nuevas fotos:</legend>
                    <input type="file" name="photos[]" multiple accept="image/*"
                        class="file-input file-input-bordered w-full bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-gray-800 dark:text-gray-100" />
                </fieldset>


                <button type="submit"
                    class="btn bg-yellow-300 hover:bg-yellow-400 dark:bg-yellow-500 dark:hover:bg-yellow-400 text-gray-900 w-full mt-6 shadow-sm">
                    Actualizar Caballo
                </button>
            </form>
        </div>
    </div>

    <!-- Menú lateral -->
    <div class="drawer-side">
        <label for="my-drawer" class="drawer-overlay"></label>
        <ul
            class="menu bg-pink-100 dark:bg-gray-950 min-h-screen w-64 p-4 flex flex-col gap-4 text-gray-800 dark:text-gray-100">
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
                        Eventos</a></li>
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
                        class="btn w-full bg-rose-300 hover:bg-rose-400 dark:bg-rose-600 dark:hover:bg-rose-500 px-4 py-2 rounded-md font-bold shadow">
                        Cerrar
                        sesión</button>
                </form>
                <form method="GET" action="{{ route('profile.edit') }}">
                    <button type="submit"
                        class="btn w-full bg-teal-200 hover:bg-teal-300 dark:bg-teal-500 dark:hover:bg-teal-400 text-gray-900 px-4 py-2 rounded-md font-semibold shadow">
                        Ver
                        perfil</button>
                </form>
            </div>
        </ul>
    </div>
</div>
