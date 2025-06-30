<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="{{ route('StoreHorse') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="text" name="name" placeholder="Nombre">
    <input type="text" name="breed" placeholder="Raza">
    <input type="text" name="color" placeholder="Color">

    <label for="photo">Foto del caballo:</label>
    <input type="file" name="photo" accept="image/*" class="file-input file-input-bordered" />

    <input type="date" name="birth_date" placeholder="Fecha de Nacimiento">
    <select name="gender" placeholder="Género">
        <option value="male">Macho</option>
        <option value="female">Hembra</option>
    </select>
    <input type="text" name="father_name" placeholder="Nombre del Padre">
    <input type="text" name="mother_name" placeholder="Nombre de la Madre">

    <select name="caretaker_id" id="caretaker_id">
        @foreach($caretakers as $caretaker)
            <option value="{{ $caretaker->id }}">{{ $caretaker->name }}</option>
        @endforeach
    </select>

    <button type="submit">Crear Caballo</button>
</form>

</body>
</html>