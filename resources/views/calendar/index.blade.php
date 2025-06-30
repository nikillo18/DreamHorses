<!DOCTYPE html>
<html lang="en" data-theme="forest">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Eventos</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-base-200">
    <div class="container mx-auto p-4">
        <div class="mb-6">
            <h1 class="text-2xl sm:text-3xl font-bold text-primary text-center sm:text-left mb-2">
                Lista de Eventos
            </h1>
            <div class="flex justify-start">
                <form action="{{ route('calendar.create') }}" method="get">
                    <button type="submit" class="btn btn-success">Crear Evento</button>
                </form>
            </div>
        </div>
        <div class="overflow-x-auto rounded-lg shadow">
      <table class="table table-zebra w-full text-sm">
        <thead>
          <tr>
            <th>Titulo</th>
            <th>Caballo</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Tipo de Evento</th>
            <th>Descripción</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($events as $event)
            <tr>
              <td class="whitespace-nowrap">{{ $event->title }}</td>
              <td class="whitespace-nowrap">{{ $event->horse->name}}</td>
              <td class="whitespace-nowrap">{{ $event->event_date }}</td>
              <td class="whitespace-nowrap">{{ $event->event_time }}</td>
              <td class="whitespace-nowrap">{{ $event->category}}</td>
              <td class="max-w-xs break-words">{{ $event->description }}</td>
               <td class="flex flex-col sm:flex-row gap-2">
                <form action="{{ route('calendar.edit', $event) }}" method="get" style="display:inline;">
                  <button type="submit" class="btn btn-primary btn-xs w-full">Editar</button>
                </form>
                <form action="{{ route('calendar.destroy', $event) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-error btn-xs w-full" onclick="return confirm('¿Estás seguro de que deseas eliminar este evento?');">Eliminar</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
        </div>
    </div>
</body>
</html>