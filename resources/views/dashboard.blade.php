@vite('resources/css/app.css', 'resources/js/app.js')

<div class="drawer lg:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content bg-gray-50 text-gray-800 dark:bg-gray-900 dark:text-gray-100">
        <!-- Botón hamburguesa -->
        <label for="my-drawer"
            class="btn bg-pink-300 hover:bg-pink-400 text-gray-900 dark:bg-pink-400 dark:hover:bg-pink-500 dark:text-gray-900 drawer-button lg:hidden m-4 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </label>

        <!-- Contenido principal -->
        <div class="p-6 md:p-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($horses as $horse)
                    <div
                        class="bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 rounded-2xl shadow-xl p-6 w-full max-w-sm flex flex-col gap-4 border border-gray-200 dark:border-gray-700">
                        <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 rounded-md overflow-hidden">
                            <img src="{{ $horse->photos->first() ? asset('storage/' . $horse->photos->first()->path) : ($horse->photo_path ? asset('storage/' . $horse->photo_path) : 'https://images.unsplash.com/photo-1615989275591-9fdbfe661ec1?q=80&w=1332&auto=format&fit=crop') }}"
                                alt="Foto de {{ $horse->name }}" class="object-cover w-full h-full">
                        </div>

                        <div class="space-y-1">
                            <h2 class="text-xl font-semibold text-indigo-600 dark:text-indigo-300">
                                {{ $horse->name }}</h2>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Raza:
                                <span class="text-gray-800 dark:text-gray-100">{{ $horse->breed }}</span>
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Color:
                                <span class="text-gray-800 dark:text-gray-100">{{ $horse->color }}</span>
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Nacimiento:
                                <span class="text-gray-800 dark:text-gray-100">{{ $horse->birth_date }}</span>
                            </p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Cuidador:
                                <span
                                    class="text-gray-800 dark:text-gray-100">{{ $horse->caretaker->name ?? 'No asignado' }}</span>
                            </p>
                        </div>

                        <hr class="border-gray-300 dark:border-gray-600" />

                        <div>
                            <h3 class="text-purple-500 dark:text-purple-300 text-sm font-semibold">📅 Eventos próximos
                            </h3>
                            <ul class="text-sm text-gray-600 dark:text-gray-300 list-disc ml-4">
                                @forelse ($events->where('horse_id', $horse->id)->sortBy('event_date') as $event)
                                    @php
                                        $badgeClass = 'bg-pink-200 text-pink-900 dark:bg-pink-400 dark:text-gray-900';
                                        if (in_array($event->category, ['Carrera', 'Visita Veterinario'])) {
                                            $badgeClass = 'bg-sky-200 text-sky-900 dark:bg-sky-400 dark:text-gray-900';
                                        }
                                    @endphp
                                    <li>
                                        <span
                                            class="px-2 py-0.5 rounded-md text-xs font-semibold {{ $badgeClass }}">{{ $event->category }}</span>
                                        {{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y') }} -
                                        {{ $event->title }}
                                    </li>
                                @empty
                                    <li>No hay eventos próximos.</li>
                                @endforelse
                            </ul>
                        </div>

                        <hr class="border-gray-300 dark:border-gray-600" />

                        <div>
                            <h3 class="text-green-500 dark:text-green-300 text-sm font-semibold">💰 Resumen de gastos
                            </h3>
                            <p class="text-green-600 dark:text-green-400 text-base font-bold">
                                ${{ number_format($expenses->get($horse->id)?->total ?? 0, 2) }}
                            </p>
                        </div>

                        <hr class="border-gray-300 dark:border-gray-600" />

                        <div>
                            <h3 class="text-red-500 dark:text-red-300 text-sm font-semibold">⚠️ Alertas</h3>
                            <ul class="text-sm text-gray-600 dark:text-gray-300 list-disc ml-4">
                                @forelse ($alerts->where('horse_id', $horse->id)->sortBy('event_date') as $alert)
                                    <li>
                                        <span
                                            class="font-semibold text-red-500 dark:text-red-400">{{ $alert->category }}
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
        <div class="mt-8">
            {{ $horses->links() }}
        </div>
    </div>

    <!-- Menú lateral -->
    <div class="drawer-side">
        <label for="my-drawer" class="drawer-overlay"></label>
        <ul
            class="menu bg-pink-100 dark:bg-gray-950 min-h-screen w-64 p-4 flex flex-col gap-4 text-gray-800 dark:text-gray-100">
            <div>
                <h3 class="text-gray-700 dark:text-gray-300 text-sm font-semibold">Control</h3>
                <li class="mb-2"><a href="{{ route('training.index') }}"
                        class="btn w-full text-left bg-indigo-200 hover:bg-indigo-300 dark:bg-indigo-500 dark:hover:bg-indigo-400 text-gray-900 px-4 py-2 rounded-md font-semibold shadow-sm">
                        Entrenamientos</a></li>
                <li class="mb-2"><a href="{{ route('Horseindex') }}"
                        class="btn w-full text-left bg-indigo-200 hover:bg-indigo-300 dark:bg-indigo-500 dark:hover:bg-indigo-400 text-gray-900 px-4 py-2 rounded-md font-semibold shadow-sm">
                        Caballos</a></li>
                <li class="mb-2"><a href="{{ route('calendar.index') }}"
                        class="btn w-full text-left bg-indigo-200 hover:bg-indigo-300 dark:bg-indigo-500 dark:hover:bg-indigo-400 text-gray-900 px-4 py-2 rounded-md font-semibold shadow-sm">
                        Calendario</a></li>
                        @role('boss')
                <li><a href="{{ route('caretakers.index') }}"
                        class="btn w-full text-left bg-indigo-200 hover:bg-indigo-300 dark:bg-indigo-500 dark:hover:bg-indigo-400 text-gray-900 px-4 py-2 rounded-md font-semibold shadow-sm">
                        Cuidadores</a></li>
                        @endrole
            </div>
            <hr class="border-gray-300 dark:border-gray-700" />
            <div>
                <h3 class="text-gray-700 dark:text-gray-300 text-sm font-semibold">Gestión</h3>
                <li class="mb-2"><a href="{{ route('race.index') }}"
                        class="btn w-full text-left bg-sky-200 hover:bg-sky-300 dark:bg-sky-500 dark:hover:bg-sky-400 text-gray-900 px-4 py-2 rounded-md font-semibold shadow-sm">
                        Carreras</a></li>
                <li class="mb-2"><a href="{{ route('expenses.index') }}"
                        class="btn w-full text-left bg-sky-200 hover:bg-sky-300 dark:bg-sky-500 dark:hover:bg-sky-400 text-gray-900 px-4 py-2 rounded-md font-semibold shadow-sm">
                        Gastos</a></li>
                <li class="mb-2"><a href="{{ route('vet-visits.index') }}"
                        class="btn w-full text-left bg-sky-200 hover:bg-sky-300 dark:bg-sky-500 dark:hover:bg-sky-400 text-gray-900 px-4 py-2 rounded-md font-semibold shadow-sm">
                        Veterinario</a></li>
            </div>

            <div class="mt-auto space-y-2">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="btn w-full bg-rose-300 hover:bg-rose-400 dark:bg-rose-600 dark:hover:bg-rose-500 px-4 py-2 rounded-md font-bold shadow">
                        Cerrar sesión</button>
                </form>
                <form method="GET" action="{{ route('profile.edit') }}">
                    <button type="submit"
                        class="btn w-full bg-teal-200 hover:bg-teal-300 dark:bg-teal-500 dark:hover:bg-teal-400 text-gray-900 px-4 py-2 rounded-md font-semibold shadow">
                        Ver perfil</button>
                </form>
            </div>
        </ul>
    </div>
</div>
