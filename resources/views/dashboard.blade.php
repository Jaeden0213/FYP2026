<x-app-layout>
    <style>
/* -------- AI INSIGHTS LOADER -------- */
.insights-loader {
    display: none;
    text-align: center;
    padding: 30px 0;
}

.insights-spinner {
    width: 36px;
    height: 36px;
    border: 4px solid #e5e7eb;
    border-top: 4px solid #111827;
    border-radius: 50%;
    animation: insightsSpin 1s linear infinite;
    margin: auto;
}

.insights-loader p {
    margin-top: 10px;
    color: #6b7280;
    font-size: 14px;
}

@keyframes insightsSpin {
    to {
        transform: rotate(360deg);
    }
}

/* -------- EXISTING PAGE SAFETY -------- */
.analytics-scope * { box-sizing: border-box; }

.analytics-scope label { display:block; margin-bottom: .25rem; }

.analytics-scope input,
.analytics-scope select { background:#fff; }

.analytics-scope button { font: inherit; }

</style>
    <div class="analytics-scope">
        <x-slot name="header">
            <div class="flex flex-col gap-1">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Dashboard') }}
                </h2>
                <p class="text-sm text-gray-500">
                    Track your progress, patterns, and study habits.
                </p>
            </div>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">

                        {{-- Tabs --}}
                        <div class="flex flex-wrap gap-3 mb-6">
                            {{-- give default styling so it never renders blank --}}
                            <button type="button" data-tab="overview"
                                class="tab-btn inline-flex items-center px-6 py-2.5 rounded-full bg-gray-900 text-white border border-gray-900 shadow-sm transition">
                                Overview
                            </button>

                            <button type="button" data-tab="charts"
                                class="tab-btn inline-flex items-center px-6 py-2.5 rounded-full bg-white text-gray-700 border border-gray-300 hover:bg-gray-50 transition">
                                Productivity Charts
                            </button>

                            <button type="button" data-tab="insights"
                                class="tab-btn inline-flex items-center px-6 py-2.5 rounded-full bg-white text-gray-700 border border-gray-300 hover:bg-gray-50 transition">
                                Insights & Recommendations
                            </button>
                        </div>

                        {{-- Filters (FR13) --}}
                        <form id="filters" class="grid grid-cols-6 gap-4 items-end mb-8">
                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-600">From</label>
                                <input type="date" name="from"
                                    class="mt-1 w-full h-11 border rounded-lg px-3 text-base focus:ring-2 focus:ring-gray-900 focus:border-gray-900">
                            </div>

                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-600">To</label>
                                <input type="date" name="to"
                                    class="mt-1 w-full h-11 border rounded-lg px-3 text-base focus:ring-2 focus:ring-gray-900 focus:border-gray-900">
                            </div>

                            <div class="col-span-1">
                                <label class="block text-sm font-medium text-gray-600">Status</label>
                                <select name="status"
                                    class="mt-1 w-full h-11 border rounded-lg px-3 text-base focus:ring-2 focus:ring-gray-900 focus:border-gray-900">
                                    <option value="">All</option>
                                    <option value="pending">Pending</option>
                                    <option value="in_progress">In Progress</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div>

                            <div class="col-span-1">
                                <label class="block text-sm font-medium text-gray-600">Category</label>
                                <select name="category"
                                    class="mt-1 w-full h-11 border rounded-lg px-3 text-base focus:ring-2 focus:ring-gray-900 focus:border-gray-900">
                                    <option value="">All</option>
                                    <option value="chores">Chores</option>
                                    <option value="exercise">Exercise</option>
                                    <option value="study">Study</option>
                                    <option value="assignment">Assignment</option>
                                </select>
                            </div>

                            <div class="col-span-6 flex justify-end gap-2 mt-2">
                                <button type="submit"
                                    class="h-11 px-6 rounded-lg bg-gray-900 text-white hover:bg-black transition">
                                    Apply
                                </button>

                                <button type="button" id="resetFilters"
                                    class="h-11 px-6 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition">
                                    Reset
                                </button>
                            </div>
                        </form>

                        {{-- OVERVIEW TAB --}}
                        <div id="tab-overview" class="tab-panel">
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                                <div class="border rounded-xl p-4">
                                    <div class="text-sm text-gray-500">Total Tasks</div>
                                    <div id="kpi_total" class="text-2xl font-bold mt-1">-</div>
                                </div>
                                <div class="border rounded-xl p-4">
                                    <div class="text-sm text-gray-500">Completed</div>
                                    <div id="kpi_completed" class="text-2xl font-bold mt-1">-</div>
                                </div>
                                <div class="border rounded-xl p-4">
                                    <div class="text-sm text-gray-500">Pending</div>
                                    <div id="kpi_pending" class="text-2xl font-bold mt-1">-</div>
                                </div>
                                <div class="border rounded-xl p-4">
                                    <div class="text-sm text-gray-500">Completion %</div>
                                    <div id="kpi_pct" class="text-2xl font-bold mt-1">-</div>
                                </div>
                            </div>

                            <div class="border rounded-xl p-4 mb-6">
                                <div class="font-semibold mb-2">Task Status Breakdown</div>
                                <div class="w-full h-64">
                                    <canvas id="chartStatusPie"></canvas>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                <div class="border rounded-xl p-4">
                                    <div class="font-semibold mb-2">Daily Summary</div>
                                    <div id="daily_summary" class="text-gray-700">-</div>
                                </div>
                                <div class="border rounded-xl p-4">
                                    <div class="font-semibold mb-2">Weekly Summary</div>
                                    <div id="weekly_summary" class="text-gray-700">-</div>
                                </div>
                            </div>

                            <div class="border rounded-xl p-4">
                                <div class="font-semibold mb-2">Completed Tasks (Last 7 Days)</div>
                                <div class="w-full h-64">
                                    <canvas id="chartLast7"></canvas>
                                </div>
                            </div>
                        </div>

                        {{-- CHARTS TAB --}}
                        <div id="tab-charts" class="tab-panel hidden">
                            <div class="border rounded-xl p-4 mb-4">
                                <div class="font-semibold mb-2">Completed vs Pending (Selected Range)</div>
                                <div class="w-full h-72">
                                    <canvas id="chartCompletedVsPending"></canvas>
                                </div>
                            </div>

                            <div class="border rounded-xl p-4">
                                <div class="font-semibold mb-2">Historical Trends</div>
                                <div class="w-full h-72">
                                    <canvas id="chartHistorical"></canvas>
                                </div>
                            </div>
                        </div>

                        {{-- INSIGHTS TAB --}}
                        <div id="tab-insights" class="tab-panel hidden">
                            <div class="border rounded-xl p-4">
                                <div class="font-semibold mb-3">Insights & Recommendations</div>
                                <div id="insights_loader" class="insights-loader">
                                    <div class="insights-spinner"></div>
                                    <p>Analyzing your productivity patterns...</p>
                                </div>

                                <ul id="insights_list" class="space-y-2 text-gray-700"></ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- SAFE Page-only Shield (does NOT break Tailwind) --}}
        <style>
            .analytics-scope * { box-sizing: border-box; }

            /* Counter navbar reset ONLY for form/tabs, without undoing Tailwind utilities */
            .analytics-scope label { display:block; margin-bottom: .25rem; }
            .analytics-scope input,
            .analytics-scope select { background:#fff; }

            /* prevent navbar button styles from hijacking (but keep Tailwind classes working) */
            .analytics-scope button { font: inherit; }
        </style>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            const tabButtons = document.querySelectorAll('.tab-btn');
            const panels = {
                overview: document.getElementById('tab-overview'),
                charts: document.getElementById('tab-charts'),
                insights: document.getElementById('tab-insights'),
            };

            let activeTab = 'overview';
            let last7ChartInstance = null;
            let statusPieInstance = null;
            let cvpChartInstance = null;
            let historicalChartInstance = null;

            function destroyIfExists(chart) {
                if (chart) chart.destroy();
            }

            function setActiveTab(tab) {
                activeTab = tab;

                tabButtons.forEach(btn => {
                    const isActive = btn.dataset.tab === tab;
                    btn.className = isActive
                        ? "tab-btn inline-flex items-center px-6 py-2.5 rounded-full bg-gray-900 text-white border border-gray-900 shadow-sm transition"
                        : "tab-btn inline-flex items-center px-6 py-2.5 rounded-full bg-white text-gray-700 border border-gray-300 hover:bg-gray-50 transition";
                });

                Object.keys(panels).forEach(k => {
                    panels[k].classList.toggle('hidden', k !== tab);
                });

                if (tab === 'overview') loadOverview();
                if (tab === 'charts') loadCharts();
                if (tab === 'insights') loadInsights();
            }

            tabButtons.forEach(btn => {
                btn.addEventListener('click', () => setActiveTab(btn.dataset.tab));
            });

            function getQueryParams() {
                const form = document.getElementById('filters');
                const data = new FormData(form);
                const params = new URLSearchParams();
                for (const [k, v] of data.entries()) {
                    if (v) params.set(k, v);
                }
                return params.toString();
            }

            document.getElementById('filters').addEventListener('submit', (e) => {
                e.preventDefault();
                if (activeTab === 'overview') loadOverview();
                if (activeTab === 'charts') loadCharts();
                if (activeTab === 'insights') loadInsights();
            });

            document.getElementById('resetFilters').addEventListener('click', () => {
                document.getElementById('filters').reset();
                if (activeTab === 'overview') loadOverview();
                if (activeTab === 'charts') loadCharts();
                if (activeTab === 'insights') loadInsights();
            });

            async function loadOverview() {
                const qs = getQueryParams();
                const res = await fetch(`/analytics/overview-data?${qs}`);
                const json = await res.json();

                document.getElementById('kpi_total').textContent = json.kpis.total_tasks;
                document.getElementById('kpi_completed').textContent = json.kpis.completed_tasks;
                document.getElementById('kpi_pending').textContent = json.kpis.pending_tasks;
                document.getElementById('kpi_pct').textContent = json.kpis.completion_percentage + '%';

                document.getElementById('daily_summary').textContent = json.summaries.daily;
                document.getElementById('weekly_summary').textContent = json.summaries.weekly;

                const pieCanvas = document.getElementById('chartStatusPie');
                if (pieCanvas) {
                    destroyIfExists(statusPieInstance);
                    statusPieInstance = new Chart(pieCanvas.getContext('2d'), {
                        type: 'pie',
                        data: {
                            labels: ['Completed', 'Pending'],
                            datasets: [{ data: [json.kpis.completed_tasks, json.kpis.pending_tasks] }]
                        },
                        options: { responsive: true, maintainAspectRatio: false }
                    });
                }

                const barCanvas = document.getElementById('chartLast7');
                if (barCanvas) {
                    destroyIfExists(last7ChartInstance);
                    last7ChartInstance = new Chart(barCanvas.getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: json.last7CompletedChart.labels,
                            datasets: [{ label: 'Completed Tasks', data: json.last7CompletedChart.data }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
                        }
                    });
                }
            }

            async function loadCharts() {
                const qs = getQueryParams();
                const res = await fetch(`/analytics/charts-data?${qs}`);
                const json = await res.json();

                const canvas1 = document.getElementById('chartCompletedVsPending');
                if (canvas1) {
                    destroyIfExists(cvpChartInstance);
                    cvpChartInstance = new Chart(canvas1.getContext('2d'), {
                        type: 'line',
                        data: {
                            labels: json.completedVsPending.labels,
                            datasets: [
                                { label: 'Completed', data: json.completedVsPending.completed },
                                { label: 'Pending', data: json.completedVsPending.pending }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
                        }
                    });
                }

                const canvas2 = document.getElementById('chartHistorical');
                if (canvas2) {
                    destroyIfExists(historicalChartInstance);
                    historicalChartInstance = new Chart(canvas2.getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: json.historical.weeks,
                            datasets: [{ label: 'Completed (Weekly)', data: json.historical.counts }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
                        }
                    });
                }
            }

            async function loadInsights() {

                const loader = document.getElementById('insights_loader');
                const ul = document.getElementById('insights_list');

                ul.innerHTML = '';
                loader.style.display = "block";

                const qs = getQueryParams();
                const res = await fetch(`/analytics/insights-data?${qs}`);
                const json = await res.json();

                loader.style.display = "none";

                json.insights.forEach(msg => {
                    const li = document.createElement('li');
                    li.className = "border rounded-lg p-3 bg-gray-50";
                    li.textContent = msg;
                    ul.appendChild(li);
                });
            }

            setActiveTab('overview');
        </script>
    </div>
</x-app-layout>