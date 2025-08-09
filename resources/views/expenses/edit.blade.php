@vite('resources/css/app.css', 'resources/js/app.js')
<div class="drawer lg:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />

    <div class="drawer-content p-4 md:p-8">
        <!-- Page content here -->
        <div class="max-w-3xl mx-auto p-6">
            <h2 class="text-2xl font-bold text-blue-400 mb-6">✏️ Editar Gasto</h2>

            {{-- Mostrar errores --}}
            @if ($errors->any())
                <div class="alert alert-error mb-4">
                    <ul class="list-disc list-inside text-sm text-white">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('expenses.update', $expense->id) }}" method="POST"
                class="space-y-4 bg-base-200 text-white p-6 rounded-xl shadow-md border border-blue-800">
                @csrf
                @method('PUT')

                {{-- Fecha --}}
                <div>
                    <label for="date" class="block font-semibold mb-1 text-blue-300"> Fecha del Gasto</label>
                    <input type="date" name="date" id="date"
                        class="input input-bordered w-full bg-blue-950 text-white"
                        value="{{ old('date', $expense->date) }}">
                </div>

                {{-- Categoría --}}
                <div>
                    <label for="category" class="block font-semibold mb-1 text-blue-300">Categoría</label>
                    <input type="text" name="category" id="category"
                        class="input input-bordered w-full bg-blue-950 text-white"
                        value="{{ old('category', $expense->category) }}">
                </div>

                {{-- Descripción --}}
                <div>
                    <label for="description" class="block font-semibold mb-1 text-blue-300"> Descripción</label>
                    <textarea name="description" id="description" rows="3"
                        class="textarea textarea-bordered w-full bg-blue-950 text-white">{{ old('description', $expense->description) }}</textarea>
                </div>

                {{-- Monto --}}
                <div>
                    <label for="amount" class="block font-semibold mb-1 text-blue-300"> Monto ($)</label>
                    <input type="number" name="amount" id="amount" step="0.01"
                        class="input input-bordered w-full bg-blue-950 text-white"
                        value="{{ old('amount', $expense->amount) }}">
                </div>

                {{-- Caballo --}}
                <div>
                    <label for="horse_id" class="block font-semibold mb-1 text-blue-300"> Caballo</label>
                    <select name="horse_id" id="horse_id" class="select select-bordered w-full bg-blue-950 text-white">
                        @foreach ($horses as $horse)
                            <option value="{{ $horse->id }}"
                                {{ old('horse_id', $expense->horse_id) == $horse->id ? 'selected' : '' }}>
                                {{ $horse->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Botón --}}
                <div class="pt-4">
                    <button type="submit"
                        class="btn w-full bg-blue-600 hover:bg-blue-700 text-white text-lg font-bold">
                        Actualizar Gasto
                    </button>
                </div>
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
