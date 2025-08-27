<x-guest-layout>
    <h2 class="text-2xl font-bold mb-6 text-center">Selecciona tu rol</h2>

    <div class="flex flex-col gap-4">
        <a href="{{ route('register', ['role' => 'boss']) }}" class="btn btn-primary">Jefe</a>
        <a href="{{ route('register', ['role' => 'caretaker']) }}" class="btn btn-secondary">Cuidador</a>
        <a href="{{ route('register', ['role' => 'veterinarian']) }}" class="btn btn-accent">Veterinario</a>
    </div>

    <div class="flex items-center justify-end mt-4">
        <a class="btn btn-link" href="{{ url('/') }}">
            {{ __('Volver') }}
        </a>
    </div>
</x-guest-layout>