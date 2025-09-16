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
            <div class="mb-6">
                <h1
                    class="text-2xl sm:text-3xl font-bold text-base-content text-center sm:text-left mb-2">
                    Lista de Carreras
                </h1>
                @role('caretaker')
                    <div class="flex justify-start">
                        <a href="{{ route('race.create') }}"
                            class="btn btn-success font-bold shadow-sm">Crear
                            Carrera</a>
                    </div>
                @endrole
            </div>

            <!-- Buscador -->
            <div class="mb-4">
                <form action="{{ route('race.index') }}" method="GET">
                    <div class="flex">
                        <input type="text" name="search" placeholder="Buscar por Fecha..."
                            class="input input-bordered w-full max-w-xs mr-2" value="{{ request('search') }}" />
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </form>
            </div>

            <div class="overflow-x-auto rounded-lg shadow-lg">
                <table
                    class="table-auto w-full text-sm text-left bg-base-200 text-base-content">
                    <thead class="bg-base-300 text-base-content">
                        <tr>
                            <th class="p-4">Fecha de Carrera</th>
                            <th class="p-4">Caballo</th>
                            <th class="p-4">Hipódromo</th>
                            <th class="p-4">Video</th>
                            <th class="p-4">Posición</th>
                            <th class="p-4">Distancia</th>
                            <th class="p-4">Descripción de la Carrera</th>
                            <th class="p-4">Jockey</th>
                            @role('caretaker')
                                <th class="p-4">Acciones</th>
                            @endrole
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($race as $race)
                            <tr
                                class="border-b border-base-300 hover:bg-base-300">
                                <td class="p-4 whitespace-nowrap">{{ $race->date }}</td>
                                <td class="p-4 whitespace-nowrap">{{ $race->horse->name }}</td>
                                <td class="p-4 whitespace-nowrap">{{ $race->hipodromo }}</td>
                                <td class="p-4 whitespace-nowrap">
                               @if($race->video)
                               @php
                               $embedUrl = str_replace('watch?v=', 'embed/', $race->video);
                               @endphp
                               <iframe width="200" height="100" src="{{ $embedUrl }}" frameborder="0" allowfullscreen></iframe>
                               @endif
                            </td>
                                <td class="p-4 whitespace-nowrap">{{ $race->place }}</td>
                            <td class="p-4 whitespace-nowrap">{{ $race->distance }}Mt</td>
                                <td class="p-4 max-w-xs break-words">{{ $race->description }}</td>
                                <td class="p-4 whitespace-nowrap">{{ $race->jockey }}</td>
                                <td class="p-4 flex flex-col sm:flex-row gap-2">
                                    @role('caretaker')
                                        <a href="{{ route('race.edit', $race->id) }}"
                                            class="btn btn-xs btn-warning">Editar</a>
                                        <form action="{{ route('race.destroy', $race->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-xs btn-error">Eliminar</button>
                                        </form>
                                    @endrole
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-sidebar />
</div>
