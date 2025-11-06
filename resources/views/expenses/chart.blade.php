<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gráfico de Gastos - DreamHorses</title>
        <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('theme') === 'cupcake') {
            document.documentElement.setAttribute('data-theme', 'cupcake');
        } else {
            document.documentElement.setAttribute('data-theme', 'forest');
        }
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/theme.js'])
</head>

<body>
    <div class="drawer lg:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content bg-base-100 text-base-content">
        <!-- Hamburger button -->
        <label for="my-drawer" class="btn btn-primary drawer-button lg:hidden m-4 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </label>

        <!-- Main content -->
        <div class="p-6 md:p-8 max-w-4xl mx-auto space-y-6">
            <h2 class="text-3xl font-bold text-base-content mb-4">Gráficos de Gastos</h2>

            <x-session-alert />

            <div class="flex flex-col gap-6">
                <div class="bg-base-200 p-6 rounded-xl shadow-md">
                    <h3 class="text-xl font-bold text-base-content mb-4">Gastos Mensuales</h3>
                    <canvas id="expenseBarChart" data-labels='@json($monthLabels)'
                        data-data='@json($monthData)'></canvas>
                </div>
                <div class="bg-base-200 p-6 rounded-xl shadow-md">
                    <h3 class="text-xl font-bold text-base-content mb-4">Gastos por Categoría</h3>

                    <form action="{{ route('expenses.chart') }}" method="GET"
                        class="flex flex-wrap items-end gap-4 mb-4 p-4 bg-base-100 rounded-lg shadow-sm">
                        <div class="form-control">
                            <label for="start_month" class="label">
                                <span class="label-text font-semibold">Desde</span>
                            </label>
                            <select name="start_month" id="start_month" class="select select-bordered w-full max-w-xs">
                                @foreach ($availableMonths as $value => $label)
                                    <option value="{{ $value }}" {{ $startMonth == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('start_month')" class="mt-2" />
                        </div>
                        <div class="form-control">
                            <label for="end_month" class="label">
                                <span class="label-text font-semibold">Hasta</span>
                            </label>
                            <select name="end_month" id="end_month" class="select select-bordered w-full max-w-xs">
                                @foreach ($availableMonths as $value => $label)
                                    <option value="{{ $value }}" {{ $endMonth == $value ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('end_month')" class="mt-2" />
                        </div>
                        <button type="submit" class="btn btn-primary">Filtrar</button>
                    </form>

                    <canvas id="expensePieChart" data-labels='@json($categoryLabels)'
                        data-data='@json($categoryData)'></canvas>
                </div>
            </div>
        </div>
    </div>

    <x-sidebar />
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Bar Chart
        const barChartCanvas = document.getElementById('expenseBarChart');
        if (barChartCanvas) {
            const barCtx = barChartCanvas.getContext('2d');
            const monthLabels = JSON.parse(barChartCanvas.dataset.labels);
            const monthData = JSON.parse(barChartCanvas.dataset.data);

            const hasMonthData = monthData.length > 0 && monthData.reduce((a, b) => a + b, 0) > 0;

            if (hasMonthData) {
                new Chart(barCtx, {
                    type: 'bar',
                    data: {
                        labels: monthLabels,
                        datasets: [{
                            label: 'Total de Gastos Mensuales',
                            data: monthData,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return '$' + value;
                                    }
                                }
                            }
                        }
                    }
                });
            } else {
                const parent = barChartCanvas.parentElement;
                parent.innerHTML =
                    '<p class="text-center text-gray-500 py-8">No hay datos de gastos mensuales para mostrar.</p>';
            }
        }

        // Pie Chart
        const pieChartCanvas = document.getElementById('expensePieChart');
        if (pieChartCanvas) {
            const pieCtx = pieChartCanvas.getContext('2d');
            const categoryLabels = JSON.parse(pieChartCanvas.dataset.labels);
            const categoryData = JSON.parse(pieChartCanvas.dataset.data);

            const hasCategoryData = categoryData.length > 0 && categoryData.reduce((a, b) => a + b, 0) > 0;

            if (hasCategoryData) {
                new Chart(pieCtx, {
                    type: 'pie',
                    data: {
                        labels: categoryLabels,
                        datasets: [{
                            label: 'Gastos por Categoría',
                            data: categoryData,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        let label = context.label || '';
                                        if (label) {
                                            label += ': ';
                                        }
                                        if (context.parsed !== null) {
                                            label += new Intl.NumberFormat('es-ES', {
                                                style: 'currency',
                                                currency: 'ARS'
                                            }).format(context.parsed);
                                        }
                                        return label;
                                    }
                                }
                            }
                        }
                    }
                });
            } else {
                const parent = pieChartCanvas.parentElement;
                const p = document.createElement('p');
                p.className = 'text-center text-gray-500 py-8';
                p.textContent = 'No hay datos de gastos por categoría para mostrar en el período seleccionado.';
                // Replace the canvas with the message, leaving the form intact.
                parent.replaceChild(p, pieChartCanvas);
            }
        }
    });
</script>
</body>

</html>