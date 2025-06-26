<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear Entrenamiento</title>
</head>
<body>
    <form action="{{route('training.store')}}" method="post">
        @csrf
                <fieldset class="fieldset">
        <legend class="fieldset-legend">Caballos</legend>
        <select class="select" name="horse_id" id="horse_id" required>
            <option disabled selected>Elija un Caballo</option>
            @foreach($horse as $horses)
                <option value="{{ $horses->id }}">{{ $horses->name }}</option>
            @endforeach
        </select>
    </fieldset>
            <fieldset class="fieldset">
  <legend class="fieldset-legend">Fecha del Entrenamiento</legend>
  <input type="date" class="input" name="date" required  />
  
        </fieldset>
            <fieldset class="fieldset">
    <legend class="fieldset-legend">distancia?</legend>
    <input type="number" class="input" name="distance" placeholder="Distancia Recorrida" required />
    
        </fieldset>

  </fieldset>
            <fieldset class="fieldset">
    <legend class="fieldset-legend">Tiempo?</legend>
    <input type="number" class="input" name="duration_minutes" placeholder="Tiempo" required/>
    
        </fieldset>

        <fieldset class="fieldset">
  <legend class="fieldset-legend">Comentarios</legend>
  <textarea class="textarea h-24" name="comments" placeholder="comentarios"></textarea>
</fieldset>

<button type="submit" class="btn">Crear</button>
    </form>
</body>
</html>