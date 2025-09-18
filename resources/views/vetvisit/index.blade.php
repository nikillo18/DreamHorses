@vite('resources/css/app.css', 'resources/js/app.js')

<div class="drawer lg:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content bg-base-100 text-base-content">
        <!-- Botón hamburguesa -->
        <label for="my-drawer" class="btn btn-primary drawer-button lg:hidden m-4 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </label>

        <!-- Contenido principal -->
        <div class="p-6 md:p-8 max-w-7xl mx-auto">
            <h2 class="text-2xl sm:text-3xl font-bold text-base-content mb-6">
                Visitas Veterinarias
            </h2>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}</div>
            @endif


            @role('caretaker')
            <div class="mb-4">
                <a href="{{ route('vet-visits.create') }}" class="btn btn-success font-bold shadow-sm">
                    Nueva Visita
                </a>
            </div>
            @endrole

            <div class="p-6 md:p-1">
                @if ($horseId)
                    <a href="{{ route('horses.show', $horseId) }}" class="btn btn-sm btn-secondary mb-4">⬅ Volver al
                        caballo</a>
                @endif
            </div>

            <div class="overflow-x-auto shadow-lg rounded-lg">
                <table class="table-auto w-full text-sm text-left bg-base-200 text-base-content">
                    <thead class="bg-base-300 text-base-content">
                        <tr>
                            <th class="p-4">Caballo</th>
                            <th class="p-4">Veterinario</th>
                            <th class="p-4">Teléfono</th>
                            <th class="p-4">Fecha</th>
                            <th class="p-4">Diagnóstico</th>
                            <th class="p-4">Tratamiento</th>
                            <th class="p-4">Próxima Visita</th>
                             @role('caretaker')
                            <th class="p-4">Acciones</th>
                             @endrole
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($visits as $visit)
                            <tr class="border-b border-base-300 hover:bg-base-300">
                                <td class="p-4">{{ $visit->horse->name }}</td>
                                <td class="p-4">{{ $visit->vet_name }}</td>
                                <td class="p-4">{{ $visit->vet_phone ?? '-' }}</td>
                                <td class="p-4">{{ $visit->visit_date }}</td>
                                <td class="p-4 max-w-xs break-words">{{ $visit->diagnosis }}</td>
                                <td class="p-4 max-w-xs break-words">{{ $visit->treatment }}</td>
                                <td class="p-4">{{ $visit->next_visit ?? '-' }}</td>
                                <td class="p-4 flex flex-col sm:flex-row gap-2">
                                    @role('caretaker')
                                    <a href="{{ route('vet-visits.edit', $visit->id) }}"
                                        class="btn btn-xs btn-warning">Editar</a>
                                    <form action="{{ route('vet-visits.destroy', $visit->id) }}" method="POST"
                                        onsubmit="return confirm('¿Eliminar esta visita?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs btn-error">Eliminar</button>
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
