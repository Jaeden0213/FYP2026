<x-app-layout>
    <div class="container">
        <h1 class="page-title">User Growth Statistics</h1>

        <!-- Summary Cards -->
        <div class="cards">
            <div class="card">
                <h2>Total Students</h2>
                <p>{{ $totalStudents }}</p>
            </div>
            <div class="card">
                <h2>Weekly Registrations</h2>
                <p>{{ $weeklyStudents }}</p>
            </div>
            <div class="card">
                <h2>Monthly Registrations</h2>
                <p>{{ $monthlyStudents }}</p>
            </div>
            <div class="card">
                <h2>Yearly Registrations</h2>
                <p>{{ $yearlyStudents }}</p>
            </div>
        </div>

        <!-- Graph Section -->
        <h2 class="section-title">Trends</h2>
        <div class="graphs">
            <div class="graph-card">
                <h3>Registrations Over Time</h3>
                <canvas id="registrationGraph"></canvas>
            </div>

            <div class="graph-card">
                <h3>Student Growth by Month</h3>
                <canvas id="growthGraph"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    // Bar chart: registrations over the last 7 days
    const registrationData = {
        labels: @json($last7Days->pluck('date')),
        datasets: [{
            label: 'New Students',
            data: @json($last7Days->pluck('count')),
            backgroundColor: 'rgba(0,123,255,0.5)',
            borderColor: 'rgba(0,123,255,1)',
            borderWidth: 1
        }]
    };

    const growthData = {
        labels: @json($last12Months->pluck('month')),
        datasets: [{
            label: 'Monthly Registrations',
            data: @json($last12Months->pluck('count')),
            fill: false,
            borderColor: 'rgba(255,99,132,1)',
            tension: 0.3
        }]
    };

    const options = {
        responsive: true,
        plugins: {
            legend: { display: true }
        },
        scales: {
            y: { beginAtZero: true }
        }
    };

    // ✅ Render the charts
    const registrationCtx = document.getElementById('registrationGraph').getContext('2d');
    new Chart(registrationCtx, {
        type: 'bar',
        data: registrationData,
        options: options
    });

    const growthCtx = document.getElementById('growthGraph').getContext('2d');
    new Chart(growthCtx, {
        type: 'line',
        data: growthData,
        options: options
    });
</script>



    <style>
        /* Container */
        .container { max-width: 1200px; margin: 40px auto; padding: 0 20px; font-family: 'Segoe UI', sans-serif; }
        .page-title { text-align: center; font-size: 2rem; margin-bottom: 30px; }
        .cards { display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; margin-bottom: 50px; }
        .card { flex: 1 1 200px; max-width: 250px; text-align: center; padding: 30px 20px; background: #fff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); transition: transform 0.2s, box-shadow 0.2s; }
        .card:hover { transform: translateY(-5px); box-shadow: 0 8px 20px rgba(0,0,0,0.15); }
        .card h2 { margin-bottom: 15px; color: #555; font-size: 1.2rem; }
        .card p { font-size: 2rem; font-weight: bold; color: #007BFF; }
        .section-title { text-align: center; margin-bottom: 20px; font-size: 1.5rem; }
        .graphs { display: flex; flex-wrap: wrap; gap: 30px; justify-content: center; }
        .graph-card { flex: 1 1 400px; max-width: 500px; padding: 20px; background: #fff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
        .graph-card h3 { text-align: center; margin-bottom: 20px; font-size: 1.2rem; }
        @media(max-width:768px){ .cards,.graphs{ flex-direction: column; align-items: center; } }
    </style>
</x-app-layout>
