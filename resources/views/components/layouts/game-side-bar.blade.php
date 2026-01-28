<x-app-layout>
    <style>
        html, body { margin:0; padding:0; height:100%; overflow:hidden; font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,Oxygen,Ubuntu,sans-serif; }

        .app-container { display:flex; height:100vh; background: linear-gradient(135deg,#f9fafb 0%,#f0f4f8 100%); overflow:hidden; }

        /* Sidebar */
        .sidebar { width:70px; background: linear-gradient(180deg,#6366f1 0%,#4f46e5 100%); color:white; padding-top:20px; flex-shrink:0;
            display:flex; flex-direction:column; transition:width .3s; box-shadow:4px 0 20px rgba(0,0,0,.08); z-index:10; }
        .sidebar.active { width:250px; }

        .toggle-btn { display:flex; align-items:center; background:none; border:none; color:white; font-size:1.5rem; cursor:pointer;
            padding:12px 15px; border-radius:8px; margin:0 10px 20px; }
        .toggle-btn:hover { background: rgba(255,255,255,.1); }

        .toggle-btn-text { margin-left:15px; font-size:1.1rem; font-weight:600; opacity:0; transition:opacity .3s; }
        .sidebar.active .toggle-btn-text { opacity:1; }

        .sidebar-content { padding:0 10px; }
        .sidebar a { position:relative; display:flex; align-items:center; padding:12px 15px; margin:4px 0;
            color:rgba(255,255,255,.9); text-decoration:none; border-radius:8px; white-space:nowrap; overflow:hidden; transition:.2s; }
        .sidebar a:hover { background: rgba(255,255,255,.15); transform: translateX(4px); }

        .sidebar-icon { font-size:1.3rem; min-width:30px; text-align:center; }
        .sidebar-text { margin-left:15px; opacity:0; transition:opacity .3s; font-size:.95rem; font-weight:500; }
        .sidebar.active .sidebar-text { opacity:1; }

        .icon-tooltip { position:absolute; left:80px; top:50%; transform:translateY(-50%);
            background:#1f2937; color:#fff; padding:8px 12px; border-radius:6px; font-size:.85rem;
            white-space:nowrap; opacity:0; visibility:hidden; transition:.2s; pointer-events:none; }
        .sidebar:not(.active) a:hover .icon-tooltip { opacity:1; visibility:visible; }

        /* Main content */
        .main-content-area { flex:1; display:flex; flex-direction:column; overflow:hidden; }

        .toolbar { background:#fff; border-bottom:1px solid #e5e7eb; padding:16px 24px; display:flex; justify-content:space-between; align-items:center;
            flex-shrink:0; box-shadow:0 2px 10px rgba(0,0,0,.05); min-height:64px; }
        .toolbar h1 { font-size:1.5rem; font-weight:700; margin:0; background: linear-gradient(135deg,#4f46e5 0%,#7c3aed 100%);
            -webkit-background-clip:text; -webkit-text-fill-color:transparent; white-space:nowrap; }

        .page-body { flex:1; overflow-y:auto; padding:24px; background:#f8fafc; }
    </style>

    <div class="app-container">
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar">
            <button id="sidebarToggle" class="toggle-btn" type="button">
                <span class="sidebar-icon">☰</span>
                <span class="toggle-btn-text">Gamification</span>
            </button>

            <div class="sidebar-content">
                <a href="{{ route('store.index') }}">
                    <span class="sidebar-icon">🛒</span>
                    <span class="sidebar-text">Store</span>
                    <span class="icon-tooltip">Store</span>
                </a>

                <a href="#">
                    <span class="sidebar-icon">🏆</span>
                    <span class="sidebar-text">Achievements</span>
                    <span class="icon-tooltip">Achievements</span>
                </a>

                <a href="#">
                    <span class="sidebar-icon">🏅</span>
                    <span class="sidebar-text">Badges</span>
                    <span class="icon-tooltip">Badges</span>
                </a>

                <a href="{{ route('store.pomodoro') }}">
                    <span class="sidebar-icon">⏱️</span>
                    <span class="sidebar-text">Pomodoro</span>
                    <span class="icon-tooltip">Pomodoro</span>
                </a>
            </div>
        </aside>

        <!-- Main -->
        <div class="main-content-area">
            <div class="toolbar">
                <h1>{{ $title ?? 'Gamification' }}</h1>
            </div>

            <div class="page-body">
                {{ $slot }}
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('sidebar');
            const btn = document.getElementById('sidebarToggle');
            if (btn && sidebar) {
                btn.addEventListener('click', () => sidebar.classList.toggle('active'));
            }
        });
    </script>
</x-app-layout>
