@vite('resources/css/app.css')
@vite('resources/js/app.js')
<div class="drawer lg:drawer-open">
    <input id="my-drawer" type="checkbox" class="drawer-toggle" />
    <label for="my-drawer" class="btn btn-primary drawer-button">Panel</label>
    <div class="drawer-content">
        <h1 class="text-2xl font-bold mb-6 text-primary">Calendario de Eventos</h1>
        <calendar-date id="calendar" class="cally bg-base-100 border border-base-300 shadow-lg rounded-box mb-6">
            <svg aria-label="Previous" class="fill-current size-4" slot="previous" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24">
                <path fill="currentColor" d="M15.75 19.5 8.25 12l7.5-7.5"></path>
            </svg>
            <svg aria-label="Next" class="fill-current size-4" slot="next" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24">
                <path fill="currentColor" d="m8.25 4.5 7.5 7.5-7.5 7.5"></path>
            </svg>
            <calendar-month></calendar-month>
        </calendar-date>


    </div>
    <div class="drawer-side">
        <label for="my-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
        <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4">
            <li><a href="{{ route('dashboard') }}" class="btn btn-secondary ml-2">Panel</a></li>
            <li><a href="{{ route('training.index') }}" class="btn btn-primary ml-2">Entrenamientos</a></li>
            <li><a href="{{ route('race.index') }}" class="btn btn-secondary ml-2">Carreras</a></li>
        </ul>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const calendar = document.getElementById('calendar');
        const eventForm = document.getElementById('eventForm');
        const selectedDateInput = document.getElementById('selectedDate');

        calendar.addEventListener('date-selected', function(e) {

            selectedDateInput.value = e.detail.date;
            eventForm.style.display = 'block';
        })
    })
</script>
