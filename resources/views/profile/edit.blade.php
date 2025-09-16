@vite('resources/css/app.css', 'resources/js/app.js')
<div class="drawer lg:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
    <label for="my-drawer"
        class="btn btn-primary drawer-button lg:hidden m-4 shadow-md">Panel</label>
    <div class="drawer-content bg-base-100 text-base-content">
        <div class="container mx-auto p-4">
            <h2 class="text-3xl font-bold mb-6 text-primary">Perfil de Usuario</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="card bg-base-200 shadow-md p-4">
                    <div class="card-body">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
                <div class="card bg-base-200 shadow-md p-4">
                    <div class="card-body">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
                <div class="card bg-base-200 shadow-md p-4">
                    <div class="card-body">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-sidebar />
</div>
