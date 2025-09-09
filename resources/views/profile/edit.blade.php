@vite('resources/css/app.css', 'resources/js/app.js')
<div class="drawer lg:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
    <label for="my-drawer"
        class="btn btn-primary drawer-button lg:hidden m-4 shadow-md">Panel</label>
    <div class="drawer-content bg-base-100 text-base-content">
        <div class="container mx-auto p-4">
            <h2 class="text-3xl font-bold mb-6 text-primary">Perfil de Usuario</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="card bg-base-200 shadow-md p-4">
                    <div class="card-body">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
                <div class="card bg-base-200 shadow-md p-4">
                    <div class="card-body">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
                <div class="card bg-base-200 shadow-md p-4">
                    <div class="card-body">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                        Calendario</a></li>
                        @role('boss')
                <li><a href="{{ route('caretakers.index') }}"
                        class="btn btn-primary w-full text-left">
                        Cuidadores</a></li>
                        @endrole
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

            </div>
        </ul>
    </div>
</div>
