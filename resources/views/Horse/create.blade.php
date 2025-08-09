@vite('resources/css/app.css', 'resources/js/app.js')
<div class="drawer lg:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />

    <div class="drawer-content p-4 md:p-8">
        <!-- Page content here -->
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Crear Caballo</title>
        </head>

        <body>
            <x-slot name="header">
                <h2 class="text-2xl font-bold text-primary text-center mb-4">
                    🐴 Registrar Caballo
                </h2>
            </x-slot>

            <div class="container mx-auto px-4 py-6">
                <div class="max-w-3xl mx-auto bg-base-100 p-8 rounded-xl shadow-lg  space-y-6">
                    <form action="{{ route('StoreHorse') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <label for="name" class="label">
                                <span class="label-text text-primary font-semibold">Nombre</span>
                            </label>
                            <input type="text" name="name" id="name"
                                class="input input-bordered w-full bg-base-200 text-white"
                                placeholder="Ej. Relámpago" />
                        </div>

                        <div>
                            <label for="breed" class="label">
                                <span class="label-text text-primary font-semibold">Raza</span>
                            </label>
                            <input type="text" name="breed" id="breed"
                                class="input input-bordered w-full bg-base-200 text-white"
                                placeholder="Ej. Pura Sangre" />
                        </div>

                        <div>
                            <label for="color" class="label">
                                <span class="label-text text-primary font-semibold">Color</span>
                            </label>
                            <input type="text" name="color" id="color"
                                class="input input-bordered w-full bg-base-200 text-white" placeholder="Ej. Castaño" />
                        </div>

                        <div>
                            <label for="photos" class="label">
                                <span class="label-text text-primary font-semibold">Fotos del Caballo</span>
                            </label>
                            <input type="file" name="photos[]" id="photos" multiple accept="image/*"
                                class="file-input file-input-bordered w-full bg-base-200 text-white" />
                        </div>

                        <div>
                            <label for="number_microchip" class="label">
                                <span class="label-text text-primary font-semibold">Número de Microchip</span>
                            </label>
                            <input type="text" name="number_microchip" id="number_microchip"
                                class="input input-bordered w-full bg-base-200 text-white"
                                placeholder="Ej. 1234567AJF" />
                        </div>

                        <div>
                            <label for="birth_date" class="label">
                                <span class="label-text text-primary font-semibold">Fecha de nacimiento</span>
                            </label>
                            <input type="date" name="birth_date" id="birth_date"
                                class="input input-bordered w-full bg-base-200 text-white" />
                        </div>

                        <div>
                            <label for="gender" class="label">
                                <span class="label-text text-primary font-semibold">Género</span>
                            </label>
                            <select name="gender" id="gender"
                                class="select select-bordered w-full bg-base-200 text-white">
                                <option disabled selected>Seleccione género</option>
                                <option value="male">Macho</option>
                                <option value="female">Hembra</option>
                            </select>
                        </div>

                        <div>
                            <label for="father_name" class="label">
                                <span class="label-text text-primary font-semibold">Padre</span>
                            </label>
                            <input type="text" name="father_name" id="father_name"
                                class="input input-bordered w-full bg-base-200 text-white" placeholder="Ej. Viento" />
                        </div>

                        <div>
                            <label for="mother_name" class="label">
                                <span class="label-text text-primary font-semibold">Madre</span>
                            </label>
                            <input type="text" name="mother_name" id="mother_name"
                                class="input input-bordered w-full bg-base-200 text-white" placeholder="Ej. Rayo" />
                        </div>

                        <div>
                            <label for="caretaker_id" class="label">
                                <span class="label-text text-primary font-semibold">Cuidador</span>
                            </label>
                            <select name="caretaker_id" id="caretaker_id"
                                class="select select-bordered w-full bg-base-200 text-white">
                                <option disabled selected>Seleccione cuidador</option>
                                @foreach ($caretakers as $caretaker)
                                    <option value="{{ $caretaker->id }}">{{ $caretaker->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="pt-4">
                            <button type="submit"
                                class="btn w-full bg-primary hover:bg-primary-focus text-white text-lg font-bold">
                                Guardar Caballo
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </body>

        </html>
        <div class="drawer-side">
            <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4">
                <!-- Sidebar content here -->
                <li class="mb-2"><a href="{{ route('training.index') }}"
                        class="btn btn-primary ml-2">Entrenamientos</a>
                </li>
                <li class="mb-2"> <a href="{{ route('race.index') }}" class="btn btn-secondary ml-2">Carreras</a>
                </li>
                <li class="mb-2"><a href="{{ route('expenses.index') }}" class="btn btn-info ml-2">Gastos</a></li>
                <li class="mb-2"><a href="{{ route('vet-visits.index') }}"
                        class="btn btn-warning ml-2">Veterinario</a>
                </li>
                <li class="mb-2"><a href="{{ route('Horseindex') }}" class="btn btn-secondary ml-2">Caballos</a>
                </li>
                <li class="mb-4"><a href="{{ route('calendar.index') }}"
                        class="btn btn-secondary ml-2">Calendario</a>
                </li>

            </ul>
            <div class="flex justify-center items-center mt-4 space-x-2">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-error w-32">Cerrar sesión</button>
                </form>
                <form method="GET" action="{{ route('profile.edit') }}">
                    @csrf
                    <button type="submit" class="btn btn-secondary w-32">Ver perfil</button>
                </form>
            </div>

        </div>
    </div>
