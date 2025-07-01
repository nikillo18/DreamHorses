<x-app-layout>
    <div class="p-6 max-w-4xl mx-auto space-y-6">

        {{-- Notificación de éxito --}}
        @if(session('success'))
            <div class="alert alert-success shadow-md">
                {{ session('success') }}
            </div>
        @endif

        {{-- Card con datos --}}
        <div class="card bg-gray-800 text-white border border-green-800 shadow-xl p-6">
            <div class="flex flex-col md:flex-row gap-6">
                <div class="md:w-1/2">
                    <img
                        src="{{ $horse->photo_path ? asset('storage/' . $horse->photo_path) : 'https://via.placeholder.com/400x300?text=Sin+foto' }}"
                        alt="Foto de {{ $horse->name }}"
                        class="w-full h-80 object-cover rounded"
                    />
                </div>
                <div class="md:w-1/2 space-y-2">
                    <h2 class="text-2xl font-bold ">🐴 {{ $horse->name }}</h2>
                    <p><span class="text-green-400 font-semibold">Raza:</span> {{ $horse->breed }}</p>
                    <p><span class="text-green-400 font-semibold">Color:</span> {{ $horse->color }}</p>
                    <p><span class="text-green-400 font-semibold">Género:</span> {{ $horse->gender === 'male' ? 'Macho' : 'Hembra' }}</p>
                    <p><span class="text-green-400 font-semibold">Nacimiento:</span> {{ $horse->birth_date }}</p>
                    <p><span class="text-green-400 font-semibold">Padre:</span> {{ $horse->father_name }}</p>
                    <p><span class="text-green-400 font-semibold">Madre:</span> {{ $horse->mother_name }}</p>
                    <p><span class="text-green-400 font-semibold">Cuidador:</span> {{ $horse->caretaker->name ?? 'Sin cuidador' }}</p>
                </div>
            </div>
        </div>

        {{-- Botones --}}
        <div class="flex justify-between">
            <a href="{{ route('Horseindex') }}" class="btn btn-outline btn-sm">
                 Volver
            </a>

            <div class="flex gap-2">
                <a href="{{ route('horses.edit', $horse->id) }}" class="btn btn-warning btn-sm">
                    Editar
                </a>

                <form action="{{ route('horses.destroy', $horse->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este caballo?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-error btn-sm">
                        🗑️ Eliminar
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
