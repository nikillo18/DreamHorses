<x-guest-layout>
    <div class="mb-4 text-sm text-base-content/70">
        {{ __('¿Olvidaste tu contraseña? No hay problema. Simplemente déjanos saber tu dirección de correo electrónico y te enviaremos un enlace para restablecer la contraseña que te permitirá elegir una nueva.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="label">{{ __('Correo electrónico') }}</label>
            <input id="email" class="input input-bordered w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <button type="submit" class="btn btn-primary">
                {{ __('Enviar enlace de restablecimiento') }}
            </button>
        </div>
    </form>
</x-guest-layout>
