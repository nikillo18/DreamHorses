<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Ficha de {{ $horse->name }}</title>
    <style>
        body { font-family: sans-serif; margin: 25px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 24px; color: #333; }
        .horse-photo { text-align: center; margin-bottom: 20px; }
        .horse-photo img { max-width: 100%; height: auto; max-height: 250px; border-radius: 8px; border: 1px solid #ddd; }
        .section { margin-top: 25px; page-break-inside: avoid; }
        .section h2 { font-size: 18px; color: #333; border-bottom: 1px solid #ccc; padding-bottom: 5px; margin-bottom: 10px; }
        ul { list-style-type: none; padding: 0; }
        li { background-color: #f9f9f9; padding: 10px; border-radius: 4px; margin-bottom: 6px; border-left: 3px solid #007bff; }
        .total-expenses { font-size: 18px; font-weight: bold; color: #28a745; margin-top: 10px; }
        .no-data { color: #777; background-color: transparent; border-left: none; padding: 5px 0; }
        .badge { display: inline-block; padding: 3px 8px; font-size: 11px; font-weight: bold; border-radius: 10px; color: #fff; margin-right: 8px; }
        .badge-primary { background-color: #007bff; }
        .badge-info { background-color: #17a2b8; }
        .badge-danger { background-color: #dc3545; }
        table.details-table { width: 100%; border-spacing: 0; }
        table.details-table td { padding: 8px; border: 1px solid #eee; }
        table.details-table strong { color: #333; }
    </style>
</head>
<body>

    <div class="header">
        <h1>Ficha del Caballo: {{ $horse->name }}</h1>
    </div>

    <div class="horse-photo">
        @php
            $photoPath = $horse->photos->first()->path ?? $horse->photo_path;
            $finalImageSrc = null;

            if ($photoPath && Illuminate\Support\Facades\Storage::disk('public')->exists($photoPath)) {
                $absolutePath = Illuminate\Support\Facades\Storage::disk('public')->path($photoPath);
                $type = pathinfo($absolutePath, PATHINFO_EXTENSION);
                $data = file_get_contents($absolutePath);
                $finalImageSrc = 'data:image/' . $type . ';base64,' . base64_encode($data);
            } else {
                // Fallback to default image
                $absolutePath = public_path('images/default.png');
                $type = pathinfo($absolutePath, PATHINFO_EXTENSION);
                $data = file_get_contents($absolutePath);
                $finalImageSrc = 'data:image/' . $type . ';base64,' . base64_encode($data);
            }
        @endphp
        <img src="{{ $finalImageSrc }}" alt="Foto de {{ $horse->name }}">
    </div>

    <div class="section">
        <h2>Datos del Caballo</h2>
        <table class="details-table">
            <tr>
                <td><strong>Raza:</strong> {{ $horse->breed }}</td>
                <td><strong>Color:</strong> {{ $horse->color }}</td>
            </tr>
            <tr>
                <td><strong>Nacimiento:</strong> {{ \Carbon\Carbon::parse($horse->birth_date)->format('d/m/Y') }}</td>
                <td><strong>Género:</strong> {{ $horse->gender === 'male' ? 'Macho' : 'Hembra' }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h2>Eventos Próximos</h2>
        <ul>
            @forelse ($events as $event)
                @php
                    $badgeClass = 'badge-info';
                    if ($event->category === 'Carrera') {
                        $badgeClass = 'badge-primary';
                    } elseif ($event->category === 'Visita Veterinaria') {
                        $badgeClass = 'badge-primary';
                    }
                @endphp
                <li>
                    <span class="badge {{ $badgeClass }}">{{ $event->category }}</span>
                    <strong>{{ \Carbon\Carbon::parse($event->event_date)->format('d/m/Y') }}</strong> - {{ $event->title }}
                </li>
            @empty
                <li class="no-data">No hay eventos próximos.</li>
            @endforelse
        </ul>
    </div>

    <div class="section">
        <h2>Alertas (Próximos 7 días)</h2>
        <ul>
            @forelse ($alerts as $alert)
                <li>
                    <span class="badge badge-danger">{{ $alert->category }}</span>
                    <strong>{{ \Carbon\Carbon::parse($alert->event_date)->locale('es')->diffForHumans() }}</strong> - {{ $alert->title }}
                </li>
            @empty
                <li class="no-data">No hay alertas.</li>
            @endforelse
        </ul>
    </div>

    <div class="section">
        <h2>Resumen de Gastos</h2>
        <p class="total-expenses">Total Acumulado: ${{ number_format($totalExpenses ?? 0, 2) }}</p>
    </div>

</body>
</html>
