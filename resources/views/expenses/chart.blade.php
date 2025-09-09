@vite('resources/css/app.css', 'resources/js/app.js')

<div class="drawer lg:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content bg-base-100 text-base-content">
        <!-- Hamburger button -->
        <label for="my-drawer"
            class="btn btn-primary drawer-button lg:hidden m-4 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </label>

        <!-- Main content -->
        <div class="p-6 md:p-8 max-w-6xl mx-auto space-y-6">
            <h2 class="text-3xl font-bold text-base-content mb-4">Gráficos de Gastos</h2>

            <div class="flex flex-col gap-6">
                <div class="bg-base-200 p-6 rounded-xl shadow-md">
                    <h3 class="text-xl font-bold text-base-content mb-4">Gastos Mensuales</h3>
                    <canvas id="expenseBarChart" data-labels='@json($monthLabels)' data-data='@json($monthData)'></canvas>
                </div>
                <div class="bg-base-200 p-6 rounded-xl shadow-md">
                    <h3 class="text-xl font-bold text-base-content mb-4">Gastos por Categoría</h3>
                    <canvas id="expensePieChart" data-labels='@json($categoryLabels)' data-data='@json($categoryData)'></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="drawer-side">
        <label for="my-drawer" class="drawer-overlay"></label>
        <ul
            class="menu bg-base-200 min-h-screen w-64 p-4 flex flex-col gap-4 text-base-content">
            <div>
                <li class="mb-2"><a href="{{ route('dashboard') }}"
                        class="btn btn-primary w-full text-left">
                        Panel principal</a>
                </li>
                <h3 class="text-base-content/70 text-sm font-semibold">Control</h3>
                <li class="mb-2"><a href="{{ route('training.index') }}"
                        class="btn btn-primary w-full text-left">
                        Entrenamientos</a></li>
                <li class="mb-2"><a href="{{ route('Horseindex') }}"
                        class="btn btn-primary w-full text-left">
                        Caballos</a></li>
                <li class="mb-2"><a href="{{ route('calendar.index') }}"
                        class="btn btn-primary w-full text-left">
                        Eventos</a></li>
                @role('boss')
                    <li><a href="{{ route('caretakers.index') }}"
                            class="btn btn-primary w-full text-left">
                            Cuidadores</a></li>
                @endrole
            </div>
            <div class="divider"></div>
            <div>
                <h3 class="text-base-content/70 text-sm font-semibold">Gestión</h3>
                <li class="mb-2"><a href="{{ route('race.index') }}"
                        class="btn btn-secondary w-full text-left">
                        Carreras</a></li>
                <li class="mb-2"><a href="{{ route('expenses.index') }}"
                        class="btn btn-secondary w-full text-left">
                        Gastos</a></li>
                <li class="mb-2"><a href="{{ route('expenses.chart') }}"
                        class="btn btn-secondary w-full text-left">
                        Gráfico de Gastos</a></li>
                <li class="mb-2"><a href="{{ route('vet-visits.index') }}"
                        class="btn btn-secondary w-full text-left">
                        Veterinario</a></li>
            </div>


            <div class="mt-auto space-y-2">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="btn btn-error w-full">
                        Cerrar sesión</button>
                </form>
                <form method="GET" action="{{ route('profile.edit') }}">
                    <button type="submit"
                        class="btn btn-info w-full">
                        Ver perfil</button>
                </form>
            </div>
        </ul>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Bar Chart
        const barChartCanvas = document.getElementById('expenseBarChart');
        if (barChartCanvas) {
            const barCtx = barChartCanvas.getContext('2d');
            const monthLabels = JSON.parse(barChartCanvas.dataset.labels);
            const monthData = JSON.parse(barChartCanvas.dataset.data);

            if (monthData.length > 0) {
                const expenseBarChart = new Chart(barCtx, {
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
                                    callback: function(value, index, values) {
                                        return '$' + value;
                                    }
                                }
                            }
                        }
                    }
                });
            } else {
                barChartCanvas.parentElement.innerHTML += '<p>No hay datos de gastos mensuales para mostrar.</p>';
                barChartCanvas.style.display = 'none';
            }
        }

        // Pie Chart
        const pieChartCanvas = document.getElementById('expensePieChart');
        if (pieChartCanvas) {
            const pieCtx = pieChartCanvas.getContext('2d');
            const categoryLabels = JSON.parse(pieChartCanvas.dataset.labels);
            const categoryData = JSON.parse(pieChartCanvas.dataset.data);

            if (categoryData.length > 0) {
                const expensePieChart = new Chart(pieCtx, {
                    type: 'pie',
                    data: {
                        labels: categoryLabels,
                        datasets: [{
                            label: 'Gastos por Categoría',
                            data: categoryData,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
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
                                            label += new Intl.NumberFormat('es-ES', { style: 'currency', currency: 'USD' }).format(context.parsed);
                                        }
                                        return label;
                                    }
                                }
                            }
                        }
                    }
                });
            } else {
                pieChartCanvas.parentElement.innerHTML += '<p>No hay datos de gastos por categoría para mostrar.</p>';
                pieChartCanvas.style.display = 'none';
            }
        }
    });
</script>