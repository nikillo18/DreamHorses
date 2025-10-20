@vite('resources/css/app.css', 'resources/js/app.js')

<div class="drawer lg:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content bg-base-100 text-base-content">
        <!-- Botón hamburguesa -->
        <label for="my-drawer" class="btn btn-primary drawer-button lg:hidden m-4 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </label>

        <!-- Contenido principal -->
        <div class="p-6 md:p-8 max-w-4xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold">Crear Stud</h1>
                <a href="{{ route('studs.index') }}" class="btn btn-accent mt-4 sm:mt-0 shadow-sm">Volver a la Lista</a>
            </div>

            <form action="{{ route('studs.store') }}" method="POST"
                class="space-y-4 bg-base-200 p-6 rounded-xl shadow-md">
                @csrf

                <div class="form-control">
                    <label for="name" class="label">
                        <span class="label-text">Nombre del Stud</span>
                    </label>
                    <input type="text" name="name" id="name" class="input input-bordered w-full" required />
                </div>

                <div class="form-control">
                    <label for="address" class="label">
                        <span class="label-text">Dirección</span>
                    </label>
                    <input type="text" name="address" id="address" class="input input-bordered w-full" />
                </div>

                <div class="form-control">
                    <label for="phone" class="label">
                        <span class="label-text">Teléfono</span>
                    </label>
                    <input type="text" name="phone" id="phone" class="input input-bordered w-full" />
                </div>

                <div class="pt-4">
                    <button type="submit" class="btn btn-success w-full">Guardar Stud</button>
                </div>
            </form>
        </div>
    </div>

    <x-sidebar />
</div>
