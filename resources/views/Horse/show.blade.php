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
        <div class="p-6 md:p-8 max-w-4xl mx-auto space-y-6">

            @if (session('success'))
                <div class="bg-green-200 text-green-800 dark:bg-green-700 dark:text-green-100 p-4 rounded-md shadow-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-100 rounded-2xl shadow-xl p-6">
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
                                                class="btn btn-circle bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100 border-none">❮</a>
                                            <a href="#slide{{ $index === $horse->photos->count() - 1 ? 0 : $index + 1 }}"
                                                class="btn btn-circle bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-100 border-none">❯</a>
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
                        <h2 class="text-2xl font-bold text-indigo-600 dark:text-indigo-300">🐴 {{ $horse->name }}</h2>
                        <p><span class="text-gray-500 dark:text-gray-400 font-semibold">Raza:</span> {{ $horse->breed }}</p>
                        <p><span class="text-gray-500 dark:text-gray-400 font-semibold">Color:</span> {{ $horse->color }}</p>
                        <p><span class="text-gray-500 dark:text-gray-400 font-semibold">Género:</span>
                            {{ $horse->gender === 'male' ? 'Macho' : 'Hembra' }}</p>
                        <p><span class="text-gray-500 dark:text-gray-400 font-semibold">Número de Microchip:</span>
                            {{ $horse->number_microchip }}
                        </p>
                        <p><span class="text-gray-500 dark:text-gray-400 font-semibold">Nacimiento:</span> {{ $horse->birth_date }}</p>
                        <p><span class="text-gray-500 dark:text-gray-400 font-semibold">Padre:</span> {{ $horse->father_name }}</p>
                        <p><span class="text-gray-500 dark:text-gray-400 font-semibold">Madre:</span> {{ $horse->mother_name }}</p>
                        <p><span class="text-gray-500 dark:text-gray-400 font-semibold">Cuidador:</span>
                            {{ $horse->caretaker->name ?? 'Sin cuidador' }}</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-between">
                <a href="{{ route('Horseindex') }}" class="btn btn-sm bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-100">←
                    Volver</a>
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
            </div>
        </div>
    </div>

    <!-- Menú lateral -->
    <div class="drawer-side">
        <label for="my-drawer" class="drawer-overlay"></label>
        <ul class="menu bg-pink-100 dark:bg-gray-950 min-h-screen w-64 p-4 flex flex-col gap-4 text-gray-800 dark:text-gray-100">
            <div>
                <h3 class="text-gray-700 dark:text-gray-300 text-sm font-semibold">Control</h3>
                <li class="mb-2"><a href="{{ route('training.index') }}"
                        class="btn w-full text-left bg-indigo-200 hover:bg-indigo-300 dark:bg-indigo-500 dark:hover:bg-indigo-400 text-gray-900 px-4 py-2 rounded-md font-semibold shadow-sm">
                        Entrenamientos</a></li>
                <li class="mb-2"><a href="{{ route('Horseindex') }}"
                        class="btn w-full text-left bg-indigo-200 hover:bg-indigo-300 dark:bg-indigo-500 dark:hover:bg-indigo-400 text-gray-900 px-4 py-2 rounded-md font-semibold shadow-sm">
                        Caballos</a></li>
                <li><a href="{{ route('calendar.index') }}"
                        class="btn w-full text-left bg-indigo-200 hover:bg-indigo-300 dark:bg-indigo-500 dark:hover:bg-indigo-400 text-gray-900 px-4 py-2 rounded-md font-semibold shadow-sm">
                        Calendario</a></li>
            </div>
            <hr class="border-gray-300 dark:border-gray-700" />
            <div>
                <h3 class="text-gray-700 dark:text-gray-300 text-sm font-semibold">Gestion</h3>
                <li class="mb-2"><a href="{{ route('race.index') }}"
                        class="btn w-full text-left bg-sky-200 hover:bg-sky-300 dark:bg-sky-500 dark:hover:bg-sky-400 text-gray-900 px-4 py-2 rounded-md font-semibold shadow-sm">
                        Carreras</a></li>
                <li class="mb-2"><a href="{{ route('expenses.index') }}"
                        class="btn w-full text-left  bg-sky-200 hover:bg-sky-300 dark:bg-sky-500 dark:hover:bg-sky-400 text-gray-900 px-4 py-2 rounded-md font-semibold shadow-sm">
                        Gastos</a></li>
                <li class="mb-2"><a href="{{ route('vet-visits.index') }}"
                        class="btn w-full text-left  bg-sky-200 hover:bg-sky-300 dark:bg-sky-500 dark:hover:bg-sky-400 text-gray-900 px-4 py-2 rounded-md font-semibold shadow-sm">
                        Veterinario</a></li>
            </div>


            <div class="mt-auto space-y-2">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="btn w-full bg-rose-300 hover:bg-rose-400 dark:bg-rose-600 dark:hover:bg-rose-500 px-4 py-2 rounded-md font-bold shadow"> Cerrar
                        sesión</button>
                </form>
                <form method="GET" action="{{ route('profile.edit') }}">
                    <button type="submit"
                        class="btn w-full bg-teal-200 hover:bg-teal-300 dark:bg-teal-500 dark:hover:bg-teal-400 text-gray-900 px-4 py-2 rounded-md font-semibold shadow"> Ver
                        perfil</button>
                </form>
            </div>
        </ul>
    </div>
</div>