@vite('resources/css/app.css', 'resources/js/app.js')
<div class="drawer lg:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content">
        <div class="p-6" data-theme="forest">
            <h2 class="text-2xl font-bold text-blue-400 mb-6 flex items-center gap-2">🐎 Listado de Caballos</h2>

            @if (session('success'))
                <div class="alert alert-success mb-4">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('CreateHorse') }}" method="get">
                <button type="submit" class="btn btn-primary  btn-xs w-100">Crear caballo</button>
            </form>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($horses as $horse)
                    <div class="card bg-base-100 shadow-xl rounded-xl border-2 border-base-300">
                        <figure>
                            <img src="{{ $horse->photos->first() ? asset('storage/' . $horse->photos->first()->path) : ($horse->photo_path ? asset('storage/' . $horse->photo_path) : 'https://images.unsplash.com/photo-1615989275591-9fdbfe661ec1?q=80&w=1332&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D') }}"
                                class="w-full h-48 object-cover rounded-t-xl" />
                        </figure>
                        <div class="card-body">
                            <h2 class="card-title">{{ $horse->name }}</h2>
                            <p><strong class="text-blue-400">Cuidador:</strong>
                                {{ $horse->caretaker->name ?? 'Sin cuidador' }}</p>
                            <div class="card-actions justify-end">
                                <a href="{{ route('horses.show', $horse->id) }}"
                                    class="btn btn-sm bg-blue-600 hover:bg-blue-700 text-white font-semibold transition">
                                    Ver información
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="drawer-side">
        <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
        <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4">
            <!-- Sidebar content here -->
            <li class="mb-2"><a href="{{ route('dashboard') }}" class="btn btn-primary ml-2">Panel</a>
            <li class="mb-2"><a href="{{ route('training.index') }}" class="btn btn-primary ml-2">Entrenamientos</a>
            </li>
            <li class="mb-2"> <a href="{{ route('race.index') }}" class="btn btn-secondary ml-2">Carreras</a></li>
            <li class="mb-2"><a href="{{ route('expenses.index') }}" class="btn btn-info ml-2">Gastos</a></li>
            <li class="mb-2"><a href="{{ route('vet-visits.index') }}" class="btn btn-warning ml-2">Veterinario</a>
            </li>
            <li class="mb-4"><a href="{{ route('calendar.index') }}" class="btn btn-secondary ml-2">Calendario</a>
            </li>

        </ul>
        <div class="flex justify-center items-center mt-4 space-x-2">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-error w-32">Cerrar sesión</button>
            </form>
            <form method="GET" action="{{ route('profile.edit') }}">
                @csrf
                <button type="submit" class="btn btn-secondary w-32">Ver perfil</button>
            </form>
        </div>

    </div>
</div>
