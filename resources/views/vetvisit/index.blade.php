<x-app-layout>
    <div class="p-6 max-w-7xl mx-auto" data-theme="forest">

        <h2 class="text-2xl sm:text-3xl font-bold text-primary mb-6">
            🩺 Visitas Veterinarias
        </h2>

        @if(session('success'))
            <div class="alert alert-success mb-4">{{ session('success') }}</div>
        @endif

        <div class="mb-4">
            <a href="{{ route('vet-visits.create') }}" class="btn btn-primary">
                ➕ Nueva Visita
            </a>
        </div>

        <div class="overflow-x-auto shadow rounded-lg">
            <table class="table table-zebra w-full text-sm">
                <thead>
                    <tr>
                        <th>Caballo</th>
                        <th>Veterinario</th>
                        <th>Teléfono</th>
                        <th>Fecha</th>
                        <th>Diagnóstico</th>
                        <th>Tratamiento</th>
                        <th>Próxima Visita</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($visits as $visit)
                        <tr>
                            <td>{{ $visit->horse->name }}</td>
                            <td>{{ $visit->vet_name }}</td>
                            <td>{{ $visit->vet_phone ?? '-' }}</td>
                            <td>{{ $visit->visit_date }}</td>
                            <td class="max-w-xs break-words">{{ $visit->diagnosis }}</td>
                            <td class="max-w-xs break-words">{{ $visit->treatment }}</td>
                            <td>{{ $visit->next_visit ?? '-' }}</td>
                            <td class="flex flex-col sm:flex-row gap-2">
                                <a href="{{ route('vet-visits.edit', $visit->id) }}"
                                   class="btn btn-warning btn-xs"> Editar</a>

                                <form action="{{ route('vet-visits.destroy', $visit->id) }}" method="POST"
                                      onsubmit="return confirm('¿Eliminar esta visita?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-error btn-xs"> Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
