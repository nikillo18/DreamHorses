<x-app-layout>
    <div class="p-6 max-w-6xl mx-auto space-y-6">
        <h2 class="text-3xl font-bold text-blue-400 mb-4"> Lista de Gastos</h2>

        @if(session('success'))
            <div class="alert alert-success shadow-md">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-end mb-4">
            <a href="{{ route('expenses.create') }}" class="btn btn-primary">
                Nuevo Gasto
            </a>
        </div>

        <div class="overflow-x-auto rounded shadow">
            <table class="table table-zebra w-full">
                <thead class="bg-blue-900 text-white">
                    <tr>
                        <th>Fecha</th>
                        <th>Caballo</th>
                        <th>Categoría</th>
                        <th>Descripción</th>
                        <th>Monto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($expenses as $expense)
                        <tr>
                            <td>{{ $expense->date }}</td>
                            <td>{{ $expense->horse->name }}</td>
                            <td>{{ $expense->category }}</td>
                            <td>{{ $expense->description }}</td>
                            <td class="text-green-400 font-semibold">${{ number_format($expense->amount) }}</td>
                            <td class="flex gap-2">
                                <a href="{{ route('expenses.edit', $expense->id) }}" class="btn btn-xs btn-warning">Modificar</a>

                                <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST"
                                      onsubmit="return confirm('¿Estás seguro de eliminar este gasto?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-xs btn-error">Borrar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-gray-500">No hay gastos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
