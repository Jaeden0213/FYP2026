<x-app-layout>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            overflow: hidden;
        }

        /* ===== Main Layout ===== */
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
            overflow: hidden;
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
            position: relative;
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

        /* ===== Main Content ===== */
        .main-content-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            min-width: 0;
        }

        /* ===== Page Header Strip like Voucher Store ===== */
        .page-header-strip {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            padding: 18px 28px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
            flex-shrink: 0;
        }

        .page-header-strip h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ===== Scroll Area ===== */
        .dashboard-scroll-area {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 28px;
            min-height: 0;
        }

        .analytics-scope {
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
        }

        /* ===== Tabs ===== */
        .tabs-row {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 24px;
        }

        .tab-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 24px;
            border-radius: 999px;
            border: 1px solid #d1d5db;
            background: white;
            color: #374151;
            font-size: 0.98rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .tab-btn:hover {
            border-color: #4f46e5;
            color: #4f46e5;
            background: #f5f3ff;
        }

        .tab-btn.active {
            background: #0f172a;
            color: white;
            border-color: #0f172a;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.18);
        }

        /* ===== Filters ===== */
        .filters-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 16px;
            align-items: end;
            margin-bottom: 28px;
        }

        .filter-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 0.95rem;
            font-weight: 600;
            color: #374151;
        }

        .filter-group input,
        .filter-group select {
            width: 100%;
            height: 52px;
            border-radius: 12px;
            border: 2px solid #e5e7eb;
            padding: 0 16px;
            font-size: 1rem;
            box-sizing: border-box;
            transition: all 0.2s ease;
            background: white;
        }

        .filter-group input:focus,
        .filter-group select:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        .filter-span-2 {
            grid-column: span 2;
        }

        .filter-span-1 {
            grid-column: span 1;
        }

        .filter-actions {
            grid-column: span 6;
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 4px;
        }

        .btn-apply {
            padding: 12px 28px;
            border-radius: 10px;
            border: none;
            background: #0f172a;
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-apply:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(15, 23, 42, 0.2);
        }

        .btn-reset {
            padding: 12px 28px;
            border-radius: 10px;
            border: 2px solid #e5e7eb;
            background: white;
            color: #374151;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-reset:hover {
            background: #f8fafc;
            border-color: #d1d5db;
        }

        /* ===== KPI Cards ===== */
        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 24px;
        }

        .kpi-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 22px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.03);
        }

        .kpi-label {
            font-size: 0.95rem;
            color: #6b7280;
            margin-bottom: 10px;
        }

        .kpi-value {
            font-size: 2rem;
            font-weight: 800;
            color: #111827;
            line-height: 1;
        }

        /* ===== Panels ===== */
        .panel {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 22px;
            margin-bottom: 20px;
        }

        .panel-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 16px;
            color: #111827;
        }

        .chart-box {
            width: 100%;
            height: 320px;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
            margin-bottom: 20px;
        }

        .summary-text {
            color: #4b5563;
            line-height: 1.7;
            font-size: 0.96rem;
        }

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

        .insight-item {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 18px 20px;
            background: #f8fafc;
            color: #374151;
            margin-bottom: 10px;
            line-height: 1.8;
            font-size: 1rem;
        }

        .insight-item strong {
            color: #111827;
            font-weight: 700;
        }

        .insight-item br + br {
            content: "";
        }

        .tab-panel.hidden {
            display: none;
        }

        @media (max-width: 1024px) {
            .kpi-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .filters-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .filter-span-2,
            .filter-span-1 {
                grid-column: span 1;
            }

            .filter-actions {
                grid-column: span 2;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 60px;
            }

            .sidebar.active {
                width: 200px;
            }

            .dashboard-scroll-area {
                padding: 16px;
            }

            .kpi-grid,
            .summary-grid,
            .filters-grid {
                grid-template-columns: 1fr;
            }

            .filter-actions {
                grid-column: span 1;
                flex-direction: column;
            }

            .btn-apply,
            .btn-reset {
                width: 100%;
            }
        }
    </style>

    <div class="app-container">
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar">
            <button id="sidebarToggle" class="toggle-btn" type="button">
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
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content-area">
            <div class="page-header-strip">
                <h1>Analytics</h1>
            </div>

            <div class="dashboard-scroll-area">
                <div class="analytics-scope">

                    {{-- Tabs --}}
                    <div class="tabs-row">
                        <button type="button" data-tab="overview" class="tab-btn active">Overview</button>
                        <button type="button" data-tab="charts" class="tab-btn">Productivity Charts</button>
                        <button type="button" data-tab="insights" class="tab-btn">Insights & Recommendations</button>
                    </div>

                    {{-- Filters --}}
                    <form id="filters" class="filters-grid">
                        <div class="filter-group filter-span-2">
                            <label>From</label>
                            <input type="date" name="from">
                        </div>

                        <div class="filter-group filter-span-2">
                            <label>To</label>
                            <input type="date" name="to">
                        </div>

                        <div class="filter-group filter-span-1">
                            <label>Status</label>
                            <select name="status">
                                <option value="">All</option>
                                <option value="pending">Pending</option>
                                <option value="in_progress">In Progress</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>

                        <div class="filter-group filter-span-1">
                            <label>Category</label>
                            <select name="category">
                                <option value="">All</option>
                                <option value="chores">Chores</option>
                                <option value="exercise">Exercise</option>
                                <option value="study">Study</option>
                                <option value="assignment">Assignment</option>
                            </select>
                        </div>

                        <div class="filter-actions">
                            <button type="submit" class="btn-apply">Apply</button>
                            <button type="button" id="resetFilters" class="btn-reset">Reset</button>
                        </div>
                    </form>

                    {{-- OVERVIEW TAB --}}
                    <div id="tab-overview" class="tab-panel">
                        <div class="kpi-grid">
                            <div class="kpi-card">
                                <div class="kpi-label">Total Tasks</div>
                                <div id="kpi_total" class="kpi-value">-</div>
                            </div>
                            <div class="kpi-card">
                                <div class="kpi-label">Completed</div>
                                <div id="kpi_completed" class="kpi-value">-</div>
                            </div>
                            <div class="kpi-card">
                                <div class="kpi-label">Pending</div>
                                <div id="kpi_pending" class="kpi-value">-</div>
                            </div>
                            <div class="kpi-card">
                                <div class="kpi-label">Completion %</div>
                                <div id="kpi_pct" class="kpi-value">-</div>
                            </div>
                        </div>

                        <div class="panel">
                            <div class="panel-title">Task Status Breakdown</div>
                            <div class="chart-box">
                                <canvas id="chartStatusPie"></canvas>
                            </div>
                        </div>

                        <div class="summary-grid">
                            <div class="panel">
                                <div class="panel-title">Daily Summary</div>
                                <div id="daily_summary" class="summary-text">-</div>
                            </div>
                            <div class="panel">
                                <div class="panel-title">Weekly Summary</div>
                                <div id="weekly_summary" class="summary-text">-</div>
                            </div>
                        </div>

                        <div class="panel">
                            <div class="panel-title">Completed Tasks (Last 7 Days)</div>
                            <div class="chart-box">
                                <canvas id="chartLast7"></canvas>
                            </div>
                        </div>
                    </div>

                    {{-- CHARTS TAB --}}
                    <div id="tab-charts" class="tab-panel hidden">
                        <div class="panel">
                            <div class="panel-title">Completed vs Pending (Selected Range)</div>
                            <div class="chart-box">
                                <canvas id="chartCompletedVsPending"></canvas>
                            </div>
                        </div>

                        <div class="panel">
                            <div class="panel-title">Historical Trends</div>
                            <div class="chart-box">
                                <canvas id="chartHistorical"></canvas>
                            </div>
                        </div>
                    </div>

                    {{-- INSIGHTS TAB --}}
                    <div id="tab-insights" class="tab-panel hidden">
                        <div class="panel">
                            <div class="panel-title">Insights & Recommendations</div>

                            <div id="insights_loader" class="insights-loader">
                                <div class="insights-spinner"></div>
                                <p>Analyzing your productivity patterns...</p>
                            </div>

                            <div id="insights_list"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const sidebar = document.getElementById('sidebar');
        document.getElementById('sidebarToggle').addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });

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
                btn.classList.toggle('active', btn.dataset.tab === tab);
            });

            Object.keys(panels).forEach(key => {
                panels[key].classList.toggle('hidden', key !== tab);
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
                        datasets: [{
                            data: [json.kpis.completed_tasks, json.kpis.pending_tasks]
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            }

            const barCanvas = document.getElementById('chartLast7');
            if (barCanvas) {
                destroyIfExists(last7ChartInstance);
                last7ChartInstance = new Chart(barCanvas.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: json.last7CompletedChart.labels,
                        datasets: [{
                            label: 'Completed Tasks',
                            data: json.last7CompletedChart.data
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: { precision: 0 }
                            }
                        }
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
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: { precision: 0 }
                            }
                        }
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
                        datasets: [{
                            label: 'Completed (Weekly)',
                            data: json.historical.counts
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: { precision: 0 }
                            }
                        }
                    }
                });
            }
        }

          async function loadInsights() {
        const loader = document.getElementById('insights_loader');
        const wrap = document.getElementById('insights_list');

        wrap.innerHTML = '';
        loader.style.display = "block";

        try {
            const qs = getQueryParams();
            const res = await fetch(`/analytics/insights-data?${qs}`);
            const json = await res.json();

            loader.style.display = "none";

            json.insights.forEach(msg => {
                const item = document.createElement('div');
                item.className = "insight-item";
                item.innerHTML = msg; // IMPORTANT: render HTML, not plain text
                wrap.appendChild(item);
            });
        } catch (error) {
            loader.style.display = "none";
            wrap.innerHTML = `
                <div class="insight-item">
                    Unable to load insights right now.
                </div>
            `;
            console.error(error);
        }
    }

        setActiveTab('overview');
    </script>
</x-app-layout>