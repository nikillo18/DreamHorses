@vite('resources/css/app.css')
<div class="drawer lg:drawer-open">
  <input id="my-drawer" type="checkbox" class="drawer-toggle" />
  <label for="my-drawer" class="btn btn-primary drawer-button">Panel de control</label>
  <div class="drawer-content">
    <!-- Page content here -->
  </div>
  <div class="drawer-side">
    <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
    <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4">
      <!-- Sidebar content here -->
      <li><a href="{{ route('training.index') }}" class="btn btn-primary ml-2">Entrenamientos</a></li>
      <li> <a href="{{route('race.index')}}" class="btn btn-secondary ml-2">Carreras</a></li>
    </ul>
    
  </div>
</div>