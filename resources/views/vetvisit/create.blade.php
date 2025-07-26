<x-app-layout>
    <div class="max-w-3xl mx-auto p-6" data-theme="forest">
        <h2 class="text-2xl font-bold text-blue-400 mb-6">🩺 Registrar Visita Veterinaria</h2>

        <form action="{{ route('vet-visits.store') }}" method="POST" class="bg-gray-900 text-white p-6 rounded-xl shadow-md space-y-4 ">
            @csrf

            <label for="horse_id" class="font-semibold text-blue-200">Caballo</label>
            <select name="horse_id" id="horse_id" class="select select-bordered w-full bg-blue-950 text-white">
                <option disabled selected>Seleccione un caballo</option>
                @foreach ($horses as $horse)
                    <option value="{{ $horse->id }}">{{ $horse->name }}</option>
                @endforeach
            </select>

            <label for="visit_date" class="font-semibold text-blue-200">Fecha de Visita</label>
            <input type="date" name="visit_date" id="visit_date" class="input input-bordered w-full bg-blue-950 text-white" required />

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
            <input type="date" name="next_visit" id="next_visit" class="input input-bordered w-full bg-blue-950 text-white" />

            <div class="pt-4">
                <button type="submit" class="btn bg-blue-600 hover:bg-blue-700 text-white font-bold w-full">
                    Guardar Visita
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
