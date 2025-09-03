<x-guest-layout>
    <h2 class="text-2xl font-bold mb-6 text-center text-primary">Selecciona tu rol</h2>

    <div class="flex flex-col gap-4">
        <a href="{{ route('register', ['role' => 'boss']) }}" class="btn btn-primary w-full">Jefe</a>
        <a href="{{ route('register', ['role' => 'caretaker']) }}" class="btn btn-secondary w-full">Cuidador</a>
        <a href="{{ route('register', ['role' => 'veterinarian']) }}" class="btn btn-accent w-full">Veterinario</a>
    </div>

    <div class="text-center mt-6">
        <a class="text-sm text-primary hover:underline" href="{{ url('/') }}">
            {{ __('Volver') }}
        </a>
    </div>
</x-guest-layout>
