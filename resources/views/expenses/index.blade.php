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
        <div class="p-6 md:p-8 max-w-6xl mx-auto space-y-6">
            <h2 class="text-3xl font-bold text-base-content mb-4"> Lista de Gastos</h2>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Buscador -->
            <div class="mb-4">
                <form action="{{ route('expenses.index') }}" method="GET">
                    <div class="flex">
                        <input type="text" name="search" placeholder="Buscar por caballo..."
                            class="input input-bordered w-full max-w-xs mr-2" value="{{ request('search') }}" />
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </form>
            </div>
            <div class="mb-4">
                <form action="{{ route('expenses.index') }}" method="GET">
                    <div class="flex flex-col md:flex-row gap-2">

                        <input type="month" name="from_month" value="{{ request('from_month') }}"
                            class="input input-bordered" />

                        <input type="month" name="to_month" value="{{ request('to_month') }}"
                            class="input input-bordered" />

                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </form>
            </div>

            @role('caretaker|admin')
                <div class="flex justify-end mb-4">
                    <a href="{{ route('expenses.create') }}" class="btn btn-success font-bold">
                        Nuevo Gasto
                    </a>
                </div>
            @endrole

            <div class="overflow-x-auto bg-base-200 rounded-lg shadow-lg">
                <table class="table-auto w-full text-sm text-left text-base-content">
                    <thead class="bg-base-300 text-base-content/80 uppercase">
                        <tr>
                            <th class="p-4">Fecha</th>
                            <th class="p-4">Caballo</th>
                            <th class="p-4">Categoría</th>
                            <th class="p-4">Descripción</th>
                            <th class="p-4">Monto</th>
                            @role('caretaker|admin')
                                <th class="p-4">Acciones</th>
                            @endrole
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($expenses as $expense)
                            <tr class="border-b border-base-300 hover:bg-base-300">
                                <td class="p-4">{{ $expense->date }}</td>
                                <td class="p-4">{{ $expense->horse->name }}</td>
                                <td class="p-4">{{ $expense->category }}</td>
                                <td class="p-4">{{ $expense->description }}</td>
                                <td class="p-4 text-success font-semibold text-end ">
                                    ${{ number_format($expense->amount, 2) }}</td>
                                <td class="p-4 flex gap-2">
                                    @role('caretaker|admin')
                                        <a href="{{ route('expenses.edit', $expense->id) }}"
                                            class="btn btn-xs btn-warning">Editar</a>
                                        <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST"
                                            onsubmit="return confirm('¿Estás seguro de eliminar este gasto?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-xs btn-error">Eliminar</button>
                                        </form>
                                    @endrole
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-base-content/70 p-4">No hay gastos
                                    registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-sidebar />
</div>

