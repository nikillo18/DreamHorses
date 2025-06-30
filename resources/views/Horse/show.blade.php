<x-app-layout>
    <div class="p-6 max-w-4xl mx-auto space-y-6">

        {{-- Notificación de éxito --}}
        @if(session('success'))
            <div class="alert alert-success shadow-md">
                {{ session('success') }}
            </div>
        @endif

        {{-- Card con datos --}}
        <div class="card bg-base-100 shadow-xl p-6">
            <div class="flex flex-col md:flex-row gap-6">
                <div class="md:w-1/2">
                    <img
                        src="{{ $horse->photo_path ? asset('storage/' . $horse->photo_path) : 'https://via.placeholder.com/400x300?text=Sin+foto' }}"
                        alt="Foto de {{ $horse->name }}"
                        class="w-full h-100 object-cover rounded"
                    />
                </div>
                <div class="md:w-1/2 space-y-2">
                    <h2 class="text-2xl font-bold">{{ $horse->name }}</h2>
                    <p><strong>Raza:</strong> {{ $horse->breed }}</p>
                    <p><strong>Color:</strong> {{ $horse->color }}</p>
                    <p><strong>Género:</strong> {{ $horse->gender }}</p>
                    <p><strong>Fecha de Nacimiento:</strong> {{ $horse->birth_date }}</p>
                    <p><strong>Padre:</strong> {{ $horse->father_name }}</p>
                    <p><strong>Madre:</strong> {{ $horse->mother_name }}</p>
                    <p><strong>Cuidador:</strong> {{ $horse->caretaker->name ?? 'Sin cuidador' }}</p>
                    
                </div>
            </div>
        </div>

        {{-- Botones --}}
        <div class="flex justify-between">
            <a href="{{ route('Horseindex') }}" class="btn btn-outline">← Volver</a>

            <div class="flex gap-2">
                <a href="{{ route('horses.edit', $horse->id) }}" class="btn btn-warning btn-sm">
                    Editar
                </a>

                <form action="{{ route('horses.destroy', $horse->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este caballo?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-error btn-sm">
                        Eliminar
                    </button>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>
