<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Panel Principal - DreamHorses</title>
        <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('theme') === 'cupcake') {
            document.documentElement.setAttribute('data-theme', 'cupcake');
        } else {
            document.documentElement.setAttribute('data-theme', 'forest');
        }
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/theme.js'])
</head>

<body>
    <div class="drawer lg:drawer-open">
        <input id="my-drawer" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content bg-base-100 text-base-content">
            <label for="my-drawer"
                class="btn btn-primary drawer-button lg:hidden m-4 shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </label>
            <div class="p-6 md:p-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($horses as $horse)
                        <div
                            class="card bg-base-200 text-base-content rounded-2xl shadow-xl p-6 w-full max-w-sm flex flex-col gap-4 border border-base-300">
                            <div class="w-full h-48 bg-base-300 rounded-md overflow-hidden">
                                <img src="{{ $horse->photos->first() ? asset('storage/' . $horse->photos->first()->path) : ($horse->photo_path ? asset('storage/' . $horse->photo_path) : asset('images/default.png')) }}"
                                    alt="Foto de {{ $horse->name }}" class="object-cover w-full h-full">
                            </div>
                            <div class="space-y-1">
                                <h2 class="text-xl font-semibold text-primary">
                                    {{ $horse->name }}</h2>
                                <p class="text-sm text-base-content/70">Raza: <span
                                        class="text-base-content">{{ $horse->breed }}</span></p>
                                <p class="text-sm text-base-content/70">Color: <span
                                        class="text-base-content">{{ $horse->color }}</span></p>
                                <p class="text-sm text-base-content/70">Nacimiento: <span
                                        class="text-base-content">{{ \Carbon\Carbon::parse($horse->birth_date)->format('d/m/Y') }}</span>
                                </p>
                            </div>
                            <hr class="border-base-300" />
                            <div>
                                <h3 class="text-secondary text-sm font-semibold">Eventos
                                    próximos</h3>
                                <ul class="text-sm text-base-content list-disc ml-4">
                                    @forelse ($events->where('horse_id', $horse->id)->sortBy('event_date') as $event)
                                        @php
                                            $badgeClass =
                                                'badge badge-info';
                                            if (in_array($event->category, ['Carrera', 'Visita Veterinario'])) {
                                                $badgeClass =
                                                    'badge badge-primary';
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
                            <hr class="border-base-300" />
                            <div>
                                <h3 class="text-success text-sm font-semibold">💰 Resumen de
                                    gastos</h3>
                                <p class="text-success text-base font-bold">
                                    ${{ number_format($expenses->get($horse->id)?->total ?? 0, 2) }}</p>
                            </div>
                            <hr class="border-base-300" />
                            
                           {{--  <div>
                                <h3 class="text-error text-sm font-semibold">⚠️ Alertas</h3>
                                <ul class="text-sm text-base-content list-disc ml-4">
                                    @forelse ($alerts->where('horse_id', $horse->id)->sortBy('event_date') as $alert)
                                        <li><span
                                                class="font-semibold text-error">{{ $alert->category }}
                                                inminente:</span>
                                            {{ \Carbon\Carbon::parse($alert->event_date)->locale('es')->diffForHumans() }}
                                            - {{ $alert->title }}</li>
                                    @empty
                                        <li>No hay alertas.</li>
                                    @endforelse
                                </ul>
                            </div> --}}
                            <div class="card-actions justify-end pt-2">
                                <a href="{{ route('horses.pdf', $horse->id) }}"
                                    class="btn btn-sm btn-outline btn-primary">
                                    Descargar PDF
                                </a>
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
