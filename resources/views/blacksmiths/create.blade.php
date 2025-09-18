@vite('resources/css/app.css', 'resources/js/app.js')

<div class="drawer lg:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content bg-base-100 text-base-content">
        <!-- Botón hamburguesa -->
        <label for="my-drawer"
            class="btn btn-primary drawer-button lg:hidden m-4 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </label>

        <!-- Contenido principal -->
        <div class="p-6 md:p-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
                <h1 class="text-3xl font-bold text-base-content"> Crear Herrado</h1>
                <a href="{{ route('blacksmiths.index') }}"
                    class="btn btn-accent mt-4 sm:mt-0 shadow-sm">Volver
                    a la Lista</a>
            </div>
            <form action="{{ route('blacksmiths.store') }}" method="post"
                class="space-y-4 bg-base-200 p-6 rounded-lg shadow-md">
                @csrf
                <fieldset class="fieldset">
                    <legend class="text-base-content/80">Caballos</legend>
                    <select
                        class="select select-bordered w-full"
                        name="horse_id" id="horse_id" required>
                        <option disabled selected>Elija un Caballo</option>
                        @foreach ($horse as $horses)
                            <option value="{{ $horses->id }}">{{ $horses->name }}</option>
                        @endforeach
                    </select>
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-base-content/80">Fecha del Herrado</legend>
                    <input type="date"
                        class="input input-bordered w-full"
                        name="date" required />
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-base-content/80">Nombre del Herrero</legend>
                    <input type="text"
                        class="input input-bordered w-full"
                        name="name" placeholder="Nombre del Herrero" required />
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="text-base-content/80">Tipo de Herradura</legend>
                    <input type="text"
                        class="input input-bordered w-full"
                        name="horseshoe" placeholder="Tipo de Herradura" required />
                </fieldset>
              
                <button type="submit"
                    class="btn btn-success font-bold w-full shadow-sm">Crear</button>
            </form>
        </div>
    </div>

    <!-- Menú lateral -->
  <x-sidebar />
</div>