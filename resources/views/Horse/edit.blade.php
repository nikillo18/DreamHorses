@vite('resources/css/app.css', 'resources/js/app.js')

<div class="drawer lg:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content bg-base-100 text-base-content">
        <!-- Botón hamburguesa -->
        <label for="my-drawer"
            class="btn btn-primary drawer-button lg:hidden m-4 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </label>

        <!-- Contenido principal -->
        <div class="p-6 md:p-8">
            <h1 class="text-3xl font-bold mb-6 text-base-content"> Editar Caballo: {{ $horse->name }}
            </h1>
            <a href="{{ route('Horseindex') }}"
                class="btn btn-accent ml-2 shadow-sm">Volver
                a la Lista</a>

            <form action="{{ route('horses.update', $horse->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-4 bg-base-200 p-6 rounded-lg mt-4 shadow-md">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <fieldset class="fieldset">
                        <legend class="text-base-content/80">Nombre</legend>
                        <input type="text" name="name" value="{{ old('name', $horse->name) }}"
                            placeholder="Nombre"
                            class="input input-bordered w-full" />
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="text-base-content/80">Raza</legend>
                        <input type="text" name="breed" value="{{ old('breed', $horse->breed) }}"
                            placeholder="Raza"
                            class="input input-bordered w-full" />
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="text-base-content/80">Color</legend>
                        <input type="text" name="color" value="{{ old('color', $horse->color) }}"
                            placeholder="Color"
                            class="input input-bordered w-full" />
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="text-base-content/80">Fecha de Nacimiento</legend>
                        <input type="date" name="birth_date" value="{{ old('birth_date', $horse->birth_date) }}"
                            class="input input-bordered w-full" />
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="text-base-content/80">Género</legend>
                        <select name="gender"
                            class="select select-bordered w-full">
                            <option value="male" {{ $horse->gender == 'male' ? 'selected' : '' }}>Macho</option>
                            <option value="female" {{ $horse->gender == 'female' ? 'selected' : '' }}>Hembra</option>
                        </select>
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="text-base-content/80">Padre</legend>
                        <input type="text" name="father_name" value="{{ old('father_name', $horse->father_name) }}"
                            placeholder="Padre"
                            class="input input-bordered w-full" />
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="text-base-content/80">Madre</legend>
                        <input type="text" name="mother_name" value="{{ old('mother_name', $horse->mother_name) }}"
                            placeholder="Madre"
                            class="input input-bordered w-full" />
                    </fieldset>

                    <fieldset class="fieldset">
                        <legend class="text-base-content/80">Cuidador</legend>
                        <select name="caretaker_id"
                            class="select select-bordered w-full">
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
                    <label class="text-base-content/80 font-semibold"> Fotos actuales:</label>
                    @if ($horse->photos->count())
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                            @foreach ($horse->photos as $photo)
                                <img src="{{ asset('storage/' . $photo->path) }}"
                                    class="w-full h-32 object-cover rounded-lg border-2 border-base-300" />
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-base-content/60">Este caballo no tiene fotos guardadas.</p>
                    @endif
                </div>


                <fieldset class="fieldset mt-6">
                    <legend class="text-base-content/80">Agregar nuevas fotos:</legend>
                    <input type="file" name="photos[]" multiple accept="image/*"
                        class="file-input file-input-bordered w-full" />
                </fieldset>


                <button type="submit"
                    class="btn btn-warning w-full mt-6 shadow-sm">
                    Actualizar Caballo
                </button>
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
