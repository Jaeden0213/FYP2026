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
            to { transform: rotate(360deg); }
        }

        /* ===== Toolbar ===== */
        .toolbar {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            padding: 16px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-shrink: 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            min-height: 64px;
            box-sizing: border-box;
            width: 100%;
        }

        .toolbar h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            white-space: nowrap;
        }

        /* App Container - Fixed layout */
        .app-container {
            display: flex;
            height: 100vh;
            background: linear-gradient(135deg, #f9fafb 0%, #f0f4f8 100%);
            overflow: hidden;
        }

        /* ===== Sidebar ===== */
        .sidebar {
            width: 70px;
            background: linear-gradient(180deg, #6366f1 0%, #4f46e5 100%);
            color: white;
            padding-top: 20px;
            box-sizing: border-box;
            transition: width 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.08);
            z-index: 10;
        }

        .sidebar.active {
            width: 250px;
        }

        .toggle-btn {
            display: flex;
            align-items: center;
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 12px 15px;
            margin-bottom: 20px;
            white-space: nowrap;
            transition: all 0.3s ease;
            border-radius: 8px;
            margin: 0 10px 20px;
        }

        .toggle-btn:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .toggle-btn-text {
            margin-left: 15px;
            font-size: 1.1rem;
            font-weight: 600;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar.active .toggle-btn-text {
            opacity: 1;
        }

        .sidebar-content {
            opacity: 1;
            transition: opacity 0.3s ease;
            padding: 0 10px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            margin: 4px 0;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            border-radius: 8px;
            white-space: nowrap;
            overflow: hidden;
            transition: all 0.2s ease;
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(4px);
        }

        .sidebar-icon {
            font-size: 1.3rem;
            min-width: 30px;
            text-align: center;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
        }

        .sidebar-text {
            margin-left: 15px;
            opacity: 0;
            transition: opacity 0.3s ease;
            font-size: 0.95rem;
            font-weight: 500;
        }

        .sidebar.active .sidebar-text {
            opacity: 1;
        }

        /* Tooltip for collapsed sidebar icons */
        .sidebar a .icon-tooltip {
            position: absolute;
            left: 80px;
            background: #1f2937;
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 0.85rem;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s ease;
            z-index: 1000;
            pointer-events: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .sidebar:not(.active) a:hover .icon-tooltip {
            opacity: 1;
            visibility: visible;
        }

        .sidebar:not(.active) .sidebar-icon {
            font-size: 1.4rem;
        }

        /* Main Content Area - Fixed */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            height: 100vh;
        }

        /* Scrollable content - ONLY THIS SCROLLS */
        .scrollable-content {
            flex: 1;
            overflow-y: auto;
            padding: 24px;
        }

        /* Analytics Scope */
        .analytics-scope {
            max-width: 1400px;
            margin: 0 auto;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 60px;
            }
            .sidebar.active {
                width: 200px;
            }
            
            .scrollable-content {
                padding: 16px;
            }
        }

        /* Keep all your existing styles below */
        .analytics-scope * { box-sizing: border-box; }
        .analytics-scope label { display:block; margin-bottom: .25rem; }
        .analytics-scope input,
        .analytics-scope select { background:#fff; }
        .analytics-scope button { font: inherit; }
    </style>

    <div class="app-container">
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar">
            <button id="sidebarToggle" class="toggle-btn">
                <span class="sidebar-icon">☰</span>
                <span class="toggle-btn-text">Workspace</span>
            </button>
            <div class="sidebar-content">
                <a href="/dashboard">
                    <span class="sidebar-icon">🏠</span>
                    <span class="sidebar-text">Home</span>
                    <span class="icon-tooltip">Home</span>
                </a>
                <a href="{{ route('tasks.index') }}" id="listViewBtn">
                    <span class="sidebar-icon">📋</span>
                    <span class="sidebar-text">List View</span>
                    <span class="icon-tooltip">List View</span>
                </a>
                <a href="{{ route('tasks.calendar') }}">
                    <span class="sidebar-icon">📅</span>
                    <span class="sidebar-text">Planner</span>
                    <span class="icon-tooltip">Planner</span>
                </a>
                <a href="{{ route('notifications.index') }}">
                    <span class="sidebar-icon">🔔</span>
                    <span class="sidebar-text">Notifications</span>
                    <span class="icon-tooltip">Notifications</span>
                </a>
                <a href="#">
                    <span class="sidebar-icon">⚙️</span>
                    <span class="sidebar-text">Settings</span>
                    <span class="icon-tooltip">Settings</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Toolbar at the very top (NO SCROLL) -->
            <div class="toolbar">
                <h1>Tasks Dashboard</h1>
            </div>

            <!-- Scrollable Content - ONLY THIS SCROLLS -->
            <div class="scrollable-content">
                <div class="analytics-scope">
                    <!-- Rest of your content -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">

                            {{-- Tabs --}}
                            <div class="flex flex-wrap gap-3 mb-6">
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

                            {{-- Filters --}}
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

                            {{-- Overview Tab --}}
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

                            {{-- Charts Tab --}}
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

                            {{-- Insights Tab --}}
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
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Sidebar toggle
        const sidebar = document.getElementById('sidebar');
        document.getElementById('sidebarToggle').addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });

        // Tab functionality
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
</x-app-layout>