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
            <h1 class="text-3xl font-bold mb-6 text-white">✏️ Editar Caballo: {{ $horse->name }}</h1>
            <a href="{{ route('Horseindex') }}" class="btn bg-gray-700 hover:bg-gray-600 text-white ml-2">Volver a la Lista</a>

            <form action="{{ route('horses.update', $horse->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-4 bg-gray-900 p-6 rounded-lg mt-4">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <fieldset class="fieldset">
                        <legend class="text-white">Nombre</legend>
                        <input type="text" name="name" value="{{ old('name', $horse->name) }}" placeholder="Nombre"
                            class="input input-bordered w-full bg-gray-800 text-white" />
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="text-white">Raza</legend>
                        <input type="text" name="breed" value="{{ old('breed', $horse->breed) }}" placeholder="Raza"
                            class="input input-bordered w-full bg-gray-800 text-white" />
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="text-white">Color</legend>
                        <input type="text" name="color" value="{{ old('color', $horse->color) }}" placeholder="Color"
                            class="input input-bordered w-full bg-gray-800 text-white" />
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="text-white">Fecha de Nacimiento</legend>
                        <input type="date" name="birth_date" value="{{ old('birth_date', $horse->birth_date) }}"
                            class="input input-bordered w-full bg-gray-800 text-white" />
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="text-white">Género</legend>
                        <select name="gender" class="select select-bordered w-full bg-gray-800 text-white">
                            <option value="male" {{ $horse->gender == 'male' ? 'selected' : '' }}>Macho</option>
                            <option value="female" {{ $horse->gender == 'female' ? 'selected' : '' }}>Hembra</option>
                        </select>
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="text-white">Padre</legend>
                        <input type="text" name="father_name" value="{{ old('father_name', $horse->father_name) }}"
                            placeholder="Padre"
                            class="input input-bordered w-full bg-gray-800 text-white" />
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="text-white">Madre</legend>
                        <input type="text" name="mother_name" value="{{ old('mother_name', $horse->mother_name) }}"
                            placeholder="Madre"
                            class="input input-bordered w-full bg-gray-800 text-white" />
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="text-white">Cuidador</legend>
                        <select name="caretaker_id" class="select select-bordered w-full bg-gray-800 text-white">
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
                    <label class="text-white font-semibold">📸 Fotos actuales:</label>
                    @if ($horse->photos->count())
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                            @foreach ($horse->photos as $photo)
                                <img src="{{ asset('storage/' . $photo->path) }}"
                                    class="w-full h-32 object-cover rounded-lg border-2 border-gray-700" />
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-gray-400">Este caballo no tiene fotos guardadas.</p>
                    @endif
                </div>


                <fieldset class="fieldset mt-6">
                    <legend class="text-white">Agregar nuevas fotos:</legend>
                    <input type="file" name="photos[]" multiple accept="image/*"
                        class="file-input file-input-bordered w-full bg-gray-800 text-white" />
                </fieldset>


                <button type="submit" class="btn bg-blue-500 hover:bg-blue-600 text-white w-full mt-6">
                    Actualizar Caballo
                </button>
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
