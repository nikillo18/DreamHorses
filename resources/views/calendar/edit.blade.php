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
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                <h1 class="text-2xl sm:text-3xl font-bold text-base-content text-center sm:text-left">
                    Editar Evento
                </h1>
                <a href="{{ route('calendar.index') }}"
                    class="btn btn-accent mt-4 sm:mt-0 shadow-sm">Volver
                    a la Lista</a>
            </div>

            <form action="{{ route('calendar.update', $calendarEvent->id) }}" method="POST"
                class="space-y-4 bg-base-200 p-6 rounded-lg shadow-md">
                @csrf
                @method('PUT')
                <fieldset class="fieldset">
                    <legend class="text-base-content/80">Título</legend>
                    <input type="text" name="title" id="title" value="{{ $calendarEvent->title }}" required
                        class="input input-bordered w-full">
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-base-content/80">Caballos</legend>
                    <select
                        class="select select-bordered w-full"
                        name="horse_id" id="horse_id" required>
                        <option disabled selected>Elija un Caballo</option>
                        @foreach ($horse as $horses)
                            <option value="{{ $horses->id }}"
                                {{ $horses->id == $calendarEvent->horse_id ? 'selected' : '' }}>{{ $horses->name }}
                            </option>
                        @endforeach
                    </select>
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-base-content/80">Fecha del Evento</legend>
                    <input type="date" name="event_date" id="event_date" value="{{ $calendarEvent->event_date }}"
                        required
                        class="input input-bordered w-full">
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-base-content/80">Hora del Evento</legend>
                    <input type="time" name="event_time" id="event_time"
                        value="{{ \Carbon\Carbon::parse($calendarEvent->event_time)->format('H:i') }}" required
                        class="input input-bordered w-full">
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-base-content/80">Tipo de Evento</legend>
                    <input type="text" name="category" id="category" value="{{ $calendarEvent->category }}" required
                        class="input input-bordered w-full">
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-base-content/80">Descripción</legend>
                    <textarea name="description" id="description" rows="3"
                        class="textarea textarea-bordered w-full">{{ $calendarEvent->description }}</textarea>
                </fieldset>
                <button type="submit"
                    class="btn btn-warning font-bold w-full shadow-sm">Actualizar
                    Evento</button>
            </form>
        </div>
    </div>

    <x-sidebar />
</div>
