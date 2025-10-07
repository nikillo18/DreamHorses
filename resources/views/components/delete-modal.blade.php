@props(['id', 'action', 'title' => 'Confirmar Eliminación', 'body' => '¿Estás seguro de que deseas eliminar este elemento? Esta acción no se puede deshacer.'])

<dialog id="{{ $id }}" class="modal">
  <div class="modal-box">
    <h3 class="font-bold text-lg">{{ $title }}</h3>
    <p class="py-4">{{ $body }}</p>
    <div class="modal-action">
      <form method="dialog">
        <button class="btn">Cancelar</button>
      </form>
      <form action="{{ $action }}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-error">Eliminar</button>
      </form>
    </div>
  </div>
  <form method="dialog" class="modal-backdrop">
    <button>close</button>
  </form>
</dialog>
