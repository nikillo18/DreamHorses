<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Resumen de Gastos - DreamHorses</title>
    <style>
        body {
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .mb-3 {
            margin-bottom: 15px;
        }

        .total-row {
            background-color: #f2f2f2;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="text-center mb-3">
        <h1>Resumen de Gastos</h1>
        <p>DreamHorses</p>
        <p>Fecha: {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Caballo</th>
                <th>Categoría</th>
                <th>Descripción</th>
                <th>Monto</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @forelse ($expenses as $expense)
                @php $total += $expense->amount; @endphp
                <tr>
                    <td>{{ \Carbon\Carbon::parse($expense->date)->format('d/m/Y') }}</td>
                    <td>{{ $expense->horse->name }}</td>
                    <td>{{ $expense->category }}</td>
                    <td>{{ $expense->description }}</td>
                    <td class="text-right">${{ number_format($expense->amount, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No hay gastos registrados.</td>
                </tr>
            @endforelse

            @if ($expenses->count() > 0)
                <tr class="total-row">
                    <td colspan="4" class="text-right">Total:</td>
                    <td class="text-right">${{ number_format($total, 2) }}</td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="text-center">
        <p>Este documento es un resumen generado automáticamente por el sistema DreamHorses.</p>
    </div>
</body>

</html>
