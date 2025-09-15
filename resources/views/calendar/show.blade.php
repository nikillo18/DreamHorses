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
<div>
                @role('caretaker|boss')
                <form action="{{ route('calendar.index') }}" method="get">
                    <button type="submit" class="btn btn-success font-bold shadow-sm">
                        lista de Eventos
                    </button>
                    </form>
                    @endrole
                </div>

        <div class="p-6">
            <div id='calendar'></div>
        </div>

        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.19/index.global.min.js'></script>
        <script>
          document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
         contentHeight: 'auto',
        locale: 'es',
         buttonText: {
      today: 'Hoy',
    },
        events: @json($events),
        eventContent: function(arg) {
            let title = arg.event.title;
            let horse = arg.event.extendedProps.horse;
            let time = arg.event.extendedProps.time;

            return { html: 'Evento:' + title + '<br>' + 'Caballo: ' + horse + '<br>' + 'Hora: ' + time };
        }
    });

    calendar.render();
});
        </script>
    </div>

    <!-- Menú lateral -->
    <div class="drawer-side">
        <label for="my-drawer" class="drawer-overlay"></label>
        <ul
            class="menu bg-base-200 min-h-screen w-64 p-4 flex flex-col gap-4 text-base-content">
            <div>
                <li class="mb-2"><a href="{{ route('dashboard') }}"
                        class="btn btn-primary w-full text-left">Panel
                        principal</a>
                </li>
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
<style>
