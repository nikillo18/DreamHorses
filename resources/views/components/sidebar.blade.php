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
                        $initials = mb_strtoupper($first) . mb_strtoupper($second);
                    } else {
                        $first = mb_substr($name, 0, 1);
                        $second = mb_substr($name, 1, 1);
                        if ($second !== '') {
                            $initials = mb_strtoupper($first) . mb_strtoupper($second);
                        } else {
                            $initials = mb_strtoupper($first);
                        }
                    }
                }
                $role = method_exists($user, 'getRoleNames')
                    ? $user->getRoleNames()->first() ?? ''
                    : $user->roles->pluck('name')->first() ?? '';
            @endphp

            <div class="mt-auto pt-4 border-t border-base-300">
                <div class="dropdown dropdown-top dropdown-end w-full">

                    <label tabindex="0"
                        class="btn btn-ghost w-full justify-center gap-3 h-auto py-3 px-3 hover:bg-base-300 transition-all rounded-lg">
                        <div class="avatar placeholder">
                            <div
                                class="bg-primary text-primary-content w-11 h-11 rounded-full flex items-center justify-center">
                                <span class="text-lg font-bold">{{ $initials ?: 'U' }}</span>
                            </div>
                        </div>
                        <div class="flex flex-col items-start flex-1 min-w-0">
                            <span class="font-semibold text-sm truncate w-full text-left">{{ $user->name }}</span>
                            @php
                                $roles = [
                                    'caretaker' => 'Cuidador',
                                    'boss' => 'Jefe',
                                ];

                                $roleTranslated = $roles[$role] ?? ucfirst($role);
                            @endphp

                            @if ($role)
                                <span class="text-xs opacity-60 truncate w-full text-left">{{ $roleTranslated }}</span>
                            @endif

                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-60 flex-shrink-0" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                        </svg>
                    </label>


                    <ul tabindex="-1"
                        class="dropdown-content menu bg-base-100 rounded-lg z-[100] w-60 p-2 shadow-xl border border-base-300 mb-2">

                        <li class="px-3 py-2 mb-1 pointer-events-none">
                            <div class="flex flex-col gap-1">
                                <span class="font-bold text-sm">{{ $user->name }}</span>

                                @php
                                    $roles = [
                                        'caretaker' => 'Cuidador',
                                        'boss' => 'Jefe',
                                    ];

                                    $roleTranslated = $roles[$role] ?? ucfirst($role);
                                @endphp

                                @if ($role)
                                    <span
                                        class="badge badge-primary badge-xs mt-1 self-center "">{{ $roleTranslated }}</span>
                                @endif

                                <span class="text-xs opacity-60 truncate">{{ $user->email }}</span>
                            </div>
                        </li>

                        <div class="divider my-1"></div>


                        <li>
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 py-2 text-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span>Ver perfil</span>
                            </a>
                        </li>

                        <div class="divider my-1"></div>


                        <li>
                            <a href="#"
                                class="flex items-center gap-2 py-2 text-sm text-error hover:bg-error hover:text-error-content"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                <span>Cerrar sesión</span>
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

