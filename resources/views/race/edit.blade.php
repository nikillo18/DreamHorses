<!DOCTYPE html>
<html lang="en" data-theme="forest">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Carrera</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-base-200">
    <div class="container mx-auto p-4">
        <h1 class="text-3xl font-bold mb-6 text-primary">Editar Carrera</h1>
        <a href="{{route('race.index')}}" class="btn btn-secondary ml-2">Volver a la Lista</a>
        <form action="{{route('race.update', $race->id)}}" method="post" class="space-y-4">
            @csrf
            @method('PUT')
            <fieldset class="fieldset">
            <legend class="fieldset-legend">Fecha de la Carrera</legend>
         <input type="date" class="input input-bordered w-full" name="date" value="{{$race->date}}"required />
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Caballos</legend>
                <select class="select select-bordered w-full" name="horse_id" id="horse_id" required>
                    <option disabled selected>Elija un Caballo</option>
                    @foreach($horse as $horses)
                        <option value="{{ $horses->id }}" {{ $horses->id == $race->horse_id ? 'selected' : '' }}>{{$horses->name}}</option>
                    @endforeach
                </select>
            </fieldset>
            
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Posicion</legend>
                <input type="number" class="input input-bordered w-full" name="place" placeholder="Posicion del Caballo" value="{{ $race->place }}" required />
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Distancia Recorrida</legend>
                <input type="number" class="input input-bordered w-full" name="distance" placeholder="Distancia Recorrida" value="{{ $race->distance }}" required />
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Descripcion de la Carrera</legend>
               <textarea class="textarea textarea-bordered h-24 w-full" name="description" placeholder="Descripcion de la Carrera">{{ $race->description }}</textarea>
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Jockey</legend>
                <input type="text" class="input input-bordered w-full" name="jockey" placeholder="Nombre del Jokey" value="{{ $race->jockey }}" required/>
            </fieldset>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</body>
</html>