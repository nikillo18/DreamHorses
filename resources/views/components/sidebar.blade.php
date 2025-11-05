<!-- Menú lateral -->
<div class="drawer-side">
    <label for="my-drawer" class="drawer-overlay"></label>
    <ul class="menu bg-base-200 min-h-screen w-64 p-4 flex flex-col gap-4 text-base-content">
        <div>
            <li class="mb-2">
                <a href="{{ route('dashboard') }}" class="btn btn-primary w-full text-left">Panel principal</a>
            </li>
            <li class="mb-2">
                <a href="{{ route('studs.index') }}" class="btn btn-primary w-full text-left">Studs</a>
            </li>

            <h3 class="text-base-content/70 text-sm font-semibold">Control</h3>

            <li class="mb-2">
                <a href="{{ route('Horseindex') }}" class="btn btn-secondary w-full text-left">Caballos</a>
            </li>
            <li class="mb-2">
                <a href="{{ route('race.index') }}" class="btn btn-secondary w-full text-left">Carreras</a>
            </li>

            @role('boss|admin')
                <li class="mb-2">
                    <a href="{{ route('caretakers.index') }}" class="btn btn-secondary w-full text-left">Cuidadores</a>
                </li>
            @endrole

            <li class="mb-2">
                <a href="{{ route('training.index') }}" class="btn btn-secondary w-full text-left">Entrenamientos</a>
            </li>
            <li class="mb-2">
                <a href="{{ route('blacksmiths.index') }}" class="btn btn-secondary w-full text-left">Herreria</a>
            </li>
            <li class="mb-2">
                <a href="{{ route('vet-visits.index') }}" class="btn btn-secondary w-full text-left">Veterinario</a>
            </li>
        </div>

        <div class="divider"></div>

        <div>
            <h3 class="text-base-content/70 text-sm font-semibold">Gestion</h3>
            <li class="mb-2">
                <a href="{{ route('calendar.index') }}" class="btn btn-secondary w-full text-left">Eventos</a>
            </li>
            <li class="mb-2">
                <a href="{{ route('expenses.index') }}" class="btn btn-secondary w-full text-left">Gastos</a>
            </li>
            <li class="mb-2">
                <a href="{{ route('expenses.chart') }}" class="btn btn-secondary w-full text-left">Gráfico de
                    Gastos</a>
            </li>
            <li class="mb-2">
                <a href="{{ route('expenses.summary') }}" class="btn btn-secondary w-full text-left">Resumen de
                    Gastos</a>
            </li>
        </div>

        @auth
            @php
                $user = Auth::user();
                $name = trim($user->name ?? '');

                $initials = '';
                if ($name !== '') {
                    $parts = preg_split('/\s+/', $name);
                    if (count($parts) >= 2) {
                        $first = mb_substr($parts[0], 0, 1);
                        $second = mb_substr($parts[1], 0, 1);
                        $initials = mb_strtoupper($first) . mb_strtolower($second);
                    } else {
                        $first = mb_substr($name, 0, 1);
                        $second = mb_substr($name, 1, 1);
                        if ($second !== '') {
                            $initials = mb_strtoupper($first) . mb_strtolower($second);
                        } else {
                            $initials = mb_strtoupper($first);
                        }
                    }
                }

                $role = method_exists($user, 'getRoleNames')
                    ? $user->getRoleNames()->first() ?? ''
                    : $user->roles->pluck('name')->first() ?? '';
            @endphp

            <div class="mt-auto flex justify-end">
                <div class="dropdown dropdown-end">
                    <label tabindex="0" class="btn btn-ghost btn-circle avatar avatar-placeholder">
                        <div
                            class="bg-neutral text-neutral-content w-12 h-12 rounded-full flex items-center justify-center">
                            <span class="text-lg font-semibold">{{ $initials ?: 'U' }}</span>
                        </div>
                    </label>
                    <ul tabindex="-1"
                        class="menu menu-sm dropdown-content bg-base-100 rounded-box z-10 mt-3 w-56 p-2 shadow">
                        <li class="px-3 py-2">
                            <div class="flex flex-col">
                                <span class="font-medium">Nombre: {{ $user->name }}</span>
                                @if ($role)
                                    <span class="text-xs text-base-content/60">Role: {{ ucfirst($role) }}</span>
                                @endif
                            </div>
                        </li>
                        <li>
                            <a href="{{ route('profile.edit') }}" class="w-full inline-block">
                                Ver perfil
                            </a>
                        </li>
                        <li>
                            <a href="#" class="w-full inline-block text-left"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Cerrar sesión
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        @endauth


    </ul>
</div>
