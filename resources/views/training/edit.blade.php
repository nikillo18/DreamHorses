<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Entrenamiento</title>
</head>
<body>
    <form action="{{ route('training.update', $training->id) }}" method="post">
        @csrf
        @method('PUT')
        
        <fieldset class="fieldset">
            <legend class="fieldset-legend">Caballos</legend>
            <select class="select" name="horse_id" id="horse_id" required>
                <option disabled selected>Elija un Caballo</option>
                @foreach($horse as $horses)
                    <option value="{{ $horses->id }}" {{ $horses->id == $training->horse_id ? 'selected' : '' }}>{{ $horses->name }}</option>
                @endforeach
            </select>
        </fieldset>

        <fieldset class="fieldset">
            <legend class="fieldset-legend">Fecha del Entrenamiento</legend>
            <input type="date" class="input" name="date" value="{{ $training->date }}" required />
        </fieldset>

        <fieldset class="fieldset">
            <legend class="fieldset-legend">Distancia</legend>
            <input type="number" class="input" name="distance" placeholder="Distancia Recorrida" value="{{ $training->distance }}" required />
        </fieldset>

        <fieldset class="fieldset">
            <legend class="fieldset-legend">Tiempo</legend>
            <input type="number" class="input" name="duration_minutes" placeholder="Tiempo" value="{{ $training->duration_minutes }}" required />
        </fieldset>

        <fieldset class="fieldset">
            <legend class="fieldset-legend">Comentarios</legend>
            <textarea class="textarea h-24" name="comments" placeholder="comentarios">{{ $training->comments }}</textarea>
        </fieldset>

        <button type="submit" class="btn">Actualizar</button>
    </form>
    <form action="{{ route('training.index') }}" method="get" style="display:inline;">
        <button type="submit" class="btn btn-secondary">Volver a la Lista</button>
    </form>
</body>
</html>