<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold text-green-200 flex items-center gap-2">
            🐴 Registrar Caballo
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto px-4">
            <form action="{{ route('StoreHorse') }}" method="POST" enctype="multipart/form-data"
                class="bg-green-950 text-white rounded-xl p-8 shadow-lg border border-green-800 space-y-4">
                @csrf

                {{-- Nombre --}}
                <label for="name" class="font-semibold text-green-100">Nombre</label>
                <input type="text" name="name" id="name" class="input input-bordered w-full bg-green-900 text-white placeholder:text-green-300" placeholder="Ej. Relámpago" />

                {{-- Raza --}}
                <label for="breed" class="font-semibold text-green-100">Raza</label>
                <input type="text" name="breed" id="breed" class="input input-bordered w-full bg-green-900 text-white placeholder:text-green-300" placeholder="Ej. Pura Sangre" />

                {{-- Color --}}
                <label for="color" class="font-semibold text-green-100">Color</label>
                <input type="text" name="color" id="color" class="input input-bordered w-full bg-green-900 text-white placeholder:text-green-300" placeholder="Ej. Castaño" />

                {{-- Foto --}}
                <label for="photo" class="font-semibold text-green-100">Foto del Caballo</label>
                <input type="file" name="photo" id="photo" class="file-input file-input-bordered w-full bg-green-900 text-white" />

                {{-- Fecha de nacimiento --}}
                <label for="birth_date" class="font-semibold text-green-100">Fecha de nacimiento</label>
                <input type="date" name="birth_date" id="birth_date" class="input input-bordered w-full bg-green-900 text-white" />

                {{-- Género --}}
                <label for="gender" class="font-semibold text-green-100">Género</label>
                <select name="gender" id="gender" class="select select-bordered w-full bg-green-900 text-white">
                    <option disabled selected>Seleccione género</option>
                    <option value="male">Macho</option>
                    <option value="female">Hembra</option>
                </select>

                {{-- Padre --}}
                <label for="father_name" class="font-semibold text-green-100">Padre</label>
                <input type="text" name="father_name" id="father_name" class="input input-bordered w-full bg-green-900 text-white placeholder:text-green-300" placeholder="Ej. Viento" />

                {{-- Madre --}}
                <label for="mother_name" class="font-semibold text-green-100">Madre</label>
                <input type="text" name="mother_name" id="mother_name" class="input input-bordered w-full bg-green-900 text-white placeholder:text-green-300" placeholder="Ej. Rayo" />

                {{-- Cuidador --}}
                <label for="caretaker_id" class="font-semibold text-green-100">Cuidador</label>
                <select name="caretaker_id" id="caretaker_id" class="select select-bordered w-full bg-green-900 text-white">
                    <option disabled selected>Seleccione cuidador</option>
                    @foreach($caretakers as $caretaker)
                        <option value="{{ $caretaker->id }}">{{ $caretaker->name }}</option>
                    @endforeach
                </select>

                {{-- Botón --}}
                <div class="pt-4">
                    <button type="submit" class="btn w-full bg-lime-600 hover:bg-lime-700 text-white text-lg font-bold">
                        ✅ Guardar Caballo
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
