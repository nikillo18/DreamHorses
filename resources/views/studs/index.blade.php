@vite('resources/css/app.css', 'resources/js/app.js')

<div class="drawer lg:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content bg-base-100 text-base-content">
        <!-- Botón hamburguesa -->
        <label for="my-drawer"
            class="btn btn-primary drawer-button lg:hidden m-4 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </label>

        <!-- Contenido principal -->
        <div class="p-6 md:p-8">
            <h2 class="text-2xl sm:text-3xl font-bold text-base-content mb-6 flex items-center gap-2">
                Lista de Studs
            </h2>

            @role('caretaker')
                <div class="mb-4">
                    <a href="{{ route('studs.create') }}" class="btn btn-success font-bold shadow-sm">Crear nuevo Stud</a>
                </div>
            @endrole

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($studs as $stud)
                    <div class="card bg-base-200 shadow-xl">
                        <div class="card-body">
                            <h2 class="card-title text-primary">{{ $stud->name }}</h2>
                            <p><strong>Dirección:</strong> {{ $stud->address }}</p>
                            <p><strong>Teléfono:</strong> {{ $stud->phone }}</p>
                            <p><strong>Propietario:</strong> {{ $stud->owner->name }}</p>

                            <div class="card-actions justify-end mt-4 flex flex-wrap gap-2">
                                <a href="{{ route('studs.show', $stud->id) }}" class="btn btn-sm btn-info">Ver</a>

                                @role('caretaker|admin')
                                    @if(auth()->id() === $stud->owner_id)
                                        <a href="{{ route('studs.edit', $stud->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                        <form action="{{ route('studs.destroy', $stud->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este stud?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-error">Eliminar</button>
                                        </form>
                                    @endif
                                @endrole

                                @if(auth()->user()->hasRole('caretaker'))
                                    @php
                                        $isMember = $stud->caretakers->contains('id', auth()->id());
                                    @endphp
                                    @if(!$isMember)
                                        <form action="{{ route('studs.join', $stud->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success">Unirse</button>
                                        </form>
                                    @endif
                                @endif

                                @if(auth()->user()->hasRole('boss'))
                                    @php
                                        $isHired = auth()->user()->contractedStuds->contains($stud->id);
                                    @endphp

                                    @if(!$isHired)
                                        <form action="{{ route('studs.hire', $stud->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success">Contratar</button>
                                        </form>
                                    @else
                                        <form action="{{ route('studs.fire', $stud->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-error">Cancelar contrato</button>
                                        </form>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $studs->links() }}
            </div>
        </div>
    </div>

    <x-sidebar />
</div>
