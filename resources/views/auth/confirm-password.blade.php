<x-guest-layout>
    <div class="mb-4 text-sm text-base-content/70">
        {{ __('Esta es un área segura de la aplicación. Por favor, confirma tu contraseña antes de continuar.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <label for="password" class="label">{{ __('Contraseña') }}</label>
            <input id="password" class="input input-bordered w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit" class="btn btn-primary">
                {{ __('Confirmar') }}
            </button>
        </div>
    </form>
</x-guest-layout>
