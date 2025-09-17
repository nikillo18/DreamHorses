@vite('resources/css/app.css', 'resources/js/app.js')

<div class="drawer lg:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content bg-base-100 text-base-content">
        <!-- Botón hamburguesa -->
        <label for="my-drawer" class="btn btn-primary drawer-button lg:hidden m-4 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </label>

        <!-- Contenido principal -->
        <div class="p-6 md:p-8 max-w-3xl mx-auto">
            <h2 class="text-2xl font-bold text-base-content mb-6"> Editar Gasto</h2>
            <a href="{{ route('expenses.index') }}" class="btn btn-ghost mt-4 sm:mt-0">Volver
                a la Lista</a>
            @if ($errors->any())
                <div class="alert alert-error">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('expenses.update', $expense->id) }}" method="POST"
                class="space-y-4 bg-base-200 p-6 rounded-xl shadow-md">
                @csrf
                @method('PUT')

                <div>
                    <label for="date" class="block font-semibold mb-1 text-base-content/80">Fecha del
                        Gasto</label>
                    <input type="date" name="date" id="date" class="input input-bordered w-full"
                        value="{{ old('date', $expense->date) }}" required>
                </div>

                <div>
                    <label for="category" class="block font-semibold mb-1 text-base-content/80">Categoría</label>
                    <select name="category" class="select select-bordered w-full" required>
                        <option disabled>Seleccione una categoría</option>
                        <option value="Alimentación"
                            {{ old('category', $expense->category) == 'Alimentación' ? 'selected' : '' }}>
                            Alimentación</option>
                        <option value="Veterinario"
                            {{ old('category', $expense->category) == 'Veterinario' ? 'selected' : '' }}>Veterinario
                        </option>
                        <option value="Equipamiento"
                            {{ old('category', $expense->category) == 'Equipamiento' ? 'selected' : '' }}>
                            Equipamiento</option>
                        
                        <option value="Herrero"
                            {{ old('category', $expense->category) == 'Herrero' ? 'selected' : '' }}>Herrero</option>
                        <option value="Entrenamiento"
                            {{ old('category', $expense->category) == 'Entrenamiento' ? 'selected' : '' }}>
                            Entrenamiento</option>
                        <option value="Otros" {{ old('category', $expense->category) == 'Otros' ? 'selected' : '' }}>
                            Otros</option>
                </div>

                <div>
                    <label for="description" class="block font-semibold mb-1 text-base-content/80">Descripción</label>
                    <textarea name="description" id="description" rows="3" class="textarea textarea-bordered w-full" required>{{ old('description', $expense->description) }}</textarea>
                </div>

                <div>
                    <label for="amount" class="block font-semibold mb-1 text-base-content/80">Monto
                        ($)</label>
                    <input type="number" name="amount" id="amount" step="0.01"
                        class="input input-bordered w-full" value="{{ old('amount', $expense->amount) }}" required>
                </div>

                <div>
                    <label for="horse_id" class="block font-semibold mb-1 text-base-content/80">Caballo</label>
                    <select name="horse_id" id="horse_id" class="select select-bordered w-full" required>
                        @foreach ($horses as $horse)
                            <option value="{{ $horse->id }}"
                                {{ old('horse_id', $expense->horse_id) == $horse->id ? 'selected' : '' }}>
                                {{ $horse->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="pt-4">
                    <button type="submit" class="btn btn-warning w-full text-lg font-bold">
                        Actualizar Gasto
                    </button>
                </div>
            </form>
        </div>
    </div>

    <x-sidebar />
</div>
