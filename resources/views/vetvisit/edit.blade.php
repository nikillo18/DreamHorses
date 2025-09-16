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
            <h2 class="text-2xl font-bold text-base-content mb-6">
                Editar Visita Veterinaria
            </h2>
            <a href="{{ route('vet-visits.index') }}"
                class="btn btn-accent mt-4 sm:mt-0 shadow-sm">Volver
                a la Lista</a>
            <form action="{{ route('vet-visits.update', $vetVisit->id) }}" method="POST"
                class="space-y-4 bg-base-200 p-6 rounded-xl shadow-md">
                @csrf
                @method('PUT')

                <div>
                    <label for="horse_id" class="font-semibold text-base-content/80">Caballo</label>
                    <select name="horse_id" id="horse_id" required
                        class="select select-bordered w-full"
                        required>
                        @foreach ($horses as $horse)
                            <option value="{{ $horse->id }}"
                                {{ $vetVisit->horse_id == $horse->id ? 'selected' : '' }}>
                                {{ $horse->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="visit_date" class="font-semibold text-base-content/80">Fecha de
                        Visita</label>
                    <input type="date" name="visit_date" id="visit_date"
                        class="input input-bordered w-full"
                        value="{{ old('visit_date', $vetVisit->visit_date) }}" required>
                </div>

                <div>
                    <label for="vet_name" class="font-semibold text-base-content/80">Nombre del
                        Veterinario</label>
                    <input type="text" name="vet_name" id="vet_name"
                        class="input input-bordered w-full"
                        value="{{ old('vet_name', $vetVisit->vet_name) }}" required>
                </div>

                <div>
                    <label for="vet_phone" class="font-semibold text-base-content/80">Teléfono</label>
                    <input type="text" name="vet_phone" id="vet_phone"
                        class="input input-bordered w-full"
                        value="{{ old('vet_phone', $vetVisit->vet_phone) }}">
                </div>

                <div>
                    <label for="diagnosis" class="font-semibold text-base-content/80">Diagnóstico</label>
                    <textarea name="diagnosis" id="diagnosis"
                        class="textarea textarea-bordered w-full"
                        required>{{ old('diagnosis', $vetVisit->diagnosis) }}</textarea>
                </div>

                <div>
                    <label for="treatment" class="font-semibold text-base-content/80">Tratamiento</label>
                    <textarea name="treatment" id="treatment"
                        class="textarea textarea-bordered w-full"
                        required>{{ old('treatment', $vetVisit->treatment) }}</textarea>
                </div>

                <div>
                    <label for="next_visit" class="font-semibold text-base-content/80">Próxima
                        Visita</label>
                    <input type="date" name="next_visit" id="next_visit"
                        class="input input-bordered w-full"
                        value="{{ old('next_visit', $vetVisit->next_visit) }}">
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="btn btn-warning font-bold w-full shadow-sm">💾
                        Actualizar Visita</button>
                </div>
            </form>
        </div>
    </div>

    <x-sidebar />
</div>
