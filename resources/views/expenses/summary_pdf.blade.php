<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Resumen de Gastos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            font-size: 24px;
        }

        .period {
            text-align: center;
            margin-bottom: 30px;
            font-size: 14px;
            color: #666;
        }

        .chart-container {
            text-align: center;
            margin: 30px 0;
            page-break-inside: avoid;
        }

        .chart-container img {
            max-width: 100%;
            height: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
        }

        th {
            background-color: #f2f2f2;
            text-align: left;
            font-weight: bold;
        }

        .total-row td {
            font-weight: bold;
            border-top: 2px solid #000;
            background-color: #e8e8e8;
        }

        .text-end {
            text-align: right;
        }

        .section-title {
            margin-top: 40px;
            margin-bottom: 15px;
            font-size: 18px;
            font-weight: bold;
            color: #333;
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
            @if ($fromMonthFormatted && $toMonthFormatted)
                -
            @endif
            @if ($toMonthFormatted)
                {{ $toMonthFormatted }}
            @endif
        </div>
    @endif

    @if (isset($chartImage) && $chartImage)
        <div class="chart-container">
            <h2 class="section-title">Distribución de Gastos por Categoría</h2>
            <img src="{{ $chartImage }}" alt="Gráfico de gastos por categoría" style="max-width: 600px;">
        </div>
    @endif

    @if ($monthlyCategorySummary->isNotEmpty())
        <h2 class="section-title">Detalle de Gastos por Categoría</h2>
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
        <p style="text-align: center; color: #666; margin-top: 30px;">
            No hay datos para el período seleccionado.
        </p>
    @endif
</body>

</html>
