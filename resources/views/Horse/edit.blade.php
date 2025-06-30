<x-app-layout>
    <div class="max-w-3xl mx-auto p-6">
        <h2 class="text-2xl font-bold mb-4">Editar Caballo: {{ $horse->name }}</h2>

        <form action="{{ route('horses.update', $horse->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <input type="text" name="name" value="{{ old('name', $horse->name) }}" placeholder="Nombre" class="input input-bordered w-full" />
            <input type="text" name="breed" value="{{ old('breed', $horse->breed) }}" placeholder="Raza" class="input input-bordered w-full" />
            <input type="text" name="color" value="{{ old('color', $horse->color) }}" placeholder="Color" class="input input-bordered w-full" />
            <input type="date" name="birth_date" value="{{ old('birth_date', $horse->birth_date) }}" class="input input-bordered w-full" />

            <select name="gender" class="select select-bordered w-full">
                <option value="male" {{ $horse->gender == 'male' ? 'selected' : '' }}>Macho</option>
                <option value="female" {{ $horse->gender == 'female' ? 'selected' : '' }}>Hembra</option>
            </select>

            <input type="text" name="father_name" value="{{ old('father_name', $horse->father_name) }}" placeholder="Padre" class="input input-bordered w-full" />
            <input type="text" name="mother_name" value="{{ old('mother_name', $horse->mother_name) }}" placeholder="Madre" class="input input-bordered w-full" />

            <select name="caretaker_id" class="select select-bordered w-full">
                @foreach($caretakers as $caretaker)
                    <option value="{{ $caretaker->id }}" {{ $horse->caretaker_id == $caretaker->id ? 'selected' : '' }}>
                        {{ $caretaker->name }}
                    </option>
                @endforeach
            </select>

            <label>Foto actual:</label>
            <img src="{{ $horse->photo_path ? asset('storage/' . $horse->photo_path) : 'https://via.placeholder.com/300x200?text=Sin+foto' }}" class="w-48 h-32 object-cover rounded">

            <label>Nueva foto (opcional):</label>
            <input type="file" name="photo" accept="image/*" class="file-input file-input-bordered w-full" />

            <button type="submit" class="btn btn-primary">Actualizar Caballo</button>
        </form>
    </div>
</x-app-layout>
