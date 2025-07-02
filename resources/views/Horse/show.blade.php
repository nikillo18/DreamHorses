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
                {{-- Carrusel de fotos --}}
                <div class="md:w-1/2">
                    @if ($horse->photos->count())
                        <div class="carousel w-full rounded-lg overflow-hidden shadow">
                            @foreach ($horse->photos as $index => $photo)
                                <div id="slide{{ $index }}" class="carousel-item relative w-full">
                                    <img src="{{ asset('storage/' . $photo->path) }}" class="w-full h-80 object-cover" />
                                    <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/2">
                                        <a href="#slide{{ $index === 0 ? $horse->photos->count() - 1 : $index - 1 }}" class="btn btn-circle">❮</a>
                                        <a href="#slide{{ $index === $horse->photos->count() - 1 ? 0 : $index + 1 }}" class="btn btn-circle">❯</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <img src="{{ $horse->photo_path ? asset('storage/' . $horse->photo_path) : 'https://images.unsplash.com/photo-1615989275591-9fdbfe661ec1?q=80&w=1332&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D' }}"
                             class="w-full h-80 object-cover rounded" />
                    @endif
                </div>

                {{-- Datos del caballo --}}
                <div class="md:w-1/2 space-y-2">
                    <h2 class="text-2xl font-bold">🐴 {{ $horse->name }}</h2>
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
            <a href="{{ route('Horseindex') }}" class="btn btn-outline btn-sm">← Volver</a>
            <div class="flex gap-2">
                <a href="{{ route('horses.edit', $horse->id) }}" class="btn btn-warning btn-sm"> Modificar</a>
                <form action="{{ route('horses.destroy', $horse->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este caballo?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-error btn-sm"> Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
