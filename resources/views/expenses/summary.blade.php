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
            <h2 class="text-3xl font-bold text-base-content mb-4"> Resumen de Gastos</h2>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif


            <div class="mb-4">
                <form action="{{ route('expenses.summary') }}" method="GET">
                    <div class="flex flex-col md:flex-row gap-2">

                        <input type="month" name="from_month" value="{{ request('from_month') }}"
                            class="input input-bordered" />

                        <input type="month" name="to_month" value="{{ request('to_month') }}"
                            class="input input-bordered" />

                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </form>
            </div>


            @php
                $filtradoPorFecha = request()->filled('from_month') || request()->filled('to_month');
            @endphp

            @if ($filtradoPorFecha)
                <h2 class="text-lg font-semibold mt-6 mb-2">Resumen mensual por categoría</h2>

                @if ($monthlyCategorySummary->isNotEmpty())
                    <div class="overflow-x-auto mb-6">
                        <table class="table table-zebra w-full">
                            <thead>
                                <tr>

                                    <th class="p-4">Categoría</th>
                                    <th class="p-4 text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($monthlyCategorySummary as $item)
                                    <tr>

                                        <td class="p-4">{{ $item->category }}</td>
                                        <td class="p-4 text-success font-semibold text-end ">
                                            ${{ number_format($item->total_amount, 2) }}</td>
                                    </tr>
                                @endforeach
                                {{-- Fila de total general --}}
                                <tr class="font-bold border-t-2 border-base-300">
                                    <td class="p-4">Total general</td>
                                    <td class="p-4 text-success font-semibold text-end ">
                                        ${{ number_format($totalGeneral, 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="mt-4 text-gray-500">No hay datos para el período o búsqueda seleccionados.</p>
                @endif
            @endif

            @role('caretaker')
                <div class="flex justify-end mb-4">
                    <a href="{{ route('expenses.create') }}" class="btn btn-success font-bold">
                        Nuevo Gasto
                    </a>
                </div>
            @endrole

        </div>
    </div>

    <!-- Menú lateral -->
    <div class="drawer-side">
        <label for="my-drawer" class="drawer-overlay"></label>
        <ul class="menu bg-base-200 min-h-screen w-64 p-4 flex flex-col gap-4 text-base-content">
            <div>
                <li class="mb-2"><a href="{{ route('dashboard') }}" class="btn btn-primary w-full text-left">
                        Panel principal</a>
                </li>
                <h3 class="text-base-content/70 text-sm font-semibold">Control</h3>
                <li class="mb-2"><a href="{{ route('training.index') }}" class="btn btn-primary w-full text-left">
                        Entrenamientos</a></li>
                <li class="mb-2"><a href="{{ route('Horseindex') }}" class="btn btn-primary w-full text-left">
                        Caballos</a></li>
                <li class="mb-2"><a href="{{ route('calendar.index') }}" class="btn btn-primary w-full text-left">
                        Eventos</a></li>
                @role('boss')
                    <li><a href="{{ route('caretakers.index') }}" class="btn btn-primary w-full text-left">
                            Cuidadores</a></li>
                @endrole
            </div>
            <div class="divider"></div>
            <div>
                <h3 class="text-base-content/70 text-sm font-semibold">Gestión</h3>
                <li class="mb-2"><a href="{{ route('race.index') }}" class="btn btn-secondary w-full text-left">
                        Carreras</a></li>
                <li class="mb-2"><a href="{{ route('expenses.index') }}" class="btn btn-secondary w-full text-left">
                        Gastos</a></li>
                <li class="mb-2"><a href="{{ route('expenses.chart') }}" class="btn btn-secondary w-full text-left">
                        Gráfico de Gastos</a></li>
                <li class="mb-2"><a href="{{ route('expenses.summary') }}"
                        class="btn btn-secondary w-full text-left">
                        Resumen de Gastos</a></li>
                <li class="mb-2"><a href="{{ route('vet-visits.index') }}"
                        class="btn btn-secondary w-full text-left">
                        Veterinario</a></li>
            </div>


            <div class="mt-auto space-y-2">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-error w-full">
                        Cerrar sesión</button>
                </form>
                <form method="GET" action="{{ route('profile.edit') }}">
                    <button type="submit" class="btn btn-info w-full">
                        Ver perfil</button>
                </form>
            </div>
        </ul>
    </div>
</div>
