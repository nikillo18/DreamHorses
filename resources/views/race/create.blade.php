<!DOCTYPE html>
<html lang="en" data-theme="forest">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear Nueva Carrera</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-base-200">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6 text-primary">Crear Carrera</h1>
         <a href="{{route('race.index')}}" class="btn btn-secondary ml-2">Volver a la Lista</a>
        <form action="{{route('race.store')}}" method="post" class="space-y-4">
            @csrf
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Fecha de la Carrera</legend>
                <input type="date" class="input input-bordered w-full" name="date" required  />
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Caballos</legend>
                <select class="select select-bordered w-full" name="horse_id" id="horse_id" required>
                    <option disabled selected>Elija un Caballo</option>
                    @foreach($horse as $horses)
                        <option value="{{$horses->id}}">{{$horses->name}}</option>
                    @endforeach
                </select>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Posición</legend>
                <input type="number" class="input input-bordered w-full" name="place" placeholder="Posición del Caballo" required />
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Distancia Recorrida</legend>
                <input type="number" class="input input-bordered w-full" name="distance" placeholder="Distancia Recorrida" required />
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Descripcion de la Carrera</legend>
                <textarea  class="textarea textarea-bordered h-24 w-full" name="description" placeholder="Descripcion" ></textarea>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Jockey</legend>
              <input type="text" class="input input-bordered w-full" name="jockey" placeholder="Nombre del Jokey" required/>
            </fieldset>
            <button type="submit" class="btn btn-success">Crear</button>
           
        </form>
    </div>
</body>
</html>