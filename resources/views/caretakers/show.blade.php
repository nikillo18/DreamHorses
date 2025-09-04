@vite('resources/css/app.css', 'resources/js/app.js')

<div class="drawer lg:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content bg-base-100 text-base-content">

        <label for="my-drawer"
            class="btn btn-primary drawer-button lg:hidden m-4 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </label>

        <div class="p-6 md:p-8 max-w-5xl mx-auto space-y-6">
            <h2 class="text-3xl font-bold text-base-content mb-6">
                Detalles del Cuidador: {{ $caretaker->name }}
            </h2>


            <div class="bg-base-200 p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold mb-4"> Caballos a su cuidado</h3>

                @if ($caretaker->horses->count())
                    <table class="table-auto w-full text-sm text-left text-base-content">
                        <thead class="bg-base-300 text-base-content/80 uppercase">
                            <tr>
                                <th class="p-4">Nombre</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($caretaker->horses as $horse)
                                <tr
                                    class="border-b border-base-300 hover:bg-base-300">
                                    <td class="p-4">{{ $horse->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-base-content/70">Este cuidador no tiene caballos asignados.</p>
                @endif
            </div>

            <div class="bg-base-200 p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold mb-4"> Reasignar Caballos</h3>

                @if ($caretaker->horses->count())
                    <form action="{{ route('caretakers.reassign', $caretaker->id) }}" method="POST" class="space-y-4">
                        @csrf
                        <label for="new_caretaker_id" class="font-semibold">Nuevo cuidador:</label>
                        <select name="new_caretaker_id" required class="select select-bordered w-full">
                            <option disabled selected>Seleccione un cuidador</option>
                            @foreach ($otherCaretakers as $c)
                                <option value="{{ $c->id }}">{{ $c->name }}</option>
                            @endforeach
                        </select>

                        <button type="submit" class="btn btn-warning font-bold">
                            Reasignar caballos y eliminar cuidador
                        </button>
                    </form>
                @else
                    <p class="text-base-content/70">No hay caballos que reasignar.</p>
                @endif
            </div>

            <div class="pt-4">
                <a href="{{ route('caretakers.index') }}"
                    class="btn btn-ghost">
                    ⬅ Volver a la lista de cuidadores
                </a>
            </div>
        </div>
    </div>


    <div class="drawer-side">
        <label for="my-drawer" class="drawer-overlay"></label>
        <ul
            class="menu bg-base-200 min-h-screen w-64 p-4 flex flex-col gap-4 text-base-content">
            <div>
                <h3 class="text-base-content/70 text-sm font-semibold">Control</h3>
                <li class="mb-2"><a href="{{ route('training.index') }}"
                        class="btn btn-primary w-full text-left">
                        Entrenamientos</a></li>
                <li class="mb-2"><a href="{{ route('Horseindex') }}"
                        class="btn btn-primary w-full text-left">
                        Caballos</a></li>
                <li class="mb-2"><a href="{{ route('calendar.index') }}"
                        class="btn btn-primary w-full text-left">
                        Eventos</a></li>

                @role('boss')
                    <li><a href="{{ route('caretakers.index') }}"
                            class="btn btn-primary w-full text-left">
                            Cuidadores</a></li>
                @endrole
            </div>
            <div class="divider"></div>
            <div>
                <h3 class="text-base-content/70 text-sm font-semibold">Gestion</h3>
                <li class="mb-2"><a href="{{ route('race.index') }}"
                        class="btn btn-secondary w-full text-left">
                        Carreras</a></li>
                <li class="mb-2"><a href="{{ route('expenses.index') }}"
                        class="btn btn-secondary w-full text-left">
                        Gastos</a></li>
                <li class="mb-2"><a href="{{ route('vet-visits.index') }}"
                        class="btn btn-secondary w-full text-left">
                        Veterinario</a></li>
                <li class="mb-2"><a href="{{ route('blacksmiths.index') }}"
                        class="btn btn-primary w-full text-left">
                        Herradura</a></li>
            </div>


            <div class="mt-auto space-y-2">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="btn btn-error w-full">
                        Cerrar
                        sesión</button>
                </form>
                <form method="GET" action="{{ route('profile.edit') }}">
                    <button type="submit"
                        class="btn btn-info w-full">
                        Ver
                        perfil</button>
                </form>
            </div>
        </ul>
    </div>
</div>