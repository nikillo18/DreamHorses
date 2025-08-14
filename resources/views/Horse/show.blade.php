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
        <div class="p-6 md:p-8 max-w-4xl mx-auto space-y-6">

            @if (session('success'))
                <div class="bg-green-500 text-white p-4 rounded-md shadow-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-gray-900 text-white rounded-xl shadow-lg p-6">
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
                                                class="btn btn-circle bg-gray-800 text-white border-none">❮</a>
                                            <a href="#slide{{ $index === $horse->photos->count() - 1 ? 0 : $index + 1 }}"
                                                class="btn btn-circle bg-gray-800 text-white border-none">❯</a>
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
                        <h2 class="text-2xl font-bold text-white">🐴 {{ $horse->name }}</h2>
                        <p><span class="text-gray-400 font-semibold">Raza:</span> {{ $horse->breed }}</p>
                        <p><span class="text-gray-400 font-semibold">Color:</span> {{ $horse->color }}</p>
                        <p><span class="text-gray-400 font-semibold">Género:</span>
                            {{ $horse->gender === 'male' ? 'Macho' : 'Hembra' }}</p>
                        <p><span class="text-gray-400 font-semibold">Número de Microchip:</span>
                            {{ $horse->number_microchip }}
                        </p>
                        <p><span class="text-gray-400 font-semibold">Nacimiento:</span> {{ $horse->birth_date }}</p>
                        <p><span class="text-gray-400 font-semibold">Padre:</span> {{ $horse->father_name }}</p>
                        <p><span class="text-gray-400 font-semibold">Madre:</span> {{ $horse->mother_name }}</p>
                        <p><span class="text-gray-400 font-semibold">Cuidador:</span>
                            {{ $horse->caretaker->name ?? 'Sin cuidador' }}</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('Horseindex') }}" class="btn bg-gray-700 hover:bg-gray-600 text-white btn-sm">← Volver</a>
                <div class="flex gap-2">
                    <a href="{{ route('horses.edit', $horse->id) }}" class="btn bg-yellow-500 hover:bg-yellow-600 text-white btn-sm"> Modificar</a>
                    <form action="{{ route('horses.destroy', $horse->id) }}" method="POST"
                        onsubmit="return confirm('¿Estás seguro de eliminar este caballo?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn bg-red-600 hover:bg-red-700 text-white btn-sm"> Eliminar</button>
                    </form>
                </div>
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
