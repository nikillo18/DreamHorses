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
                <h1 class="text-3xl font-bold text-base-content">
                    Crear Nuevo Evento
                </h1>
                <a href="{{ route('calendar.index') }}"
                    class="btn btn-accent mt-4 sm:mt-0 shadow-sm">Volver
                    a la Lista</a>
            </div>
            <form action="{{ route('calendar.store') }}" method="POST"
                class="space-y-4 bg-base-200 p-6 rounded-lg shadow-md">
                @csrf
                <fieldset class="fieldset">
                    <legend class="text-base-content/80">Título</legend>
                    <input type="text" name="title" id="title" required
                        class="input input-bordered w-full">
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-base-content/80">Caballos</legend>
                    <select
                        class="select select-bordered w-full"
                        name="horse_id" id="horse_id" required>
                        <option disabled selected>Elija un Caballo</option>
                        @foreach ($horse as $horses)
                            <option value="{{ $horses->id }}">{{ $horses->name }}</option>
                        @endforeach
                    </select>
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-base-content/80">Fecha del Evento</legend>
                    <input type="date" name="event_date" id="event_date" value="{{ request('event_date') }}" required
                        class="input input-bordered w-full">
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-base-content/80">Hora del Evento</legend>
                    <input type="time" name="event_time" id="event_time" required
                        class="input input-bordered w-full">
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-base-content/80">Tipo de Evento</legend>
                    <select
                        class="select select-bordered w-full"
                        name="category" id="category" required>
                        <option disabled selected>Elija evento</option>
                        <option>Visita Veterinario</option>
                        <option>Carrera</option>
                    </select>
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-base-content/80">Descripción</legend>
                    <textarea name="description" id="description" rows="3"
                        class="textarea textarea-bordered w-full"></textarea>
                </fieldset>
                <button type="submit"
                    class="btn btn-success font-bold w-full shadow-sm">Crear
                    Evento</button>
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
