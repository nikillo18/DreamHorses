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
        <div class="p-6 md:p-8 max-w-3xl mx-auto">
            <h2 class="text-2xl font-bold text-white mb-6">✏️ Editar Gasto</h2>

            @if ($errors->any())
                <div class="bg-red-500 text-white p-4 rounded-md mb-4">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('expenses.update', $expense->id) }}" method="POST"
                class="space-y-4 bg-gray-900 text-white p-6 rounded-xl shadow-md">
                @csrf
                @method('PUT')

                <div>
                    <label for="date" class="block font-semibold mb-1 text-gray-300">Fecha del Gasto</label>
                    <input type="date" name="date" id="date"
                        class="input input-bordered w-full bg-gray-800 text-white"
                        value="{{ old('date', $expense->date) }}">
                </div>

                <div>
                    <label for="category" class="block font-semibold mb-1 text-gray-300">Categoría</label>
                    <input type="text" name="category" id="category"
                        class="input input-bordered w-full bg-gray-800 text-white"
                        value="{{ old('category', $expense->category) }}">
                </div>

                <div>
                    <label for="description" class="block font-semibold mb-1 text-gray-300">Descripción</label>
                    <textarea name="description" id="description" rows="3"
                        class="textarea textarea-bordered w-full bg-gray-800 text-white">{{ old('description', $expense->description) }}</textarea>
                </div>

                <div>
                    <label for="amount" class="block font-semibold mb-1 text-gray-300">Monto ($)</label>
                    <input type="number" name="amount" id="amount" step="0.01"
                        class="input input-bordered w-full bg-gray-800 text-white"
                        value="{{ old('amount', $expense->amount) }}">
                </div>

                <div>
                    <label for="horse_id" class="block font-semibold mb-1 text-gray-300">Caballo</label>
                    <select name="horse_id" id="horse_id" class="select select-bordered w-full bg-gray-800 text-white">
                        @foreach ($horses as $horse)
                            <option value="{{ $horse->id }}"
                                {{ old('horse_id', $expense->horse_id) == $horse->id ? 'selected' : '' }}>
                                {{ $horse->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="btn w-full bg-blue-500 hover:bg-blue-600 text-white text-lg font-bold">
                        Actualizar Gasto
                    </button>
                </div>
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
