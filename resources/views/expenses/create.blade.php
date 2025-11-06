<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Crear Gasto - DreamHorses</title>
        <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('theme') === 'cupcake') {
            document.documentElement.setAttribute('data-theme', 'cupcake');
        } else {
            document.documentElement.setAttribute('data-theme', 'forest');
        }
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/theme.js'])
</head>

<body>
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
            <h2 class="text-2xl font-bold text-base-content mb-6"> Registrar Gasto</h2>
            <a href="{{ route('expenses.index') }}" class="btn btn-success font-bold">Volver
                a la Lista</a>
            <x-session-alert />

            <form action="{{ route('expenses.store') }}" method="POST"
                class="space-y-4 bg-base-200 p-6 rounded-xl shadow-md">
                @csrf

                <div>
                    <label for="date" class="block font-semibold mb-1 text-base-content/80">Fecha del
                        Gasto</label>
                    <input type="date" name="date" id="date" class="input input-bordered w-full"
                        value="{{ old('date') }}" required>
                    <x-input-error :messages="$errors->get('date')" class="mt-2" />
                </div>

                <div>
                    <label for="category" class="block font-semibold mb-1 text-base-content/80">Categoría</label>
                    <select name="category" class="select select-bordered w-full" required>
                        <option disabled selected>Seleccione una categoría</option>
                        <option value="Alimentación" {{ old('category') == 'Alimentación' ? 'selected' : '' }}>
                            Alimentación</option>
                        <option value="Veterinario" {{ old('category') == 'Veterinario' ? 'selected' : '' }}>Veterinario
                        </option>
                        <option value="Equipamiento" {{ old('category') == 'Equipamiento' ? 'selected' : '' }}>
                            Equipamiento</option>
                        <option value="Herrero" {{ old('category') == 'Herrero' ? 'selected' : '' }}>Herrero</option>
                        <option value="Entrenamiento" {{ old('category') == 'Entrenamiento' ? 'selected' : '' }}>
                            Entrenamiento</option>
                        <option value="Otros" {{ old('category') == 'Otros' ? 'selected' : '' }}>Otros</option>

                    </select>
                    <x-input-error :messages="$errors->get('category')" class="mt-2" />
                </div>

                <div>
                    <label for="description" class="block font-semibold mb-1 text-base-content/80">Descripción</label>
                    <textarea name="description" id="description" rows="3" class="textarea textarea-bordered w-full" required>{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div>
                    <label for="amount" class="block font-semibold mb-1 text-base-content/80">Monto
                        ($)</label>
                    <input type="number" name="amount" id="amount" step="0.01"
                        class="input input-bordered w-full" value="{{ old('amount') }}" required>
                    <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                </div>

                <div>
                    <label for="horse_id" class="block font-semibold mb-1 text-base-content/80">Caballo</label>
                    <select name="horse_id" id="horse_id" class="select select-bordered w-full" required>
                        <option disabled selected>Seleccione un caballo</option>
                        @foreach ($horses as $horse)
                            <option value="{{ $horse->id }}" {{ old('horse_id') == $horse->id ? 'selected' : '' }}>
                                {{ $horse->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('horse_id')" class="mt-2" />
                </div>

                <div class="pt-4">
                    <button type="submit" class="btn btn-success w-full text-lg font-bold">
                        Guardar Gasto
                    </button>
                </div>
            </form>
        </div>
    </div>

    <x-sidebar />
</div>
</body>

</html>