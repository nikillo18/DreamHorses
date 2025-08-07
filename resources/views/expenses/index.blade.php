@vite('resources/css/app.css', 'resources/js/app.js')
<div class="drawer lg:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />

    <div class="drawer-content">
        <div class="p-6 max-w-6xl mx-auto space-y-6">
            <h2 class="text-3xl font-bold text-blue-400 mb-4"> Lista de Gastos</h2>

            @if (session('success'))
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
                                    <a href="{{ route('expenses.edit', $expense->id) }}"
                                        class="btn btn-xs btn-warning">Modificar</a>
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
    </div>
    <div class="drawer-side">
        <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
        <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4">
            <!-- Sidebar content here -->
            <li class="mb-2"><a href="{{ route('dashboard') }}" class="btn btn-primary ml-2">Panel</a>
            <li class="mb-2"><a href="{{ route('training.index') }}" class="btn btn-primary ml-2">Entrenamientos</a>
            </li>
            <li class="mb-2"> <a href="{{ route('race.index') }}" class="btn btn-secondary ml-2">Carreras</a></li>

            <li class="mb-2"><a href="{{ route('vet-visits.index') }}" class="btn btn-warning ml-2">Veterinario</a>
            </li>
            <li class="mb-2"><a href="{{ route('Horseindex') }}" class="btn btn-secondary ml-2">Caballos</a></li>
            <li class="mb-4"><a href="{{ route('calendar.index') }}" class="btn btn-secondary ml-2">Calendario</a>
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
