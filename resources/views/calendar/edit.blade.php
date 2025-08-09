<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Editar Evento</title>
    @vite('resources/css/app.css')
</head>

<body>
    <div>
        <h1 class="text-2xl sm:text-3xl font-bold text-primary text-center sm:text-left mb-2">
            Editar Evento
        </h1>
        <div class="mb-6">
            <div class="flex justify-start">
                <a href="{{ route('calendar.index') }}" class="btn btn-secondary">Volver a la Lista de Eventos</a>
            </div>

            <form action="{{ route('calendar.update', $calendarEvent->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')
                <div>
                    <label for="title" class="block text-sm font-medium">Título</label>
                    <input type="text" name="title" id="title" value="{{ $calendarEvent->title }}" required
                        class="input input-bordered w-full">
                </div>
                <fieldset class="fieldset">
                    <legend class="fieldset-legend">Caballos</legend>
                    <select class="select select-bordered w-full" name="horse_id" id="horse_id" required>
                        <option disabled selected>Elija un Caballo</option>
                        @foreach ($horse as $horses)
                            <option value="{{ $horses->id }}"
                                {{ $horses->id == $calendarEvent->horse_id ? 'selected' : '' }}>{{ $horses->name }}
                            </option>
                        @endforeach
                    </select>
                </fieldset>
                <fieldset>
                    <label for="event_date" class="block text-sm font-medium">Fecha del Evento</label>
                    <input type="date" name="event_date" id="event_date" value="{{ $calendarEvent->event_date }}"
                        required class="input input-bordered w-full">
                </fieldset>
                <fieldset>
                    <label for="event_time" class="block text-sm font-medium">Hora del Evento</label>
                    <input type="time" name="event_time" id="event_time"
                        value="{{ \Carbon\Carbon::parse($calendarEvent->event_time)->format('H:i') }}" required
                        class="input input-bordered w-full">
                </fieldset>
                <fieldset>
                    <label for="category" class="block text-sm font-medium">Tipo de Evento</label>
                    <input type="text" name="category" id="category" value="{{ $calendarEvent->category }}" required
                        class="input input-bordered w-full">
                </fieldset>
                <fieldset>
                    <label for="description" class="block text-sm font-medium">Descripción</label>
                    <textarea name="description" id="description" rows="3" class="textarea textarea-bordered w-full">{{ $calendarEvent->description }}</textarea>
                </fieldset>
                <button type="submit" class="btn btn-success">Actualizar Evento</button>
            </form>
        </div>
    </div>
</body>

</html>
