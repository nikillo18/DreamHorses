<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Entrenamientos - DreamHorses</title>
        <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('theme') === 'cupcake') {
            document.documentElement.setAttribute('data-theme', 'cupcake');
        } else {
            document.documentElement.setAttribute('data-theme', 'forest');
        }
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/theme.js'])
</head>

<body>
    <div class="drawer lg:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content bg-base-100 text-base-content" x-data>
        <!-- Botón hamburguesa -->
        <label for="my-drawer" class="btn btn-primary drawer-button lg:hidden m-4 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </label>

        <!-- Contenido principal -->
        <div class="p-6 md:p-8">
            <div class="mb-6">
                <h1 class="text-2xl sm:text-3xl font-bold text-base-content text-center sm:text-left mb-2">
                    Lista de Entrenamientos
                </h1>
                <x-session-alert />
                @role('caretaker|admin')
                    <div class="flex justify-start">
                        <a href="{{ route('training.create') }}" class="btn btn-success font-bold shadow-sm">Crear
                            Entrenamiento</a>
                    </div>
                @endrole
                 <div class="p-6 md:p-2">
                 @if($horseId)
        <a href="{{ route('horses.show', $horseId) }}" 
           class="btn btn-sm btn-secondary mb-4">⬅ Volver al caballo</a>
    @endif
    </div>
            </div>
            <div class="overflow-x-auto rounded-lg shadow-lg">
                <table class="table-auto w-full text-sm text-left bg-base-200 text-base-content">
                    <thead class="bg-base-300 text-base-content">
                        <tr>
                            <th class="p-4">Caballo</th>
                            <th class="p-4">Distancia</th>
                            <th class="p-4">Duración</th>
                            <th class="p-4">Fecha</th>
                            <th class="p-4">Entrenamiento</th>
                            <th class="p-4">Comentarios</th>
                            @role('caretaker|admin')
                                <th class="p-4">Acciones</th>
                            @endrole
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($training as $training)
                            <tr class="border-b border-base-300 hover:bg-base-300">
                                <td class="p-4 whitespace-nowrap">{{ $training->horse->name }}</td>
                                <td class="p-4 whitespace-nowrap">{{ $training->distance }} km</td>
                                <td class="p-4 whitespace-nowrap">{{ $training->duration_minutes }} minutos</td>
                                <td class="p-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($training->date)->format('d/m/Y') }}</td>
                                <td class="p-4 whitespace-nowrap">{{ $training->type_training }}</td>
                                <td class="p-4 max-w-xs break-words">{{ $training->comments }}</td>
                                <td class="p-4 flex flex-col md:flex-row gap-2">
                                    @role('caretaker|admin')
                                        <a href="{{ route('training.edit', $training->id) }}"
                                            class="btn btn-xs btn-warning">Editar</a>
                                        <div>
                                            <button class="btn btn-xs btn-error" onclick="document.getElementById('modal_training_{{ $training->id }}').showModal()">Eliminar</button>
                                            <x-delete-modal :id="'modal_training_' . $training->id" :action="route('training.destroy', $training->id)" />
                                        </div>
                                    @endrole
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-sidebar />


</div>
</body>

</html>