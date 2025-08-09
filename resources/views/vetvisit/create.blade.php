@vite('resources/css/app.css', 'resources/js/app.js')
<div class="drawer lg:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />

    <div class="drawer-content p-4 md:p-8">
        <!-- Page content here -->
        <div class="max-w-3xl mx-auto p-6" data-theme="forest">
            <h2 class="text-2xl font-bold text-blue-400 mb-6">🩺 Registrar Visita Veterinaria</h2>

            <form action="{{ route('vet-visits.store') }}" method="POST"
                class="bg-gray-900 text-white p-6 rounded-xl shadow-md space-y-4 ">
                @csrf

                <label for="horse_id" class="font-semibold text-blue-200">Caballo</label>
                <select name="horse_id" id="horse_id" class="select select-bordered w-full bg-blue-950 text-white">
                    <option disabled selected>Seleccione un caballo</option>
                    @foreach ($horses as $horse)
                        <option value="{{ $horse->id }}">{{ $horse->name }}</option>
                    @endforeach
                </select>

                <label for="visit_date" class="font-semibold text-blue-200">Fecha de Visita</label>
                <input type="date" name="visit_date" id="visit_date"
                    class="input input-bordered w-full bg-blue-950 text-white" required />

                <label for="vet_name" class="font-semibold text-blue-200">Veterinario</label>
                <input type="text" name="vet_name" id="vet_name" placeholder="Ej. Dr. Gómez"
                    class="input input-bordered w-full bg-blue-950 text-white placeholder:text-blue-400" required />

                <label for="vet_phone" class="font-semibold text-blue-200">Teléfono del Veterinario</label>
                <input type="text" name="vet_phone" id="vet_phone" placeholder="Ej. 1122334455"
                    class="input input-bordered w-full bg-blue-950 text-white placeholder:text-blue-400" />

                <label for="diagnosis" class="font-semibold text-blue-200">Diagnóstico</label>
                <textarea name="diagnosis" id="diagnosis" rows="3"
                    class="textarea textarea-bordered w-full bg-blue-950 text-white placeholder:text-blue-400"
                    placeholder="Ej. Revisión general, sin hallazgos..." required></textarea>

                <label for="treatment" class="font-semibold text-blue-200">Tratamiento</label>
                <textarea name="treatment" id="treatment" rows="3"
                    class="textarea textarea-bordered w-full bg-blue-950 text-white placeholder:text-blue-400"
                    placeholder="Ej. Ninguno necesario" required></textarea>

                <label for="next_visit" class="font-semibold text-blue-200">Próxima Visita (opcional)</label>
                <input type="date" name="next_visit" id="next_visit"
                    class="input input-bordered w-full bg-blue-950 text-white" />

                <div class="pt-4">
                    <button type="submit" class="btn bg-blue-600 hover:bg-blue-700 text-white font-bold w-full">
                        Guardar Visita
                    </button>
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
                <li class="mb-2"> <a href="{{ route('race.index') }}" class="btn btn-secondary ml-2">Carreras</a></li>
                <li class="mb-2"><a href="{{ route('expenses.index') }}" class="btn btn-info ml-2">Gastos</a></li>
                <li class="mb-2"><a href="{{ route('vet-visits.index') }}"
                        class="btn btn-warning ml-2">Veterinario</a>
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
