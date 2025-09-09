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
        <div class="p-6 md:p-8 max-w-3xl mx-auto">
            <h2 class="text-2xl font-bold text-base-content mb-6">Registrar Visita Veterinaria</h2>
            <a href="{{ route('vet-visits.index') }}"
                class="btn btn-accent mt-4 sm:mt-0 shadow-sm">Volver
                a la Lista</a>
            <form action="{{ route('vet-visits.store') }}" method="POST"
                class="bg-base-200 p-6 rounded-xl shadow-md space-y-4">
                @csrf

                <div>
                    <label for="horse_id" class="font-semibold text-base-content/80">Caballo</label>
                    <select name="horse_id" id="horse_id" required
                        class="select select-bordered w-full">
                        <option disabled selected>Seleccione un caballo</option>
                        @foreach ($horses as $horse)
                            <option value="{{ $horse->id }}">{{ $horse->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="visit_date" class="font-semibold text-base-content/80">Fecha de
                        Visita</label>
                    <input type="date" name="visit_date" id="visit_date"
                        class="input input-bordered w-full"
                        required />
                </div>

                <div>
                    <label for="vet_name" class="font-semibold text-base-content/80">Veterinario</label>
                    <input type="text" name="vet_name" id="vet_name" placeholder="Ej. Dr. Gómez"
                        class="input input-bordered w-full"
                        required />
                </div>

                <div>
                    <label for="vet_phone" class="font-semibold text-base-content/80">Teléfono del
                        Veterinario</label>
                    <input type="text" name="vet_phone" id="vet_phone" placeholder="Ej. 1122334455"
                        class="input input-bordered w-full" />
                </div>

                <div>
                    <label for="diagnosis" class="font-semibold text-base-content/80">Diagnóstico</label>
                    <textarea name="diagnosis" id="diagnosis" rows="3"
                        class="textarea textarea-bordered w-full"
                        placeholder="Ej. Revisión general, sin hallazgos..." required></textarea>
                </div>

                <div>
                    <label for="treatment" class="font-semibold text-base-content/80">Tratamiento</label>
                    <textarea name="treatment" id="treatment" rows="3"
                        class="textarea textarea-bordered w-full"
                        placeholder="Ej. Ninguno necesario" required></textarea>
                </div>

                <div>
                    <label for="next_visit" class="font-semibold text-base-content/80">Próxima Visita
                        (opcional)</label>
                    <input type="date" name="next_visit" id="next_visit"
                        class="input input-bordered w-full" />
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="btn btn-success font-bold w-full shadow-sm">
                        Guardar Visita
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Menú lateral -->
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
                <li class="mb-2"><a href="{{ route('expenses.chart') }}"
                        class="btn btn-secondary w-full text-left">
                        Gráfico de Gastos</a></li>
                <li class="mb-2"><a href="{{ route('vet-visits.index') }}"
                        class="btn btn-secondary w-full text-left">
                        Veterinario</a></li>
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
