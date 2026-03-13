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
    </style>

     <div class="app-container">
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar">
            <button id="sidebarToggle" class="toggle-btn" type="button">
                <span class="sidebar-icon">☰</span>
                <span class="toggle-btn-text">Gamification</span>
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
    
        <div class="main-content-area">
            <div class="page-header-strip">
                <h1>Tasks Dashboard</h1>
            </div>
            @if($notifications->count() === 0)
                <div class="bg-white border border-gray-200 rounded-xl p-6 text-gray-600">
                    No notifications yet.
                </div>
            @else
                <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
                    @foreach($notifications as $n)
                        @php
                            $isUnread = !$n->sent_status;

                            $map = [
                                'task_overdue' => 'Task overdue',
                                'task_completed' => 'Task completed',
                            ];
                            $title = $map[$n->notification_type] ?? 'Notification';
                        @endphp

                        <div id="notif-{{ $n->notification_id }}"
                             class="flex items-start gap-3 px-4 py-4 border-b border-gray-100 hover:bg-gray-50">

                            <div class="mt-2 w-2.5 h-2.5 rounded-full {{ $isUnread ? 'bg-blue-600' : 'bg-gray-300' }}"></div>

                            <div class="flex-1">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <div class="font-semibold text-gray-900">{{ $title }}</div>
                                        <div class="text-gray-700 mt-1">{{ $n->message }}</div>
                                        <div class="text-sm text-gray-500 mt-2">
                                            {{ $n->created_at->diffForHumans() }}
                                            @if($n->task_id)
                                                • <a href="{{ route('tasks.index') }}" class="text-blue-600 hover:underline">View tasks</a>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <button
                                            class="text-sm px-3 py-1.5 rounded-lg bg-red-50 text-red-700 hover:bg-red-100"
                                            onclick="deleteNotif({{ $n->notification_id }})">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-5">
                    {{ $notifications->links() }}
                </div>
            @endif
        </div>
    </div>

  <script>
        const csrfToken = "{{ csrf_token() }}";

        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', () => {
                sidebar.classList.toggle('active');
            });
        }

        async function markRead(id) {
            const res = await fetch(`/notifications/${id}/read`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            });

            if (!res.ok) return alert("Failed to mark read.");

            const card = document.getElementById(`notif-${id}`);
            const dot = card?.querySelector('.w-2\\.5.h-2\\.5.rounded-full');
            dot?.classList.remove('bg-blue-600');
            dot?.classList.add('bg-gray-300');
        }

        async function deleteNotif(id) {
            if (!confirm("Delete this notification?")) return;

            const res = await fetch(`/notifications/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            });

            if (!res.ok) return alert("Failed to delete.");

            document.getElementById(`notif-${id}`)?.remove();
        }
    </script>
</x-app-layout>
