<x-app-layout>
    <div class="p-6">
        <h2 class="text-2xl font-bold mb-4">Listado de Caballos</h2>

        @if(session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($horses as $horse)
                <div class="card w-96 bg-base-100 shadow-md">
                   <figure>
                   <img
                    src="{{ $horse->photo_path ? asset('storage/' . $horse->photo_path) : 'https://via.placeholder.com/300x200?text=Sin+foto' }}"
                    alt="Caballo"
                    class="w-full h-50 object-cover rounded-t-lg"/>
                 </figure>
                    <div class="card-body">
                        <h2 class="card-title">{{ $horse->name }}</h2>
                        <p><strong>Cuidador:</strong> {{ $horse->caretaker->name ?? 'Sin cuidador' }}</p>
                        <div class="card-actions justify-end">
                        <a href="{{ route('horses.show', $horse->id) }}" class="btn btn-sm btn-primary">Ver informacion</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
