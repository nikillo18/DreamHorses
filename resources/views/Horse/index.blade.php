<x-app-layout>
    <div class="p-6" data-theme="forest">
        <h2 class="text-2xl font-bold text-green-400 mb-6 flex items-center gap-2">🐎 Listado de Caballos</h2>

        @if(session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($horses as $horse)
                <div class="card w-96 bg-gray-800 text-white border border-gray-700 shadow-md hover:shadow-lg transition">
                    <figure class="bg-gray-700">
                        <img
                         src="{{ $horse->photos->first() ? asset('storage/' . $horse->photos->first()->path) : ($horse->photo_path ? asset('storage/' . $horse->photo_path) : 'https://via.placeholder.com/300x200?text=Sin+foto') }}"
                        class="w-full h-48 object-cover rounded-t-lg"
                        />
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title">{{ $horse->name }}</h2>
                        <p><strong class="text-green-400">Cuidador:</strong> {{ $horse->caretaker->name ?? 'Sin cuidador' }}</p>
                        <div class="card-actions justify-end">
                            <a href="{{ route('horses.show', $horse->id) }}"
                               class="btn btn-sm bg-green-600 hover:bg-green-700 text-white font-semibold transition">
                                 Ver información
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
