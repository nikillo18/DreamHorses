<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Panel Principal - DreamHorses</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="drawer lg:drawer-open">
        <input id="my-drawer" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content bg-gray-50 text-gray-800 dark:bg-gray-900 dark:text-gray-100">
            <label for="my-drawer"
                class="btn bg-pink-300 hover:bg-pink-400 text-gray-900 dark:bg-pink-400 dark:hover:bg-pink-500 dark:text-gray-900 drawer-button lg:hidden m-4 shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </label>
            <div class="p-6 md:p-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($horses as $horse)
                        <div
                            class="bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 rounded-2xl shadow-xl p-6 w-full max-w-sm flex flex-col gap-4 border border-gray-200 dark:border-gray-700">
                            <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 rounded-md overflow-hidden">
                                <img src="{{ $horse->photos->first() ? asset('storage/' . $horse->photos->first()->path) : ($horse->photo_path ? asset('storage/' . $horse->photo_path) : asset('storage/horses/contorno.png')) }}"
                                    alt="Foto de {{ $horse->name }}" class="object-cover w-full h-full">
                            </div>
                            <div class="space-y-1">
                                <h2 class="text-xl font-semibold text-indigo-600 dark:text-indigo-300">
                                    {{ $horse->name }}</h2>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Raza: <span
                                        class="text-gray-800 dark:text-gray-100">{{ $horse->breed }}</span></p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Color: <span
                                        class="text-gray-800 dark:text-gray-100">{{ $horse->color }}</span></p>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Nacimiento: <span
                                        class="text-gray-800 dark:text-gray-100">{{ \Carbon\Carbon::parse($horse->birth_date)->format('d/m/Y') }}</span>
                                </p>
                            </div>
                            <hr class="border-gray-300 dark:border-gray-600" />
                            <div>
                                <h3 class="text-purple-500 dark:text-purple-300 text-sm font-semibold">Eventos
                                    próximos</h3>
                                <ul class="text-sm text-gray-600 dark:text-gray-300 list-disc ml-4">
                                    @forelse ($events->where('horse_id', $horse->id)->sortBy('event_date') as $event)
                                        @php
                                            $badgeClass =
                                                'bg-pink-200 text-pink-900 dark:bg-pink-400 dark:text-gray-900';
                                            if (in_array($event->category, ['Carrera', 'Visita Veterinario'])) {
                                                $badgeClass =
                                                    'bg-sky-200 text-sky-900 dark:bg-sky-400 dark:text-gray-900';
                                            }
                                        @endphp
                                        <li><span
                                                class="px-2 py-0.5 rounded-md text-xs font-semibold {{ $badgeClass }}">{{ $event->category }}</span>
                                            {{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y') }} -
                                            {{ $event->title }}</li>
                                    @empty
                                        <li>No hay eventos próximos.</li>
                                    @endforelse
                                </ul>
                            </div>
                            <hr class="border-gray-300 dark:border-gray-600" />
                            <div>
                                <h3 class="text-green-500 dark:text-green-300 text-sm font-semibold">💰 Resumen de
                                    gastos</h3>
                                <p class="text-green-600 dark:text-green-400 text-base font-bold">
                                    ${{ number_format($expenses->get($horse->id)?->total ?? 0, 2) }}</p>
                            </div>
                            <hr class="border-gray-300 dark:border-gray-600" />
                            <div>
                                <h3 class="text-red-500 dark:text-red-300 text-sm font-semibold">⚠️ Alertas</h3>
                                <ul class="text-sm text-gray-600 dark:text-gray-300 list-disc ml-4">
                                    @forelse ($alerts->where('horse_id', $horse->id)->sortBy('event_date') as $alert)
                                        <li><span
                                                class="font-semibold text-red-500 dark:text-red-400">{{ $alert->category }}
                                                inminente:</span>
                                            {{ \Carbon\Carbon::parse($alert->event_date)->locale('es')->diffForHumans() }}
                                            - {{ $alert->title }}</li>
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
        <x-sidebar />
    </div>
</body>

</html>
