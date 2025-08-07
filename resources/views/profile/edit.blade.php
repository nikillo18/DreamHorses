@vite('resources/css/app.css', 'resources/js/app.js')
<div class="drawer lg:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
    <label for="my-drawer" class="btn btn-primary drawer-button">Panel</label>
    <div class="drawer-content">
        <div class="container mx-auto p-4">
            <h2 class="text-3xl font-bold mb-6 text-primary">Perfil de Usuario</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="card bg-base-100 shadow-md p-4">
                    <div class="card-body">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
                <div class="card bg-base-100 shadow-md p-4">
                    <div class="card-body">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
                <div class="card bg-base-100 shadow-md p-4">
                    <div class="card-body">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="drawer-side">
        <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
        <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4">
            <li class="mb-2"><a href="{{ route('dashboard') }}" class="btn btn-primary w-full">Panel principal</a>
            </li>
            <li class="mb-2"><a href="{{ route('training.index') }}" class="btn btn-primary w-full">Entrenamientos</a>
            </li>
            <li class="mb-2"><a href="{{ route('race.index') }}" class="btn btn-secondary w-full">Carreras</a></li>
            <li class="mb-2"><a href="{{ route('expenses.index') }}" class="btn btn-info w-full">Gastos</a></li>
            <li class="mb-2"><a href="{{ route('vet-visits.index') }}" class="btn btn-warning w-full">Veterinario</a>
            </li>
            <li class="mb-2"><a href="{{ route('Horseindex') }}" class="btn btn-secondary w-full">Caballos</a></li>
            <li class="mb-4"><a href="{{ route('calendar.index') }}" class="btn btn-secondary w-full">Calendario</a>
            </li>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-error w-full">Cerrar sesión</button>
            </form>
            </li>
        </ul>
    </div>
</div>
