@vite('resources/css/app.css', 'resources/js/app.js')
<div class="drawer lg:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />

    <div class="drawer-content p-4 md:p-8">
        <!-- Page content here -->
        <div class="p-6 max-w-4xl mx-auto space-y-6">

            @if (session('success'))
                <div class="alert alert-success shadow-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card bg-gray-800 text-white border shadow-xl p-6">
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
                                                class="btn btn-circle">❮</a>
                                            <a href="#slide{{ $index === $horse->photos->count() - 1 ? 0 : $index + 1 }}"
                                                class="btn btn-circle">❯</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <img src="{{ $horse->photo_path ? asset('storage/' . $horse->photo_path) : 'https://images.unsplash.com/photo-1615989275591-9fdbfe661ec1?q=80&w=1332&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' }}"
                                class="w-full h-80 object-cover rounded" />
                        @endif
                    </div>

                    <div class="md:w-1/2 space-y-2">
                        <h2 class="text-2xl font-bold">🐴 {{ $horse->name }}</h2>
                        <p><span class="text-blue-400 font-semibold">Raza:</span> {{ $horse->breed }}</p>
                        <p><span class="text-blue-400 font-semibold">Color:</span> {{ $horse->color }}</p>
                        <p><span class="text-blue-400 font-semibold">Género:</span>
                            {{ $horse->gender === 'male' ? 'Macho' : 'Hembra' }}</p>
                        <p><span class="text-blue-400 font-semibold">Número de Microchip:</span>
                            {{ $horse->number_microchip }}
                        </p>
                        <p><span class="text-blue-400 font-semibold">Nacimiento:</span> {{ $horse->birth_date }}</p>
                        <p><span class="text-blue-400 font-semibold">Padre:</span> {{ $horse->father_name }}</p>
                        <p><span class="text-blue-400 font-semibold">Madre:</span> {{ $horse->mother_name }}</p>
                        <p><span class="text-blue-400 font-semibold">Cuidador:</span>
                            {{ $horse->caretaker->name ?? 'Sin cuidador' }}</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('Horseindex') }}" class="btn btn-outline btn-sm">← Volver</a>
                <div class="flex gap-2">
                    <a href="{{ route('horses.edit', $horse->id) }}" class="btn btn-warning btn-sm"> Modificar</a>
                    <form action="{{ route('horses.destroy', $horse->id) }}" method="POST"
                        onsubmit="return confirm('¿Estás seguro de eliminar este caballo?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-error btn-sm"> Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="drawer-side">
            <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4">
                <!-- Sidebar content here -->
                <li class="mb-2"><a href="{{ route('training.index') }}"
                        class="btn btn-primary ml-2">Entrenamientos</a>
                </li>
                <li class="mb-2"> <a href="{{ route('race.index') }}" class="btn btn-secondary ml-2">Carreras</a>
                </li>
                <li class="mb-2"><a href="{{ route('expenses.index') }}" class="btn btn-info ml-2">Gastos</a></li>
                <li class="mb-2"><a href="{{ route('vet-visits.index') }}"
                        class="btn btn-warning ml-2">Veterinario</a>
                </li>
                <li class="mb-2"><a href="{{ route('Horseindex') }}" class="btn btn-secondary ml-2">Caballos</a></li>
                <li class="mb-4"><a href="{{ route('calendar.index') }}"
                        class="btn btn-secondary ml-2">Calendario</a>
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
