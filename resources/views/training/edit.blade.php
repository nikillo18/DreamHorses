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
        <div class="p-6 md:p-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                <h1 class="text-3xl font-bold text-base-content"> Editar Entrenamiento</h1>
                <a href="{{ route('training.index') }}" class="btn btn-accent mt-4 sm:mt-0 shadow-sm">Volver
                    a la Lista</a>
            </div>
            <form action="{{ route('training.update', $training->id) }}" method="post"
                class="space-y-4 bg-base-200 p-6 rounded-lg shadow-md">
                @csrf
                @method('PUT')
                <fieldset class="fieldset">
                    <legend class="text-base-content/80">Caballos</legend>
                    <select class="select select-bordered w-full" name="horse_id" id="horse_id" required>
                        <option disabled selected>Elija un Caballo</option>
                        @foreach ($horse as $horses)
                            <option value="{{ $horses->id }}"
                                {{ $horses->id == $training->horse_id ? 'selected' : '' }}>
                                {{ $horses->name }}
                            </option>
                        @endforeach
                    </select>
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-base-content/80">Fecha del Entrenamiento</legend>
                    <input type="date" class="input input-bordered w-full" name="date"
                        value="{{ $training->date }}" required />
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-base-content/80">Distancia</legend>
                    <input type="number" class="input input-bordered w-full" name="distance"
                        placeholder="Distancia Recorrida" value="{{ $training->distance }}" required />
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-base-content/80">Tiempo</legend>
                    <input type="number" class="input input-bordered w-full" name="duration_minutes"
                        placeholder="Tiempo" value="{{ $training->duration_minutes }}" required />
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-base-content/80">Tipo de Entrenamiento</legend>
                    <input type="text" class="input input-bordered w-full" name="type_training"
                        placeholder="Tipo de Entrenamiento" value="{{ $training->type_training }}" required />
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-base-content/80">Comentarios</legend>
                    <textarea class="textarea textarea-bordered h-24 w-full" name="comments" placeholder="comentarios">{{ $training->comments }}</textarea>
                </fieldset>
                <button type="submit" class="btn btn-warning font-bold w-full shadow-sm">Actualizar</button>
            </form>
        </div>
    </div>

    <x-sidebar />
</div>
