@vite('resources/css/app.css', 'resources/js/app.js')
<div class="drawer lg:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />

    <div class="drawer-content">
        <label for="my-drawer" class="btn btn-primary drawer-button lg:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </label>
        <!-- Page content here -->
        <x-slot name="header">
            <h2 class="text-xl font-bold text-blue-400 flex items-center gap-2">
                Editar Visita Veterinaria
            </h2>
        </x-slot>

        <div class="max-w-3xl mx-auto p-6 bg-base-200 rounded-xl shadow space-y-4">
            <form action="{{ route('vet-visits.update', $vetVisit->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')


                <div>
                    <label for="horse_id" class="font-semibold">Caballo</label>
                    <select name="horse_id" id="horse_id" class="select select-bordered w-full" required>
                        @foreach ($horses as $horse)
                            <option value="{{ $horse->id }}"
                                {{ $vetVisit->horse_id == $horse->id ? 'selected' : '' }}>
                                {{ $horse->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="visit_date" class="font-semibold">Fecha de Visita</label>
                    <input type="date" name="visit_date" id="visit_date" class="input input-bordered w-full"
                        value="{{ old('visit_date', $vetVisit->visit_date) }}" required>
                </div>

                <div>
                    <label for="vet_name" class="font-semibold">Nombre del Veterinario</label>
                    <input type="text" name="vet_name" id="vet_name" class="input input-bordered w-full"
                        value="{{ old('vet_name', $vetVisit->vet_name) }}" required>
                </div>

                <div>
                    <label for="vet_phone" class="font-semibold">Teléfono</label>
                    <input type="text" name="vet_phone" id="vet_phone" class="input input-bordered w-full"
                        value="{{ old('vet_phone', $vetVisit->vet_phone) }}">
                </div>

                <div>
                    <label for="diagnosis" class="font-semibold">Diagnóstico</label>
                    <textarea name="diagnosis" id="diagnosis" class="textarea textarea-bordered w-full" required>{{ old('diagnosis', $vetVisit->diagnosis) }}</textarea>
                </div>

                <div>
                    <label for="treatment" class="font-semibold">Tratamiento</label>
                    <textarea name="treatment" id="treatment" class="textarea textarea-bordered w-full" required>{{ old('treatment', $vetVisit->treatment) }}</textarea>
                </div>

                <div>
                    <label for="next_visit" class="font-semibold">Próxima Visita</label>
                    <input type="date" name="next_visit" id="next_visit" class="input input-bordered w-full"
                        value="{{ old('next_visit', $vetVisit->next_visit) }}">
                </div>

                <div class="pt-4">
                    <button type="submit" class="btn btn-primary w-full">💾 Actualizar Visita</button>
                </div>
            </form>
        </div>


        <div class="drawer-side">
            <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4">
                <!-- Sidebar content here -->
                <li class="mb-2"><a href="{{ route('training.index') }}"
                        class="btn btn-primary ml-2">Entrenamientos</a>
                </li>
                <li class="mb-2"> <a href="{{ route('race.index') }}" class="btn btn-secondary ml-2">Carreras</a>
                </li>
                <li class="mb-2"><a href="{{ route('expenses.index') }}" class="btn btn-info ml-2">Gastos</a></li>
                <li class="mb-2"><a href="{{ route('vet-visits.index') }}"
                        class="btn btn-warning ml-2">Veterinario</a>
                </li>
                <li class="mb-2"><a href="{{ route('Horseindex') }}" class="btn btn-secondary ml-2">Caballos</a></li>
                <li class="mb-4"><a href="{{ route('calendar.index') }}"
                        class="btn btn-secondary ml-2">Calendario</a>
                </li>

                <div class="flex flex-col justify-center items-center mt-4 space-y-2 w-full">
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="btn btn-error w-full">Cerrar sesión</button>
                    </form>
                    <form method="GET" action="{{ route('profile.edit') }}" class="w-full">
                        @csrf
                        <button type="submit" class="btn btn-secondary w-full">Ver perfil</button>
                    </form>
                </div>
            </ul>

        </div>
    </div>
