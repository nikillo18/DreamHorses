<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Crear Carrera - DreamHorses</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                <h1 class="text-3xl font-bold text-base-content"> Crear Carrera</h1>
                <a href="{{ route('race.index') }}" class="btn btn-accent mt-4 sm:mt-0 shadow-sm">Volver
                    a la Lista</a>
            </div>
            <x-session-alert />
            <form action="{{ route('race.store') }}" method="post"
                class="space-y-4 bg-base-200 p-6 rounded-lg shadow-md">
                @csrf
                <fieldset class="fieldset">
                    <legend class="text-base-content/80">Fecha de la Carrera</legend>
                    <input type="date" class="input input-bordered w-full" name="date" required />
                    <x-input-error :messages="$errors->get('date')" class="mt-2" />
                </fieldset>
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
                    <legend class="text-base-content/80">Hipódromo</legend>
                    <input type="text" class="input input-bordered w-full" name="hipodromo" placeholder="Nombre del Hipódromo"
                        required />
                    <x-input-error :messages="$errors->get('hipodromo')" class="mt-2" />
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-base-content/80">Video</legend>
                    <input type="url" class="input input-bordered w-full" name="video" placeholder="URL del Video" />
                    <x-input-error :messages="$errors->get('video')" class="mt-2" />
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-base-content/80">Posición</legend>
                    <input type="number" class="input input-bordered w-full" name="place"
                        placeholder="Posición del Caballo" />
                    <x-input-error :messages="$errors->get('place')" class="mt-2" />
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-base-content/80">Distancia Recorrida</legend>
                    <input type="number" class="input input-bordered w-full" name="distance"
                        placeholder="Distancia Recorrida" />
                    <x-input-error :messages="$errors->get('distance')" class="mt-2" />
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-base-content/80">Descripcion de la Carrera</legend>
                    <textarea class="textarea textarea-bordered h-24 w-full" name="description" placeholder="Descripcion"></textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-base-content/80">Jockey</legend>
                    <input type="text" class="input input-bordered w-full" name="jockey"
                        placeholder="Nombre del Jokey" required />
                    <x-input-error :messages="$errors->get('jockey')" class="mt-2" />
                </fieldset>
                <button type="submit" class="btn btn-success font-bold w-full shadow-sm">Crear</button>
            </form>
        </div>
    </div>

    <x-sidebar />
</div>
</body>

</html>