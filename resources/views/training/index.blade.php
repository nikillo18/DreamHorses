<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Entrenamientos</title>
</head>
<body>
    <h1>Lista de Entrenamientos</h1>
    <table>
        <thead>
            <tr>
                <th>Caballo</th>
                <th>Distancia </th>
                <th>Duracion</th>
                <th>Fecha</th>
                <th>Comentarios</th>
            </tr>
        </thead>
        <tbody>
            @foreach($training as $training)
                <tr>
                    <td>{{ $training->horse->name }}</td>
                    <td>{{ $training->distance }} km</td>
                    <td>{{ $training->duration_minutes }} minutos</td>
                    <td>{{ $training->date }}</td>
                    <td>{{ $training->comments }}</td>
                    <td>
                        <form action="{{ route('training.destroy', $training->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-error btn-sm">Eliminar</button>
            </form>
             <form action="{{ route('training.edit', $training->id) }}" method="get" style="display:inline;">
    <button type="submit" class="btn btn-primary">Editar</button>
</form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
 
 <form action="{{ route('training.create') }}" method="get" style="display:inline;">
    <button type="submit" class="btn btn-primary">Crear Entrenamiento</button>
</form>


</body>
</html>