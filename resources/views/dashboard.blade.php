@vite('resources/css/app.css', 'resources/js/app.js')

<div class="drawer lg:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content bg-gray-950 text-white">
        <!-- Botón hamburguesa -->
        <label for="my-drawer" class="btn btn-primary drawer-button lg:hidden m-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </label>

        <!-- Contenido principal -->
        <div class="p-6 md:p-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($horses as $horse)
                    <div class="bg-gray-900 text-white rounded-xl shadow-lg p-6 w-full max-w-sm flex flex-col gap-4">
                        <div class="w-full h-48 bg-gray-800 rounded-md overflow-hidden">
                            <img src="{{ $horse->photos->first() ? asset('storage/' . $horse->photos->first()->path) : ($horse->photo_path ? asset('storage/' . $horse->photo_path) : 'https://images.unsplash.com/photo-1615989275591-9fdbfe661ec1?q=80&w=1332&auto=format&fit=crop') }}"
                                alt="Foto de {{ $horse->name }}" class="object-cover w-full h-full">
                        </div>

                        <div class="space-y-1">
                            <h2 class="text-xl font-semibold">{{ $horse->name }}</h2>
                            <p class="text-sm text-gray-400">Raza: <span class="text-white">{{ $horse->breed }}</span>
                            </p>
                            <p class="text-sm text-gray-400">Color: <span class="text-white">{{ $horse->color }}</span>
                            </p>
                            <p class="text-sm text-gray-400">Nacimiento: <span
                                    class="text-white">{{ $horse->birth_date }}</span></p>
                            <p class="text-sm text-gray-400">Cuidador: <span
                                    class="text-white">{{ $horse->caretaker->name ?? 'No asignado' }}</span></p>
                        </div>

                        <hr class="border-gray-700" />

                        <div>
                            <h3 class="text-purple-400 text-sm font-semibold">📅 Eventos próximos</h3>
                            <ul class="text-sm text-gray-300 list-disc ml-4">
                                @forelse ($events->where('horse_id', $horse->id)->sortBy('event_date') as $event)
                                    @php
                                        $badgeClass = 'badge-ghost';
                                        if (in_array($event->category, ['Carrera', 'Visita Veterinario'])) {
                                            $badgeClass = 'badge-info';
                                        }
                                    @endphp
                                    <li>
                                        <span class="badge {{ $badgeClass }}">{{ $event->category }}</span>
                                        {{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y') }} -
                                        {{ $event->title }}
                                    </li>
                                @empty
                                    <li>No hay eventos próximos.</li>
                                @endforelse
                            </ul>
                        </div>

                        <hr class="border-gray-700" />

                        <div>
                            <h3 class="text-purple-400 text-sm font-semibold">💰 Resumen de gastos</h3>
                            <p class="text-green-400 text-base font-bold">
                                ${{ number_format($expenses->get($horse->id)?->total ?? 0, 2) }}
                            </p>
                        </div>

                        <hr class="border-gray-700" />

                        <div>
                            <h3 class="text-red-400 text-sm font-semibold">⚠️ Alertas</h3>
                            <ul class="text-sm text-gray-300 list-disc ml-4">
                                @forelse ($alerts->where('horse_id', $horse->id)->sortBy('event_date') as $alert)
                                    <li>
                                        <span class="font-semibold text-red-400">{{ $alert->category }}
                                            inminente:</span>
                                        {{ \Carbon\Carbon::parse($alert->event_date)->locale('es')->diffForHumans() }}
                                        - {{ $alert->title }}
                                    </li>
                                @empty
                                    <li>No hay alertas.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Menú lateral -->
    <div class="drawer-side">
        <label for="my-drawer" class="drawer-overlay"></label>
        <ul class="menu bg-gray-950 min-h-screen w-64 p-4 flex flex-col gap-4 text-white">
            <div>
                <h3 class="text-white text-sm font-semibold">Control</h3>
                <li class="mb-2"><a href="{{ route('training.index') }}"
                        class="btn w-full text-left bg-gray-800 hover:bg-gray-700 px-4 py-2 rounded-md font-semibold">
                        Entrenamientos</a></li>
                <li class="mb-2"><a href="{{ route('Horseindex') }}"
                        class="btn w-full text-left bg-gray-800 hover:bg-gray-700 px-4 py-2 rounded-md font-semibold">
                        Caballos</a></li>
                <li><a href="{{ route('calendar.index') }}"
                        class="btn w-full text-left bg-gray-800 hover:bg-gray-700 px-4 py-2 rounded-md font-semibold">
                        Calendario</a></li>
            </div>
            <hr class="border-gray-700" />
            <div>
                <h3 class="text-white text-sm font-semibold">Gestion</h3>
                <li class="mb-2"><a href="{{ route('race.index') }}"
                        class="btn w-full text-left bg-blue-400 hover:bg-red-200 text-black px-4 py-2 rounded-md font-semibold">
                        Carreras</a></li>
                <li class="mb-2"><a href="{{ route('expenses.index') }}"
                        class="btn w-full text-left  bg-blue-400 hover:bg-red-200 text-black px-4 py-2 rounded-md font-semibold">
                        Gastos</a></li>
                <li class="mb-2"><a href="{{ route('vet-visits.index') }}"
                        class="btn w-full text-left  bg-blue-400 hover:bg-red-200 text-black px-4 py-2 rounded-md font-semibold">
                        Veterinario</a></li>
            </div>


            <div class="mt-auto space-y-2">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="btn w-full bg-rose-600 hover:bg-rose-500 px-4 py-2 rounded-md font-bold"> Cerrar
                        sesión</button>
                </form>
                <form method="GET" action="{{ route('profile.edit') }}">
                    <button type="submit"
                        class="btn w-full bg-sky-700 hover:bg-sky-600 px-4 py-2 rounded-md font-semibold"> Ver
                        perfil</button>
                </form>
            </div>
        </ul>
    </div>
</div>
