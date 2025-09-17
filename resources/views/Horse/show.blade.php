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
        <div class="p-6 md:p-8 max-w-4xl mx-auto space-y-6">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card bg-base-200 shadow-xl p-6">
                <div class="flex flex-col md:flex-row gap-6">
                    <div class="md:w-1/2">
                        @if ($horse->photos->count())
                            <div class="carousel w-full rounded-lg overflow-hidden shadow">
                                @foreach ($horse->photos as $index => $photo)
                                    <div id="slide{{ $index }}" class="carousel-item relative w-full">
                                        <img src="{{ asset('storage/' . $photo->path) }}"
                                            class="w-full h-80 object-cover" />
                                        <div
                                            class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                                            <a href="#slide{{ $index === 0 ? $horse->photos->count() - 1 : $index - 1 }}"
                                                class="btn btn-circle btn-ghost">❮</a>
                                            <a href="#slide{{ $index === $horse->photos->count() - 1 ? 0 : $index + 1 }}"
                                                class="btn btn-circle btn-ghost">❯</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <img src="{{ $horse->photo_path ? asset('storage/' . $horse->photo_path) : 'https://images.unsplash.com/photo-1615989275591-9fdbfe661ec1?q=80&w=1332&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' }}"
                                class="w-full h-80 object-cover rounded-lg" />
                        @endif
                    </div>

                    <div class="md:w-1/2 space-y-2">
                        <h2 class="text-2xl font-bold text-primary"> {{ $horse->name }}</h2>
                        <p><span class="text-base-content/70 font-semibold">Raza:</span> {{ $horse->breed }}
                        </p>
                        <p><span class="text-base-content/70 font-semibold">Color:</span>
                            {{ $horse->color }}</p>
                        <p><span class="text-base-content/70 font-semibold">Género:</span>
                            {{ $horse->gender === 'male' ? 'Macho' : 'Hembra' }}</p>
                        <p><span class="text-base-content/70 font-semibold">Número de Microchip:</span>
                            {{ $horse->number_microchip }}
                        </p>
                        <p><span class="text-base-content/70 font-semibold">Nacimiento:</span>
                            {{ $horse->birth_date }}</p>
                        <p><span class="text-base-content/70 font-semibold">Padre:</span>
                            {{ $horse->father_name }}</p>
                        <p><span class="text-base-content/70 font-semibold">Madre:</span>
                            {{ $horse->mother_name }}</p>
                        <p><span class="text-base-content/70 font-semibold">Cuidador:</span>
                            {{ $horse->caretaker->name ?? 'Sin cuidador' }}</p>
                            <a href="{{ route('race.index', ['horse_id' => $horse->id]) }}" class="btn btn-sm btn-primary">Carreras</a>
                            <a href="{{ route('vet-visits.index', ['horse_id' => $horse->id]) }}" class="btn btn-sm btn-primary">Visitas de veterinario</a>
                            <a href="{{ route('training.index', ['horse_id' => $horse->id]) }}" class="btn btn-sm btn-primary">Entrenamientos</a>
                    </div>
                </div>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('Horseindex') }}"
                    class="btn btn-sm btn-ghost">←
                    Volver</a>
                    @role('caretaker')
                <div class="flex gap-2">
                    <a href="{{ route('horses.edit', $horse->id) }}"
                        class="btn btn-sm bg-yellow-300 hover:bg-yellow-400 dark:bg-yellow-500 dark:hover:bg-yellow-400 text-gray-900"> Editar</a>
                    <form action="{{ route('horses.destroy', $horse->id) }}" method="POST"
                        onsubmit="return confirm('¿Estás seguro de eliminar este caballo?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm bg-red-300 hover:bg-red-400 dark:bg-red-600 dark:hover:bg-red-500 text-gray-900">
                            Eliminar</button>
                    </form>
                </div>
                @endrole
            </div>
        </div>
    </div>

    <x-sidebar />
</div>
