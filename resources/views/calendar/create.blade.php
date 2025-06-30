<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear Nuevo Evento</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl sm:text-3xl font-bold text-primary text-center sm:text-left mb-2">
            Crear Nuevo Evento
        </h1>
        <div class="mb-6">
            <div class="flex justify-start">
                <form action="{{ route('calendar.index') }}" method="get">
                    <button type="submit" class="btn btn-secondary">Volver a la Lista de Eventos</button>
                </form>
            </div>
        </div>
        <form action="{{ route('calendar.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="title" class="block text-sm font-medium">Título</label>
                <input type="text" name="title" id="title" required class="input input-bordered w-full">
            </div>
        <fieldset class="fieldset">
                <legend class="fieldset-legend">Caballos</legend>
                <select class="select select-bordered w-full" name="horse_id" id="horse_id" required>
                    <option disabled selected>Elija un Caballo</option>
                    @foreach($horse as $horses)
                        <option value="{{$horses->id}}">{{$horses->name}}</option>
                    @endforeach
                </select>
            </fieldset>
          <fieldset>
            <label for="event_date" class="block text-sm font-medium">Fecha del Evento</label>
            <input type="date" name="event_date" id="event_date" required class="input input-bordered w-full">
          </fieldset>
          <fieldset>
            <label for="event_time" class="block text-sm font-medium">Hora del Evento</label>
            <input type="time" name="event_time" id="event_time" required class="input input-bordered w-full">
          </fieldset>
          <fieldset>
              <label for="category" class="block text-sm font-medium">Tipo de Evento</label>
              <input type="text" name="category" id="category" required class="input input-bordered w-full">
          </fieldset>
          <fieldset>
              <label for="description" class="block text-sm font-medium">Descripción</label>
              <textarea name="description" id="description" rows="3" class="textarea textarea-bordered w-full"></textarea>
          </fieldset>
            <button type="submit" class="btn btn-success">Crear Evento</button>
        </form>
    </div>
    
</body>
</html>