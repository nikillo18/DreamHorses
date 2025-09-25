<!-- Menú lateral -->
<div class="drawer-side">
    <label for="my-drawer" class="drawer-overlay"></label>
    <ul class="menu bg-base-200 min-h-screen w-64 p-4 flex flex-col gap-4 text-base-content">
        <div>
            <li class="mb-2"><a href="{{ route('dashboard') }}" class="btn btn-primary w-full text-left">Panel
                    principal</a>
            </li>
            <h3 class="text-base-content/70 text-sm font-semibold">Control</h3>
            <li class="mb-2"><a href="{{ route('Horseindex') }}" class="btn btn-secondary w-full text-left">
                    Caballos</a></li>
            <li class="mb-2"><a href="{{ route('race.index') }}" class="btn btn-secondary w-full text-left">
                    Carreras</a></li>
            @role('boss|admin')
                <li class="mb-2"><a href="{{ route('caretakers.index') }}" class="btn btn-secondary w-full text-left">
                        Cuidadores</a></li>
            @endrole

            <li class="mb-2"><a href="{{ route('training.index') }}" class="btn btn-secondary w-full text-left">
                    Entrenamientos</a></li>


            <li class="mb-2"><a href="{{ route('blacksmiths.index') }}" class="btn btn-secondary w-full text-left">
                    Herreria</a></li>
            <li class="mb-2"><a href="{{ route('vet-visits.index') }}" class="btn btn-secondary w-full text-left">
                    Veterinario</a></li>
        </div>
        <div class="divider"></div>
        <div>
            <h3 class="text-base-content/70 text-sm font-semibold">Gestion</h3>
            <li class="mb-2"><a href="{{ route('calendar.index') }}" class="btn btn-secondary w-full text-left">
                    Eventos</a></li>
            <li class="mb-2"><a href="{{ route('expenses.index') }}" class="btn btn-secondary w-full text-left">
                    Gastos</a></li>
            <li class="mb-2"><a href="{{ route('expenses.chart') }}" class="btn btn-secondary w-full text-left">
                    Gráfico de Gastos</a></li>
            <li class="mb-2"><a href="{{ route('expenses.summary') }}" class="btn btn-secondary w-full text-left">
                    Resumen de Gastos</a></li>

        </div>


        <div class="mt-auto space-y-2">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-error w-full">
                    Cerrar
                    sesión</button>
            </form>
            <form method="GET" action="{{ route('profile.edit') }}">
                <button type="submit" class="btn btn-info w-full">
                    Ver
                    perfil</button>
            </form>
        </div>
    </ul>
</div>
