@vite('resources/css/app.css', 'resources/js/app.js')
<div class="drawer lg:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />

    <div class="drawer-content p-4 md:p-8">
        <!-- Page content here -->
        <div class="max-w-3xl mx-auto p-6">
            <h2 class="text-2xl font-bold text-white-300 mb-6">✏️ Editar Caballo: {{ $horse->name }}</h2>

            <form action="{{ route('horses.update', $horse->id) }}" method="POST" enctype="multipart/form-data"
                class="space-y-4 bg-gray-800 text-white p-6 rounded-xl shadow-md ">
                @csrf
                @method('PUT')

                <input type="text" name="name" value="{{ old('name', $horse->name) }}" placeholder="Nombre"
                    class="input input-bordered w-full bg-blue-900 text-white placeholder:text-blue-400" />

                <input type="text" name="breed" value="{{ old('breed', $horse->breed) }}" placeholder="Raza"
                    class="input input-bordered w-full bg-blue-900 text-white placeholder:text-blue-400" />

                <input type="text" name="color" value="{{ old('color', $horse->color) }}" placeholder="Color"
                    class="input input-bordered w-full text-white bg-blue-900 placeholder:text-blue-400" />

                <input type="date" name="birth_date" value="{{ old('birth_date', $horse->birth_date) }}"
                    class="input input-bordered w-full bg-blue-900 text-white" />

                <select name="gender" class="select select-bordered w-full bg-blue-900 text-white">
                    <option value="male" {{ $horse->gender == 'male' ? 'selected' : '' }}>Macho</option>
                    <option value="female" {{ $horse->gender == 'female' ? 'selected' : '' }}>Hembra</option>
                </select>

                <input type="text" name="father_name" value="{{ old('father_name', $horse->father_name) }}"
                    placeholder="Padre"
                    class="input input-bordered w-full bg-blue-900 text-white placeholder:text-blue-400" />

                <input type="text" name="mother_name" value="{{ old('mother_name', $horse->mother_name) }}"
                    placeholder="Madre"
                    class="input input-bordered w-full bg-blue-900 text-white placeholder:text-blue-400" />

                <select name="caretaker_id" class="select select-bordered w-full bg-blue-900 text-white">
                    @foreach ($caretakers as $caretaker)
                        <option value="{{ $caretaker->id }}"
                            {{ $horse->caretaker_id == $caretaker->id ? 'selected' : '' }}>
                            {{ $caretaker->name }}
                        </option>
                    @endforeach
                </select>

                <div class="space-y-2">
                    <label class="text-blue-300 font-semibold">📸 Fotos actuales:</label>
                    @if ($horse->photos->count())
                        <div class="grid grid-cols-2 gap-2">
                            @foreach ($horse->photos as $photo)
                                <img src="{{ asset('storage/' . $photo->path) }}"
                                    class="w-full h-32 object-cover rounded border border-blue-700" />
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-gray-400">Este caballo no tiene fotos guardadas.</p>
                    @endif
                </div>


                <div>
                    <label class="text-blue-300 font-semibold"> Agregar nuevas fotos:</label>
                    <input type="file" name="photos[]" multiple accept="image/*"
                        class="file-input file-input-bordered w-full bg-blue-900 text-white" />
                </div>


                <button type="submit" class="btn bg-blue-600 hover:bg-blue-700 text-white w-full text-lg font-bold">
                    Actualizar Caballo
                </button>
            </form>
        </div>

        <div class="drawer-side">
            <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4">
                <!-- Sidebar content here -->
                <li class="mb-2"><a href="{{ route('training.index') }}"
                        class="btn btn-primary ml-2">Entrenamientos</a>
                </li>
                <li class="mb-2"> <a href="{{ route('race.index') }}" class="btn btn-secondary ml-2">Carreras</a>
                </li>
                <li class="mb-2"><a href="{{ route('expenses.index') }}" class="btn btn-info ml-2">Gastos</a></li>
                <li class="mb-2"><a href="{{ route('vet-visits.index') }}"
                        class="btn btn-warning ml-2">Veterinario</a>
                </li>
                <li class="mb-2"><a href="{{ route('Horseindex') }}" class="btn btn-secondary ml-2">Caballos</a></li>
                <li class="mb-4"><a href="{{ route('calendar.index') }}"
                        class="btn btn-secondary ml-2">Calendario</a>
                </li>

            </ul>
            <div class="flex justify-center items-center mt-4 space-x-2">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-error w-32">Cerrar sesión</button>
                </form>
                <form method="GET" action="{{ route('profile.edit') }}">
                    @csrf
                    <button type="submit" class="btn btn-secondary w-32">Ver perfil</button>
                </form>
            </div>

        </div>
    </div>
