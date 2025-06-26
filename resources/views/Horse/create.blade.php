<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="{{ route('StoreHorse') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Nombre">
    <input type="text" name="breed" placeholder="Raza">
    <input type="text" name="color" placeholder="Color">
    <input type="date" name="birthdate" placeholder="Fecha de Nacimiento">
    <select name="gender" placeholder="Género">
        <option value="male">Macho</option>
        <option value="female">Hembra</option>
    </select>
    <input type="text" name="father" placeholder="Nombre del Padre">
    <input type="text" name="mother" placeholder="Nombre de la Madre">
    <select name="caretaker" id="caretaker">
        @foreach($caretakers as $caretaker)
            <option value="{{ $caretaker->id }}">{{ $caretaker->name }}</option>
        @endforeach
    </select>

    <button type="submit">Crear Caballo</button>
</form>
</body>
</html>