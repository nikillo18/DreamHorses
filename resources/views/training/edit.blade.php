<!DOCTYPE html>
<html lang="en" data-theme="forest">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Entrenamiento</title>
   @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-base-200">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6 text-primary">Editar Entrenamiento</h1>
        <a href="{{ route('training.index') }}" class="btn btn-secondary ml-2">Volver a la Lista</a>
        <form action="{{ route('training.update', $training->id) }}" method="post" class="space-y-4">
            @csrf
            @method('PUT')
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Caballos</legend>
                <select class="select select-bordered w-full" name="horse_id" id="horse_id" required>
                    <option disabled selected>Elija un Caballo</option>
                    @foreach($horse as $horses)
                        <option value="{{ $horses->id }}" {{ $horses->id == $training->horse_id ? 'selected' : '' }}>{{ $horses->name }}</option>
                    @endforeach
                </select>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Fecha del Entrenamiento</legend>
                <input type="date" class="input input-bordered w-full" name="date" value="{{ $training->date }}" required />
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Distancia</legend>
                <input type="number" class="input input-bordered w-full" name="distance" placeholder="Distancia Recorrida" value="{{ $training->distance }}" required />
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Tiempo</legend>
                <input type="number" class="input input-bordered w-full" name="duration_minutes" placeholder="Tiempo" value="{{ $training->duration_minutes }}" required />
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Comentarios</legend>
                <textarea class="textarea textarea-bordered h-24 w-full" name="comments" placeholder="comentarios">{{ $training->comments }}</textarea>
            </fieldset>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</body>
</html>