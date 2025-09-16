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
            <h2 class="text-2xl sm:text-3xl font-bold text-base-content mb-6 flex items-center gap-2">
                Listado de Caballos
            </h2>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @role('caretaker|boss')
                <div class="mb-4">
                    <a href="{{ route('CreateHorse') }}"
                        class="btn btn-success font-bold shadow-sm">Crear
                        caballo</a>
                </div>
            @endrole
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($horses as $horse)
                    <div
                        class="card bg-base-200 shadow-xl">
                        <figure>
                            <img src="{{ $horse->photos->first() ? asset('storage/' . $horse->photos->first()->path) : ($horse->photo_path ? asset('storage/' . $horse->photo_path) : 'https://images.unsplash.com/photo-1615989275591-9fdbfe661ec1?q=80&w=1332&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D') }}"
                                class="w-full h-48 object-cover" />
                        </figure>
                        <div class="card-body">
                            <h2 class="card-title text-primary">{{ $horse->name }}
                            </h2>
                            <p>Cuidador: <span
                                    class="text-base-content">{{ $horse->caretaker->name ?? 'Sin cuidador' }}</span>
                            </p>
                        </div>
                        <div class="card-actions justify-end p-4">
                            <a href="{{ route('horses.show', $horse->id) }}"
                                class="btn btn-sm btn-primary">
                                Ver información
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-8">
                {{ $horses->links() }}
            </div>
        </div>
    </div>

    <x-sidebar />
</div>
