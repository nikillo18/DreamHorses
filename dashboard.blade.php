@vite('resources/css/app.css', 'resources/js/app.js')
<div class="drawer lg:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />

    <div class="drawer-content">
        <!-- Page content here -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-15">
            @foreach ($horses as $horse)
                <div class="card bg-base-100 w-96 gap-10 shadow-sm">
                    <figure>
                        <img src="{{ $horse->photos->first() ? asset('storage/' . $horse->photos->first()->path) : ($horse->photo_path ? asset('storage/' . $horse->photo_path) : 'https://images.unsplash.com/photo-1615989275591-9fdbfe661ec1?q=80&w=1332&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D') }}"
                            class="w-full h-48 object-cover rounded-t-lg" />
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">{{ $horse->name }}</h2>
                        <p>Raza: {{ $horse->breed }}</p>
                        <p>Color: {{ $horse->color }}</p>
                        <p>Fecha de nacimiento: {{ $horse->birth_date }}</p>
                        <p>Cuidador: {{ $horse->caretaker->name }}</p>
                        <div class="divider"></div>
                        <h3 class="font-bold text-primary">Eventos próximos</h3>
                        <ul class="list-disc ml-4">
                            @foreach ($nextRaces->where('horse_id', $horse->id) as $race)
                                <li>
                                    <span class="badge badge-info">Carrera</span>
                                    {{ \Carbon\Carbon::parse($race->date)->format('d/m/Y') }} - {{ $race->description }}
                                </li>
                            @endforeach
                            @foreach ($nextVetVisits->where('horse_id', $horse->id) as $visit)
                                <li>
                                    <span class="badge badge-warning">Veterinario</span>
                                    {{ \Carbon\Carbon::parse($visit->visit_date)->format('d/m/Y') }} -
                                    {{ $visit->diagnosis }}
                                </li>
                            @endforeach
                        </ul>
                        <div class="divider"></div>
                        <h3 class="font-bold text-primary">Resumen de gastos</h3>
                        <p>
                            Total: <span class="badge badge-success">
                                ${{ number_format($expenses[$horse->id]->total ?? 0, 2) }}
                            </span>
                        </p>
                        <div class="divider"></div>
                        <h3 class="font-bold text-error">Alertas</h3>
                        <ul class="list-disc ml-4">
                            @foreach ($alerts->where('horse_id', $horse->id) as $alert)
                                <li>
                                    Próxima visita: {{ \Carbon\Carbon::parse($alert->visit_date)->format('d/m/Y') }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="drawer-side">
        <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
        <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4">
            <!-- Sidebar content here -->
            <li class="mb-2"><a href="{{ route('training.index') }}" class="btn btn-primary ml-2">Entrenamientos</a>
            </li>
            <li class="mb-2"> <a href="{{ route('race.index') }}" class="btn btn-secondary ml-2">Carreras</a></li>
            <li class="mb-2"><a href="{{ route('expenses.index') }}" class="btn btn-info ml-2">Gastos</a></li>
            <li class="mb-2"><a href="{{ route('vet-visits.index') }}" class="btn btn-warning ml-2">Veterinario</a>
            </li>
            <li class="mb-2"><a href="{{ route('Horseindex') }}" class="btn btn-secondary ml-2">Caballos</a></li>
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
