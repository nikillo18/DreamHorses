<!DOCTYPE html>
<html>
<head>
    <title>Resumen de Gastos</title>
    <style>
        body {
            font-family: sans-serif;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .period {
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
        .total-row td {
            font-weight: bold;
            border-top: 2px solid #000;
        }
        .text-end {
            text-align: right;
        }
    </style>
</head>
<body>
    <h1>Resumen de Gastos</h1>

    @if ($fromMonth || $toMonth)
        <div class="period">
            <strong>Período:</strong>
            @if ($fromMonthFormatted)
                {{ $fromMonthFormatted }}
            @endif
            -
            @if ($toMonthFormatted)
                {{ $toMonthFormatted }}
            @endif
        </div>
    @endif

    @if ($monthlyCategorySummary->isNotEmpty())
        <table>
            <thead>
                <tr>
                    <th>Categoría</th>
                    <th class="text-end">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($monthlyCategorySummary as $item)
                    <tr>
                        <td>{{ $item->category }}</td>
                        <td class="text-end">${{ number_format($item->total_amount, 2) }}</td>
                    </tr>
                @endforeach
                <tr class="total-row">
                    <td><strong>Total general</strong></td>
                    <td class="text-end"><strong>${{ number_format($totalGeneral, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>
    @else
        <p>No hay datos para el período seleccionado.</p>
    @endif

</body>
</html>
