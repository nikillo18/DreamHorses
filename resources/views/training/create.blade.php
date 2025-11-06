<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Crear Entrenamiento - DreamHorses</title>
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
        <div class="p-6 md:p-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                <h1 class="text-3xl font-bold text-base-content"> Crear Entrenamiento</h1>
                <a href="{{ route('training.index') }}" class="btn btn-accent mt-4 sm:mt-0 shadow-sm">Volver
                    a la Lista</a>
            </div>
            <x-session-alert />
            <form action="{{ route('training.store') }}" method="post"
                class="space-y-4 bg-base-200 p-6 rounded-lg shadow-md">
                @csrf
                <fieldset class="fieldset">
                    <legend class="text-base-content/80">Caballos</legend>
                    <select class="select select-bordered w-full" name="horse_id" id="horse_id" required>
                        <option disabled selected>Elija un Caballo</option>
                        @foreach ($horse as $horses)
                            <option value="{{ $horses->id }}">{{ $horses->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('horse_id')" class="mt-2" />
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-base-content/80">Fecha del Entrenamiento</legend>
                    <input type="date" class="input input-bordered w-full" name="date" required />
                    <x-input-error :messages="$errors->get('date')" class="mt-2" />
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-base-content/80">Distancia</legend>
                    <input type="number" class="input input-bordered w-full" name="distance"
                        placeholder="Distancia Recorrida" required />
                    <x-input-error :messages="$errors->get('distance')" class="mt-2" />
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-base-content/80">Tiempo</legend>
                    <input type="number" class="input input-bordered w-full" name="duration_minutes"
                        placeholder="Tiempo" required />
                    <x-input-error :messages="$errors->get('duration_minutes')" class="mt-2" />
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-base-content/80">Tipo de Entrenamiento</legend>
                    <input type="text" class="input input-bordered w-full" name="type_training"
                        placeholder="Tipo de Entrenamiento" required />
                    <x-input-error :messages="$errors->get('type_training')" class="mt-2" />
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-base-content/80">Comentarios</legend>
                    <textarea class="textarea textarea-bordered h-24 w-full" name="comments" placeholder="comentarios"></textarea>
                    <x-input-error :messages="$errors->get('comments')" class="mt-2" />
                </fieldset>
                <button type="submit" class="btn btn-success font-bold w-full shadow-sm">Crear</button>
            </form>
        </div>
    </div>

    <x-sidebar />
</div>
</body>

</html>