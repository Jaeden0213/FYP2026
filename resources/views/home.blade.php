<x-app-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    body, html {
        margin: 0;
        padding: 0;
        height: 100%;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
        overflow: hidden; /* Prevent double scroll */
    }

    /* ===== Main Layout ===== */
    .app-container {
        display: flex;
        height: 100vh;
        background: linear-gradient(135deg, #f9fafb 0%, #f0f4f8 100%);
        overflow: hidden; /* Prevent double scroll */
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

    /* ===== Main Content Area ===== */
    .main-content-area {
        flex: 1;
        display: flex;
        flex-direction: column;
        overflow: hidden; /* Single scroll container */
        padding-bottom: 40px;
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

    .search-form {
        display: flex;
        gap: 8px;
        align-items: center;
        flex: 1;
        max-width: 400px;
        margin: 0 20px;
    }

    .search-form input {
        flex: 1;
        padding: 10px 16px;
        border-radius: 8px;
        border: 2px solid #e5e7eb;
        font-size: 0.95rem;
        transition: all 0.2s ease;
    }

    .search-form input:focus {
        outline: none;
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .search-form button {
        padding: 10px 20px;
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .search-form button:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
    }

    .toolbar button {
        padding: 10px 20px;
        border-radius: 8px;
        border: none;
        background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
        white-space: nowrap;
    }

    .toolbar button:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(16, 185, 129, 0.3);
    }

    /* ===== Main Content Area ===== */
    .main-content-wrapper {
        flex: 1;
        display: flex;
        overflow: hidden; /* Single scroll area */
        padding: 0;
    }

    /* ===== Tasks Area ===== */
    .tasks-area {
        flex: 1;
        overflow-y: auto; /* Only this area scrolls */
        padding: 24px;
        background: #f8fafc;
    }

    /* ===== Side Panel (Calendar) ===== */
    .side-panel {
        width: 360px;
        flex-shrink: 0;
        background: white;
        border-left: 1px solid #e5e7eb;
        padding: 24px;
        overflow-y: auto; /* Calendar can scroll independently */
        box-shadow: -4px 0 20px rgba(0, 0, 0, 0.05);
    }

    /* ===== Priority Section ===== */
    .priority-section {
        margin-bottom: 24px;
        background: white;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .priority-section:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 16px -2px rgba(0, 0, 0, 0.08);
    }

    /* ===== Calendar ===== */
    .calendar-container {
        background: white;
        border-radius: 12px;
        padding: 7px;
        overflow: hidden;
        margin-bottom: 24px;
        border: 0.5px solid #d4d6da;
    }

    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
        padding: 16px;
        border-bottom: 1px solid #e5e7eb;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    }

    .calendar-header button {
        padding: 6px 12px;
        cursor: pointer;
        border: 2px solid #e5e7eb;
        background: white;
        border-radius: 6px;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .calendar-header button:hover {
        border-color: #4f46e5;
        background: #f5f3ff;
    }

    #month-year {
        font-weight: 600;
        color: #374151;
        font-size: 1.1rem;
    }

    .calendar-weekdays {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        text-align: center;
        font-weight: 600;
        margin-bottom: 8px;
        color: #6b7280;
        font-size: 0.85rem;
        padding: 0 16px;
    }

    #calendar-dates {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 4px;
        padding: 16px;
         border-radius: 12px;
        border: 0.5px solid #d4d6da;
    }

    #calendar-dates div {
        text-align: center;
        padding: 10px 6px;
        cursor: pointer;
        border-radius: 8px;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        border: 2px solid transparent;
    }

    #calendar-dates div:hover:not(.today):not(.selected) {
        background: #f3f4f6;
    }

    #calendar-dates div.today {
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
        color: white;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);
    }

    #calendar-dates div.selected {
        border: 2px solid #4f46e5;
        background: #f5f3ff;
        color: #4f46e5;
        font-weight: 600;
    }

    .priority-header {
        padding: 18px 20px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        gap: 12px;
        font-weight: 700;
        font-size: 1.1rem;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    }

    .priority-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .priority-dot.low { 
        background: linear-gradient(135deg, #10b981 0%, #34d399 100%); 
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
    }
    .priority-dot.medium { 
        background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%); 
        box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);
    }
    .priority-dot.high { 
        background: linear-gradient(135deg, #ef4444 0%, #f87171 100%); 
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
    }

    /* ===== Task Row ===== */
    .task-row {
        padding: 18px 20px;
        border-bottom: 1px solid #f1f5f9;
        cursor: pointer;
        transition: all 0.2s ease;
        position: relative;
    }

    .task-row:last-child {
        border-bottom: none;
    }

    .task-row:hover {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        transform: translateX(4px);
    }

    .task-row.completed {
        opacity: 0.7;
        background: #f9fafb;
    }

    .task-row.completed .task-title {
        text-decoration: line-through;
        color: #9ca3af;
    }

    .task-main {
        display: flex;
        gap: 12px;
        align-items: flex-start;
    }

    .task-title {
        font-weight: 600;
        color: #111827;
        display: flex;
        align-items: center;
        font-size: 1rem;
        line-height: 1.4;
        flex: 1;
    }

    .task-meta {
        margin-top: 6px;
        font-size: 0.8rem;
        color: #6b7280;
        display: flex;
        gap: 8px;
        align-items: center;
        flex-wrap: wrap;
    }

    .task-meta span {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .empty {
        padding: 32px 16px;
        color: #6b7280;
        font-style: italic;
        text-align: center;
        background: #f9fafb;
        border-radius: 8px;
        margin: 8px;
    }

    /* ===== Task Actions ===== */
    .task-actions {
        display: flex;
        gap: 8px;
        align-items: center;
        flex-shrink: 0;
    }

    .overdue-label {
        color: #dc2626;
        font-weight: 600;
        margin-left: 8px;
        font-size: 0.75rem;
        background: #fee2e2;
        padding: 2px 8px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .task-actions button {
        padding: 8px 16px;
        border-radius: 8px;
        border: 2px solid #e5e7eb;
        background: white;
        color: #4f46e5;
        font-weight: 500;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.2s ease;
        white-space: nowrap;
    }

    .task-actions button:hover {
        border-color: #4f46e5;
        background: #f5f3ff;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(79, 70, 229, 0.1);
    }

    .delete-btn {
        background: none;
        border: none;
        font-size: 1.2rem;
        cursor: pointer;
        padding: 6px;
        border-radius: 6px;
        line-height: 1;
        color: #dc2626;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        flex-shrink: 0;
    }

    .delete-btn:hover {
        background: #fee2e2;
        transform: scale(1.1);
    }

    /* ===== Subtask Section ===== */
    .subtasks-wrapper {
        margin-top: 12px;
        position: relative;
    }

    .subtask-toggle-btn {
        position: absolute;
        left: -15px;
        top: 50%;
        transform: translateY(-50%);
        background: white;
        border: 2px solid #e5e7eb;
        border-radius: 6px;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        z-index: 2;
        font-size: 0.8rem;
        color: #6b7280;
        padding: 0;
        margin-top: 3px;
        
        line-height: 1;
    }

    .subtask-toggle-btn:hover {
        background: #f3f4f6;
        border-color: #4f46e5;
        color: #4f46e5;
    }

    .subtasks-container {
        margin-left: 20px;
        border-left: 2px solid #e5e7eb;
        padding-left: 20px;
        position: relative;
        overflow: hidden;
        transition: max-height 0.3s ease, opacity 0.3s ease;
        
    }

    .subtasks-container:before {
        content: '';
        position: absolute;
        left: -px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: linear-gradient(180deg, #e5e7eb 0%, #f1f5f9 100%);
    }

    .subtask-row {
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 0.9rem;
        padding: 10px;
        color: #4b5563;
        background: white;
        border: 1px solid #f1f5f9;
        border-radius: 8px;
        margin-bottom: 8px;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .subtask-row:hover {
        background: #f9fafb;
        border-color: #e5e7eb;
        transform: translateX(4px);
    }

    .subtask-row.completed {
        background: #f0fdf4;
        border-color: #bbf7d0;
        opacity: 0.8;
    }

    .subtask-row.completed .subtask-title {
        text-decoration: line-through;
        color: #9ca3af;
    }

    .subtask-checkbox {
        font-size: 1.2rem;
        color: #4f46e5;
        min-width: 24px;
        text-align: center;
        filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
    }

    .subtask-title {
        flex: 1;
        font-weight: 500;
        color: #374151;
    }

    .subtask-points {
        background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
        color: white;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 600;
        box-shadow: 0 2px 6px rgba(245, 158, 11, 0.2);
        flex-shrink: 0;
    }

    /* ===== Filter Cards ===== */
    .filter-cards {
        display: grid;
        grid-template-columns: 1fr;
        gap: 16px;
        margin-top: 24px;
    }

    .filter-card {
        background: white;
        padding: 16px;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
        transition: all 0.2s ease;
    }

    .filter-card:hover {
        border-color: #d1d5db;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .filter-card label {
        display: block;
        font-size: 0.9rem;
        color: #4b5563;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .filter-card select {
        width: 100%;
        padding: 10px 12px;
        border-radius: 8px;
        border: 2px solid #e5e7eb;
        font-size: 0.9rem;
        background: white;
        transition: all 0.2s ease;
    }

    .filter-card select:focus {
        outline: none;
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .side-panel button[type="submit"] {
        width: 100%;
        padding: 12px;
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.2s ease;
        margin-top: 16px;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
    }

    .side-panel button[type="submit"]:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.3);
    }

    /* ===== Modal Overlay ===== */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        justify-content: center;
        align-items: flex-start;
        z-index: 9999;
        padding: 40px 20px;
        overflow-y: auto;
        backdrop-filter: blur(4px);
        
    }

    /* ===== Modal Box ===== */
    .modal-box {
        background: #fff;
        border-radius: 16px;
        padding: 32px;
        width: 100%;
        max-width: 500px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        animation: modalSlideUp 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        
    }

    .modal-row {
    display: flex;
    gap: 15px; /* Space between the two inputs */
    margin-bottom: 15px;
}

.input-group {
    flex: 1; /* Makes inputs take up equal width in a row */
    display: flex;
    flex-direction: column;
    margin-bottom: 15px;
}

.input-group label {
    font-weight: 600;
    margin-bottom: 5px;
    font-size: 0.9rem;
}

.input-group input, 
.input-group select, 
.input-group textarea {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 6px;
}

/* Mobile: Stack them back up so they aren't too skinny */
@media (max-width: 480px) {
    .modal-row {
        flex-direction: column;
        gap: 0;
    }
}

    @keyframes modalSlideUp {
        from { 
            opacity: 0; 
            transform: translateY(30px) scale(0.95); 
        }
        to { 
            opacity: 1; 
            transform: translateY(0) scale(1); 
        }
    }

    .modal-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 24px;
        color: #111827;
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .modal-box label {
        display: block;
        margin-top: 16px;
        font-weight: 600;
        font-size: 0.9rem;
        color: #374151;
    }

    .modal-box input,
    .modal-box select,
    .modal-box textarea {
        width: 100%;
        margin-top: 8px;
        padding: 12px 16px;
        border-radius: 10px;
        border: 2px solid #e5e7eb;
        font-size: 0.95rem;
        box-sizing: border-box;
        font-family: inherit;
        transition: all 0.2s ease;
    }

    .modal-box textarea {
        min-height: 100px;
        resize: vertical;
        line-height: 1.5;
    }

    .modal-box input:focus,
    .modal-box select:focus,
    .modal-box textarea:focus {
        outline: none;
        border-color: #4f46e5;
        box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
    }

    /* ===== Modal Actions ===== */
    .modal-actions {
        margin-top: 32px;
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        padding-top: 24px;
        border-top: 1px solid #e5e7eb;
    }

    .modal-actions button {
        padding: 12px 28px;
        font-size: 0.95rem;
        border-radius: 10px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .btn-cancel {
        background-color: #f8fafc;
        border: 2px solid #e5e7eb;
        color: #374151;
    }

    .btn-cancel:hover {
        background-color: #f1f5f9;
        border-color: #d1d5db;
        transform: translateY(-1px);
    }

    .btn-submit {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        color: #fff;
        border: none;
        box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.3);
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

    /* Responsive Design */
    @media (max-width: 1024px) {
        .main-content-wrapper {
            flex-direction: column;
        }
        
        .side-panel {
            width: 100%;
            border-left: none;
            border-top: 1px solid #e5e7eb;
            max-height: 50vh;
            overflow-y: auto;
        }
        
        .tasks-area {
            max-height: 50vh;
        }
        
        .modal-box {
            padding: 24px;
            margin: 20px;
        }
    }

    @media (max-width: 768px) {
        .sidebar {
            width: 60px;
        }
        
        .sidebar.active {
            width: 200px;
        }
        
        .toolbar {
            flex-wrap: wrap;
            gap: 12px;
        }
        
        .search-form {
            order: 3;
            min-width: 100%;
            margin: 12px 0 0;
        }
        
        .priority-section {
            margin-bottom: 16px;
        }
        
        .task-actions {
            flex-wrap: wrap;
            justify-content: flex-end;
        }
    }
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
            <a href="#">
                <span class="sidebar-icon">🧠</span>
                <span class="sidebar-text">Brain</span>
                <span class="icon-tooltip">Brain</span>
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

    @if(session('success'))
    <div id="toast-success" class="toast-container" onclick="dismissToast()">
        <div class="toast-content">
            <span class="toast-icon">✨</span>
            <span class="toast-text">{{ session('success') }}</span>
        </div>
        <div class="toast-progress"></div>
    </div>

    <style>
        .toast-container {
            position: fixed;
            top: 40px;
            left: 50%;
            transform: translateX(-50%);
            min-width: 350px;
            max-width: 90%;
            background: #ffffff;
            border-bottom: 5px solid #10b981;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
            z-index: 10000;
            animation: dropIn 0.5s ease-out;
            cursor: pointer; /* Indicates it's clickable */
        }

        .toast-content {
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
        }

        .toast-text { 
            color: #1f2937; 
            font-weight: 600; 
            font-family: sans-serif;
            text-align: center;
        }

        .toast-progress {
            height: 4px;
            background: #10b981;
            width: 100%;
            animation: progress 7s linear forwards;
        }

        /* PAUSE ANIMATION ON HOVER */
        .toast-container:hover .toast-progress {
            animation-play-state: paused;
        }

        @keyframes dropIn {
            from { transform: translate(-50%, -100%); opacity: 0; }
            to { transform: translate(-50%, 0); opacity: 1; }
        }

        @keyframes progress {
            from { width: 100%; }
            to { width: 0%; }
        }
    </style>

    <script>
        // Store timeout ID to clear it if user clicks early
        let toastTimeout;

        function startToastTimer() {
            toastTimeout = setTimeout(() => {
                dismissToast();
            }, 7000); // 7 seconds
        }

        function dismissToast() {
            const toast = document.getElementById('toast-success');
            if (toast) {
                // Clear the automatic timer so it doesn't try to remove it twice
                clearTimeout(toastTimeout);
                
                toast.style.transition = "all 0.3s ease";
                toast.style.opacity = "0";
                toast.style.transform = "translate(-50%, -20px)";
                setTimeout(() => toast.remove(), 300);
            }
        }

        // Start the timer when the page loads
        startToastTimer();
    </script>
@endif

    <!-- Main Content Area -->
    <div class="main-content-area">
        <!-- Toolbar -->
        <div class="toolbar">
            <h1>Tasks Dashboard</h1>
            <form method="GET" action="{{ route('tasks.index') }}" class="search-form">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    placeholder="Search tasks..."
                >
                <input type="hidden" name="date" value="{{ $date }}">
                <input type="hidden" name="sort" value="{{ $sort }}">
                <input type="hidden" name="status" value="{{ $statusFilter }}">
                <input type="hidden" name="group_by" value="{{ $groupBy }}">
                <button type="submit">Search</button>
            </form>
            <button type="button" onclick="openCreateModal()">+ Add Task</button> 
        </div>

       

        <!-- Main Content Wrapper -->
        <div class="main-content-wrapper">
            <!-- Tasks Area -->
            <div class="tasks-area">
                @foreach($tasksGrouped as $group => $tasks)
                    <div class="priority-section">
                        <div class="priority-header">
                            @if($groupBy === 'due_date')
                                <div class="priority-dot medium"></div>
                                {{ \Carbon\Carbon::parse($group)->format('M d') }}
                            @else
                                @php
                                    $ui = config("task_ui.$groupBy.$group");
                                @endphp
                                <div class="priority-dot {{ $group }}"></div>
                                <h2>
                                    {{ $ui['icon'] ?? '' }}
                                    {{ $ui['label'] ?? ucfirst(str_replace('_', ' ', $group)) }} 
                                </h2>
                            @endif
                        </div>

                        @forelse($tasks as $task)
                            <div class="task-row {{ $task->status === 'completed' ? 'completed' : '' }}" onclick='openEditModal(@json($task))'>
                                <div class="task-main">
                                     <span class="subtask-checkbox">
                                        {{ $task->status === 'completed' ? '☑' : '☐' }}
                                     </span>
                                    <div class="task-title">
                                        {{ $task->title }} 
                                        @if($task->status !== 'completed' 
                                            && $task->due_date 
                                            && \Carbon\Carbon::parse($task->due_date)->startOfDay()->lt(\Carbon\Carbon::today()))
                                            <span class="overdue-label">⚠️ Incomplete</span>
                                        @endif
                                    </div>
                                    <div class="task-actions">
                                        <button type="button" onclick='event.stopPropagation(); openSubTaskCreateModal(@json($task))'>+ Sub Task</button> 
                                        <form id="ai-form" class="delete-form"  style="display: inline;">
                                            @csrf
                                            
                                            <button type="button" class="delete-btn" onclick="event.stopPropagation(); handleAiClick({{ $task->id }})">AI</button> 
                                        </form>
                                        <div id="status-msg"></div> ```
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                             class="delete-form" onsubmit="return confirm('Delete this task?')" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-btn" onclick="event.stopPropagation()">🗑</button> 
                                        </form>
                                    </div>
                                </div>
                                
                                <div class="task-meta">
                                    <span>📅 {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d') : 'No due date' }}</span>
                                    <span>🏅 {{ $task->points ?? '0' }}</span>
                                </div>
                                
                                
                                    <div class="subtasks-wrapper">
                                        <button class="subtask-toggle-btn" onclick="toggleSubtasks(event, {{ $task->id }})">▼</button>
                                        <div class="subtasks-container" id="subtask-container-{{ $task->id }}">
                                            @if($task->subtasks->count())
                                            @foreach($task->subtasks as $subtask) 
                                                <div class="subtask-row {{ $subtask->status === 'completed' ? 'completed' : '' }}" onclick='event.stopPropagation(); openSubTaskEditModal(@json($subtask))'>
                                                    <span class="subtask-checkbox">
                                                        {{ $subtask->status === 'completed' ? '☑' : '☐' }}
                                                    </span>
                                                    <span class="subtask-title">
                                                        {{ $subtask->title }}
                                                    </span>
                                                    @if($subtask->points)
                                                        <span class="subtask-points">
                                                            +{{ $subtask->points }}
                                                        </span>
                                                    @endif
                                                    <form action="{{ route('subtasks.destroy', $subtask->id) }}" method="POST"
                                                         class="delete-form" onsubmit="return confirm('Delete this subtask?')" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="delete-btn" onclick="event.stopPropagation()">🗑</button> 
                                                    </form>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div class="empty">No tasks in this priority</div>
                        @endforelse
                    </div>
                @endforeach
            </div>

            <!-- Side Panel (Calendar & Filters) -->
            <div class="side-panel">
                <div class="calendar-container">
                    <form method="GET" action="{{ route('tasks.index') }}">
                        <!-- Calendar Header -->
                        <div class="calendar-header">
                            <button type="button" id="prev-month">&lt;</button>
                            <span id="month-year"></span>
                            <button type="button" id="next-month">&gt;</button>
                        </div>

                        <!-- Weekday Labels -->
                        <div class="calendar-weekdays">
                            <div>Sun</div><div>Mon</div><div>Tue</div><div>Wed</div><div>Thu</div><div>Fri</div><div>Sat</div>
                        </div>

                        <!-- Dates -->
                        <div id="calendar-dates"></div>

                        <!-- Hidden inputs -->
                        <input type="hidden" name="date" id="selected-date" value="{{ $date }}">
                        
                        <!-- Filter Cards -->
                        <div class="filter-cards">
                            <div class="filter-card">
                                <label>Sort Tasks</label>
                                <select name="sort" onchange="this.form.submit()">
                                    <option value="created_at" {{ $sort === 'created_at' ? 'selected' : '' }}>Newest First</option>
                                    <option value="priority" {{ $sort === 'priority' ? 'selected' : '' }}>Priority (High to Low)</option>
                                    <option value="due_date" {{ $sort === 'due_date' ? 'selected' : '' }}>Due Date (Soonest)</option>
                                    <option value="status" {{ $sort === 'status' ? 'selected' : '' }}>Status</option>
                                </select>
                            </div>
                            
                            <div class="filter-card">
                                <label>Filter Status</label>
                                <select name="status" onchange="this.form.submit()">
                                    <option value="" {{ $statusFilter === null ? 'selected' : '' }}>Show All Tasks</option>
                                    
                                    <option value="in_progress" {{ $statusFilter === 'in_progress' ? 'selected' : '' }}>⚙️ In Progress</option>
                                    <option value="completed" {{ $statusFilter === 'completed' ? 'selected' : '' }}>✅ Completed Tasks</option>
                                </select>
                            </div>
                            
                            <div class="filter-card">
                                <label>Group View</label>
                                <select name="group_by" onchange="this.form.submit()">
                                    <option value="priority" {{ $groupBy === 'priority' ? 'selected' : '' }}>By Priority Level</option>
                                    <option value="status" {{ $groupBy === 'status' ? 'selected' : '' }}>By Status</option>
                                    <option value="category" {{ $groupBy === 'category' ? 'selected' : '' }}>By Category</option>
                                    <option value="due_date" {{ $groupBy === 'due_date' ? 'selected' : '' }}>By Due Date</option>
                                </select>
                            </div>
                        </div>
                        
                        <button type="submit">Apply Filters</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="taskModal" class="modal-overlay" style="display:none;">
    <div class="modal-box">
        <h2 id="modalTitle" class="modal-title">New Task</h2>
        <form id="taskForm" method="POST">
            @csrf
            <input type="hidden" id="formMethod" name="_method" value="POST">

            <div class="input-group">
                <label>Title</label>
                <input type="text" name="title" id="taskTitle" required>
            </div>

            <div class="input-group">
                <label>Description</label>
                <textarea name="description" id="taskDescription" rows="2"></textarea>
            </div>

            <div class="modal-row">
                <div class="input-group">
                    <label>Category</label>
                    <select name="category" id="taskType" required>
                        <option value="chores">Chores</option>
                        <option value="exercise">Exercise</option>
                        <option value="study">Study</option>
                        <option value="assignment">Assignment</option>
                    </select>
                </div>
                <div class="input-group">
                    <label>Priority</label>
                    <select name="priority" id="taskPriority" required>
                        <option value="high">High</option>
                        <option value="medium" selected>Medium</option>
                        <option value="low">Low</option>
                    </select>
                </div>
            </div>

            <div class="modal-row">
                <div class="input-group">
                     <label>Status</label>
            <select name="status" id="taskStatus" required>
                <option value="in_progress">In Progress</option>
                <option value="completed">Completed</option>
            </select>
                </div>
                <div class="input-group">
                    <label>Points ★</label>
                    <input type="text" name="points" id="taskPoints" placeholder="✨ AI calculating rewards..." readonly style="background: #f9fafb; border-style: dashed; color: #9ca3af;">
                </div>
            </div>

            <div class="modal-row">
                <div class="input-group">
                    <label>Assignee</label>
                    <input type="text" name="assignee" id="taskAssignee">
                </div>
                <div class="input-group">
                    <label>Due Date</label>
                    <input type="date" name="due_date" id="taskDueDate">
                </div>
            </div>

            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeModal()">Cancel</button>
                <button type="submit" class="btn-submit">Save Task</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal subtask (Hidden by default) -->
<div id="subtaskModal" class="modal-overlay" style="display:none;">
    <div class="modal-box">
        <h2 id="submodalTitle" class="modal-title">New Sub Task</h2>
        <form id="subtaskForm" method="POST">
            @csrf
            <input type="hidden" id="subtaskformMethod" name="_method" value="POST">
            <label>Title</label>
            <input type="text" name="title" id="subtaskTitle" required>
            <label>Description</label>
            <textarea name="description" id="subtaskDescription"></textarea>
            <label>Status</label>
            <select name="status" id="subtaskStatus" required>
                
                <option value="in_progress">In Progress</option>
                <option value="completed">Completed</option>
            </select>


            



            <label>Points</label>
            <input type="number" name="points" id="subtaskPoints" min="0" value="0">
            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeSubTaskModal()">Cancel</button>
                <button type="submit" class="btn-submit">Save</button>
            </div>
        </form>
    </div>
</div>

<script>

    async function handleAiClick(taskId) {
        // 1. Prevent the page from freezing/reloading
        document.getElementById('status-msg').innerText = "AI is thinking...";

        // 2. Call the Controller in the background (AJAX)
        // We don't await the AI to finish, we just trigger the start
        fetch(`ai/task-breakdown/${taskId}`, { 
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        });

        

        // 3. Start the Heartbeat immediately!
        // Since we didn't reload, this timer will actually live!
        waitForAI(taskId);
    }
    
    function waitForAI(taskId) {
    // 1. Tell the user we are waiting
    document.getElementById('status-msg').innerText = "AI is thinking...";

    // 2. Start a 'Heartbeat' (Interval)
    const checkTimer = setInterval(async () => {
        console.log("Checking for data..."); // STEP 1
        
        // 3. Call that "Weird" Route
        const response = await fetch(`/tasks/${taskId}/subtasks-data`);
        const result = await response.json(); // Convert the raw bag into JS objects

        console.log("Server says ready is:", result.ready); // STEP 2

        // 4. Check the 'ready' signal we built in PHP
        if (result.ready === true) {
            console.log("Data received:", result.data); // STEP 3
            
            // 5. STOP the heartbeat
            clearInterval(checkTimer); 

            // 6. Show the data!
            updateSubtasksUI(result.data, taskId); 
        }
    }, 3000); // Repeat every 3 seconds
}

function updateSubtasksUI(subtasks, taskId) {
    const targetId = 'subtask-container-' + taskId;
    const container = document.getElementById(targetId);

    console.log("Searching for ID:", targetId);

    if (!container) {
        console.warn("Could not find container:", targetId);
        return; 
    }

    // 1. Clear the container ONCE before the loop starts
    container.innerHTML = ''; 

    // 2. Use a temporary variable to build the full list
    let fullHtml = '';

    subtasks.forEach(task => {
        const isCompleted = task.status === 'completed';
        const checkbox = isCompleted ? '☑' : '☐';
        const completedClass = isCompleted ? 'completed' : '';
        const deleteUrl = `/subtasks/${task.id}`; 
        
        // Build the HTML for this specific subtask row
        fullHtml += `
            <div class="subtask-row ${completedClass}" 
                 onclick='event.stopPropagation(); openSubTaskEditModal(${JSON.stringify(task)})'>
                
                <span class="subtask-checkbox">${checkbox}</span>
                <span class="subtask-title">${task.title}</span>
                ${task.points ? `<span class="subtask-points">+${task.points}</span>` : ''}

                <form action="${deleteUrl}" method="POST" class="delete-form" 
                      onsubmit="return confirm('Delete this subtask?')" style="display: inline;">
                    <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content}">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="delete-btn" onclick="event.stopPropagation()">🗑</button> 
                </form>
            </div>
        `;
    });

    // 3. Inject all subtasks at once
    container.innerHTML = fullHtml;
    
    // 4. Important: Force the container to expand so the user sees it
    container.style.maxHeight = container.scrollHeight + "px";
    container.style.opacity = "1";
    
    console.log("UI Update Complete for Task:", taskId);
}

    // Sidebar toggle
    const sidebar = document.getElementById('sidebar');
    document.getElementById('sidebarToggle').addEventListener('click', () => {
        sidebar.classList.toggle('active');
    });

    // Store subtask toggle state
    const subtaskStates = {};

    // Toggle subtask visibility - fixed with event propagation
    function toggleSubtasks(event, taskId) {
        event.stopPropagation(); // Prevent triggering parent click
        event.preventDefault(); // Prevent any default behavior
        
        const container = document.getElementById('subtask-container-' + taskId);
        const toggleBtn = event.target;
        
        if (subtaskStates[taskId]) {
            // Hide subtasks
            container.style.maxHeight = '0';
            container.style.opacity = '0';
            container.style.marginTop = '0';
            toggleBtn.textContent = '▶'; 
        } else {
            // Show subtasks
            container.style.maxHeight = container.scrollHeight + 'px';
            container.style.opacity = '1';
            container.style.marginTop = '8px';
            toggleBtn.textContent = '▼';
        }
        
        subtaskStates[taskId] = !subtaskStates[taskId];
    }

    // Initialize all subtask containers as expanded by default
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.subtasks-container').forEach(container => {
            const taskId = container.id.split('-')[1];
            subtaskStates[taskId] = true; // Default to expanded
            
            // Set initial state
            container.style.maxHeight = container.scrollHeight + 'px';
            container.style.opacity = '1';
            container.style.marginTop = '8px';
        });
    });

    // Modal functions - EXACTLY AS YOUR ORIGINAL CODE
    function openCreateModal() {
        document.getElementById("modalTitle").innerText = "Create Task"; 
        document.getElementById("taskForm").action = "/tasks";
        document.getElementById("formMethod").value = "POST";

        // Clear fields
        document.getElementById("taskTitle").value = "";
        document.getElementById("taskAssignee").value = "";
        document.getElementById("taskDueDate").value="{{ now()->format('Y-m-d') }}"; 
        document.getElementById("taskPriority").value = "medium";
        
        document.getElementById("taskDescription").value = "";
        document.getElementById("taskType").value = "chores";
        const pointsField = document.getElementById("taskPoints").value = "0";
        const statusField = document.getElementById("taskStatus");
        

        document.getElementById("taskModal").style.display = "flex";
    }

    function openEditModal(task) {
        document.getElementById("modalTitle").innerText = "Edit Task";
        document.getElementById("taskForm").action = "/tasks/" + task.id;
        document.getElementById("formMethod").value = "PUT";

        // Fill fields
        document.getElementById("taskTitle").value = task.title;
        document.getElementById("taskDescription").value = task.description || "";
        document.getElementById("taskAssignee").value = task.assignee || "";
        document.getElementById("taskDueDate").value = task.due_date || "";
        document.getElementById("taskPriority").value = task.priority;
        document.getElementById("taskPoints").value = task.points || "0";
        document.getElementById("taskStatus").value = task.status;
        document.getElementById("taskType").value = task.category;

        document.getElementById("taskModal").style.display = "flex";
    }

    function closeModal() {
        document.getElementById("taskModal").style.display = "none";
    }

    // Sub task modal functions - EXACTLY AS YOUR ORIGINAL CODE
    function openSubTaskCreateModal(task) {
        document.getElementById("submodalTitle").innerText = "Create Sub Task"; 
        document.getElementById("subtaskForm").action = "/subtasks/" + task.id;
        document.getElementById("subtaskformMethod").value = "POST";

        // Clear fields
        document.getElementById("subtaskTitle").value = "";
        
        document.getElementById("subtaskDescription").value = "";
        document.getElementById("subtaskPoints").value = "0";

        document.getElementById("subtaskModal").style.display = "flex";
    }

    function openSubTaskEditModal(subtask) {
        document.getElementById("submodalTitle").innerText = "Edit Sub Task";
        document.getElementById("subtaskForm").action = "/subtasks/" + subtask.id + "/" + subtask.task_id;
        document.getElementById("subtaskformMethod").value = "PUT";

        document.getElementById("subtaskTitle").value = subtask.title;
        document.getElementById("subtaskDescription").value = subtask.description || "";
        document.getElementById("subtaskPoints").value = subtask.points || "0";
        document.getElementById("subtaskStatus").value = subtask.status;

        document.getElementById("subtaskModal").style.display = "flex";
    }

    function closeSubTaskModal() {
        document.getElementById("subtaskModal").style.display = "none";
    }

    // Tooltip positioning
    document.querySelectorAll('.sidebar a').forEach(link => {
        link.addEventListener('mouseenter', function() {
            const tooltip = this.querySelector('.icon-tooltip');
            if (tooltip) {
                const rect = this.getBoundingClientRect();
                tooltip.style.top = rect.top + 'px';
            }
        });
    });

    // Calendar functionality - EXACTLY AS YOUR ORIGINAL CODE
    const calendarDates = document.getElementById("calendar-dates");
    const monthYearEl = document.getElementById("month-year");
    const selectedInput = document.getElementById("selected-date");

    let today = new Date();
    let selectedDate = selectedInput.value ? new Date(selectedInput.value) : today;
    let currentMonth = today.getMonth();
    let currentYear = today.getFullYear();

    function renderCalendar(year, month) {
        calendarDates.innerHTML = "";

        const monthNames = ["January","February","March","April","May","June","July","August","September","October","November","December"];
        monthYearEl.textContent = `${monthNames[month]} ${year}`;

        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();

        for (let i = 0; i < firstDay; i++) {
            calendarDates.appendChild(document.createElement("div"));
        }

        for (let day = 1; day <= daysInMonth; day++) {
            const dayEl = document.createElement("div");
            dayEl.textContent = day;

            const thisDate = new Date(year, month, day);

            if (thisDate.toDateString() === today.toDateString()) {
                dayEl.classList.add("today");
            }
            if (selectedDate && thisDate.toDateString() === selectedDate.toDateString()) {
                dayEl.classList.add("selected");
            }

            dayEl.addEventListener("click", () => {
                selectedDate = thisDate;
                selectedInput.value = `${selectedDate.getFullYear()}-${String(selectedDate.getMonth()+1).padStart(2,'0')}-${String(selectedDate.getDate()).padStart(2,'0')}`;
                renderCalendar(currentYear, currentMonth);
            });

            calendarDates.appendChild(dayEl);
        }
    }

    document.getElementById("prev-month").addEventListener("click", () => {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        renderCalendar(currentYear, currentMonth);
    });

    document.getElementById("next-month").addEventListener("click", () => {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        renderCalendar(currentYear, currentMonth);
    });

    // Initial render
    renderCalendar(currentYear, currentMonth);
</script>
</x-app-layout>