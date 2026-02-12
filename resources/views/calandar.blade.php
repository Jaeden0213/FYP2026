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
        overflow: hidden;
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

    .view-toggle {
        display: flex;
        gap: 8px;
        margin: 0 20px;
    }

    .view-toggle button {
        padding: 8px 16px;
        border: 2px solid #e5e7eb;
        background: white;
        border-radius: 6px;
        color: #6b7280;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .view-toggle button:hover {
        border-color: #4f46e5;
        color: #4f46e5;
    }

    .view-toggle button.active {
        background: #4f46e5;
        border-color: #4f46e5;
        color: white;
    }

    .toolbar-actions {
        display: flex;
        gap: 12px;
        align-items: center;
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

    /* ===== Calendar View Container ===== */
    .calendar-view-container {
        flex: 1;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        background: white;
        
    }

    /* ===== Calendar Header ===== */
    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px 24px;
        border-bottom: 1px solid #e5e7eb;
        background: white;
        flex-shrink: 0;
    }

    .calendar-nav {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .calendar-nav button {
        padding: 8px 12px;
        border: 2px solid #e5e7eb;
        background: white;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
    }

    .calendar-nav button:hover {
        border-color: #4f46e5;
        background: #f5f3ff;
    }

    .calendar-current {
        font-size: 1.25rem;
        font-weight: 700;
        color: #111827;
        min-width: 200px;
        text-align: center;
    }

    .calendar-view-options {
        display: flex;
        gap: 8px;
    }

    .calendar-view-options button {
        padding: 8px 16px;
        border: 2px solid #e5e7eb;
        background: white;
        border-radius: 6px;
        color: #6b7280;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .calendar-view-options button:hover {
        border-color: #4f46e5;
        color: #4f46e5;
    }

    .calendar-view-options button.active {
        background: #4f46e5;
        border-color: #4f46e5;
        color: white;
    }

    /* ===== Calendar Grid ===== */
    .calendar-grid {
        flex: 1;
        overflow-y: auto;
        padding: 0 24px 24px;
        background: #f8fafc;
    }

    /* ===== Month View ===== */
    .month-view {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .month-weekdays {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        background: white;
        border-bottom: 1px solid #e5e7eb;
        position: sticky;
        top: 0;
        z-index: 5;
    }

    .month-weekday {
        padding: 12px 8px;
        text-align: center;
        font-weight: 600;
        color: #6b7280;
        font-size: 0.9rem;
        border-right: 1px solid #e5e7eb;
    }

    .month-weekday:last-child {
        border-right: none;
    }

    .month-days {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        grid-template-rows: repeat(6, 1fr);
        flex: 1;
        background: white;
        border: 1px solid #e5e7eb;
        border-top: none;
    }

    .calendar-day {
        border-right: 1px solid #e5e7eb;
        border-bottom: 1px solid #e5e7eb;
        padding: 8px;
        min-height: 260px;
        position: relative;
        background: white;
        transition: all 0.2s ease;
        overflow: hidden;
    }

    .calendar-day:hover {
        background: #f9fafb;
    }

    .calendar-day.other-month {
        background: #f8fafc;
        color: #9ca3af;
    }

    .calendar-day.today {
        background: #f0f9ff;
        border-left: 3px solid #3b82f6;
    }

    .calendar-day.selected {
        background: #f5f3ff;
        border-left: 3px solid #4f46e5;
    }

    .day-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 8px;
        padding-bottom: 8px;
        border-bottom: 1px solid #e5e7eb;
    }

    .day-number {
        font-size: 1.1rem;
        font-weight: 600;
        color: #374151;
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }

    .calendar-day.today .day-number {
        background: #3b82f6;
        color: white;
    }

    .calendar-day.selected .day-number {
        background: #4f46e5;
        color: white;
    }

    .add-task-btn {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        border: 1px solid #e5e7eb;
        background: white;
        color: #6b7280;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        transition: all 0.2s ease;
    }

    .add-task-btn:hover {
        background: #4f46e5;
        color: white;
        border-color: #4f46e5;
        transform: scale(1.1);
    }

    .day-tasks {
        max-height: 380px;
        overflow-y: auto;
    }

    .calendar-task {
        margin-bottom: 6px;
        padding: 6px 8px;
        border-radius: 6px;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.2s ease;
        border-left: 3px solid;
        background: white;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .calendar-task:hover {
        transform: translateX(2px);
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
    }

    /* High Priority - Darker Red */
.calendar-task.high {
    border-left: 4px solid #b91c1c; /* Deep Red */
    background: #fee2e2;            /* Stronger Soft Red */
    color: #7f1d1d;                 /* Dark Red Text for contrast */
}

/* Medium Priority - Richer Amber/Orange */
.calendar-task.medium {
    border-left: 4px solid #d97706; /* Rich Amber */
    background: #fef3c7;            /* Stronger Soft Orange */
    color: #78350f;                 /* Dark Brown/Orange Text */
}

/* Low Priority - Forest Green */
.calendar-task.low {
    border-left: 4px solid #15803d; /* Forest Green */
    background: #dcfce7;            /* Stronger Soft Green */
    color: #14532d;                 /* Deep Green Text */
}

/* Add a hover effect to make them pop even more */
.calendar-task:hover {
    filter: brightness(0.95); /* Slightly darkens the whole block on hover */
}

    .day-task.completed, .calendar-task.completed { 
       opacity: 0.6 !important;
    text-decoration: line-through;
    background-color: #f3f4f6 !important; /* Light gray */
    border-left-color: #9ca3af !important;
    color: #6b7280 !important;
    }

    .task-title {
        font-weight: 500;
        margin-bottom: 2px;
    }

    .task-time {
        font-size: 0.7rem;
        color: #6b7280;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .more-tasks {
        font-size: 0.8rem;
        color: #4f46e5;
        font-weight: 500;
        cursor: pointer;
        padding: 4px 8px;
        border-radius: 4px;
        transition: all 0.2s ease;
    }

    .more-tasks:hover {
        background: #f5f3ff;
    }

    /* ===== Week View ===== */
    .week-view {
        display: flex;
        flex-direction: column;
        height: 100%;
        background: white;
    }

    .week-header {
        display: grid;
        grid-template-columns: 60px repeat(7, 1fr);
        background: white;
        border-bottom: 1px solid #e5e7eb;
        position: sticky;
        top: 0;
        z-index: 5;
    }

    .week-time-label {
        border-right: 1px solid #e5e7eb;
        text-align: center;
        font-weight: 600;
        color: #6b7280;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .week-day-header {
        padding: 12px 8px;
        text-align: center;
        border-right: 1px solid #e5e7eb;
    }

    .week-day-header:last-child {
        border-right: none;
    }

    .week-day-name {
        font-size: 0.9rem;
        color: #6b7280;
        margin-bottom: 4px;
    }

    .week-day-date {
        font-size: 1.2rem;
        font-weight: 700;
        color: #111827;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin: 0 auto;
    }

    .week-day-header.today .week-day-date {
        background: #3b82f6;
        color: white;
    }

    .week-day-header.selected .week-day-date {
        background: #4f46e5;
        color: white;
    }

    .week-grid {
        display: grid;
        grid-template-columns: 60px repeat(7, 1fr);
        flex: 1;
        overflow-y: auto;
    }

    .time-slot {
        height: 60px;
        border-bottom: 1px solid #e5e7eb;
        border-right: 1px solid #e5e7eb;
        position: relative;
        background: white;
        height: 120px !important;
        line-height: 1.5; /* Keeps the text at the top of the taller box */
    }

    .time-label {
        position: absolute;
        top: -10px;
        left: 4px;
        font-size: 0.8rem;
        color: #9ca3af;
    }

    .week-day {
        border-right: 1px solid #e5e7eb;
        border-bottom: 1px solid #e5e7eb;
        position: relative;
        background: white;
        height: 120px !important;
    }

    .week-day:last-child {
        border-right: none;
    }

    .week-task {
        position: absolute;
        left: 2px;
        right: 2px;
        border-radius: 4px;
        padding: 4px 6px;
        font-size: 0.75rem;
        cursor: pointer;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        border-left: 3px solid;
        z-index: 10;
        outline: 1.5px solid rgba(0, 0, 0, 0.15); /* Suble dark outline */
        outline-offset: -1px; /* Pulls it slightly inside for a cleaner look */
    }

    /* High Priority - Darker Red */
.week-task.high {
    border-left: 4px solid #b91c1c; /* Deep Red */
    background: #fee2e2;            /* Stronger Soft Red */
    color: #7f1d1d;                 /* Dark Red Text for contrast */
}

/* Medium Priority - Richer Amber/Orange */
.week-task.medium {
    border-left: 4px solid #d97706; /* Rich Amber */
    background: #fef3c7;            /* Stronger Soft Orange */
    color: #78350f;                 /* Dark Brown/Orange Text */
}

/* Low Priority - Forest Green */
.week-task.low {
    border-left: 4px solid #15803d; /* Forest Green */
    background: #dcfce7;            /* Stronger Soft Green */
    color: #14532d;                 /* Deep Green Text */
}

/* Add a hover effect to make them pop even more */
.week-task:hover {
    filter: brightness(0.95); /* Slightly darkens the whole block on hover */
}

    .week-task.completed ,.day-task.completed, .day-tasks.completed {
    opacity: 0.6 !important;
    text-decoration: line-through;
    background-color: #f3f4f6 !important; /* Light gray */
    border-left-color: #9ca3af !important;
    color: #6b7280 !important;

    z-index: 5; 
    pointer-events: auto; /* Ensures you can still click/hover it */
    
}

/* Ensure the title inside also looks done */
.week-task.completed .week-task-title {
    text-decoration: line-through;
}

/* Fix the double comma and selector error here */
.week-task-time, 
.day-task.completed {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

    

    /* ===== Day View ===== */
    .day-view {
        display: flex;
        flex-direction: column;
        height: 100%;
        background: white;
    }

    .day-header-view {
        padding: 16px 24px;
        text-align: center;
        border-bottom: 1px solid #e5e7eb;
        background: white;
        position: sticky;
        top: 0;
        z-index: 5;
    }

    .day-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #111827;
        margin-bottom: 8px;
    }

    .day-subtitle {
        font-size: 1rem;
        color: #6b7280;
    }

    .day-grid {
        display: grid;
        grid-template-columns: 80px 1fr;
        flex: 1;
        overflow-y: auto;
    }

    .day-time-column {
        background: #f8fafc;
    }

    .day-time-slot {
        height: 60px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        color: #6b7280;
        font-weight: 500;
        height: 120px !important;
        line-height: 1.5; /* Keeps the text at the top of the taller box */
    }

    .day-schedule {
        position: relative;
    }

    .day-hour {
        height: 60px;
        border-bottom: 1px solid #e5e7eb;
        position: relative;
        height: 120px !important; /* Changed from 60px */
        position: relative;
    }

    #week-header {
    padding-right: 15px; /* Manually match the average scrollbar width */
}

    .day-task {
        position: absolute;
        left: 8px;
        right: 8px;
        border-radius: 6px;
        padding: 8px 12px;
        cursor: pointer;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        border-left: 4px solid;
        overflow: hidden;
       outline: 1.5px solid rgba(0, 0, 0, 0.15); /* Suble dark outline */
    outline-offset: -1px; /* Pulls it slightly inside for a cleaner look */
    transition: all 0.2s ease;
    z-index: 1;
    pointer-events: auto; /* Make sure it can be clicked */
    }

    .week-task:hover, .day-task:hover {
    z-index: 100 !important;
    transform: scale(1.02); /* Makes it slightly bigger */
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    opacity: 1 !important;
    }

    .day-task.high {
        border-left-color: #ef4444;
        background: #fef2f2;
    }

    .day-task.medium {
        border-left-color: #f59e0b;
        background: #fffbeb;
    }

    .day-task.low {
        border-left-color: #10b981;
        background: #f0fdf4;
    }

    .day-task-title {
        font-weight: 600;
        margin-bottom: 4px;
        font-size: 0.9rem;
    }

    .day-task-time {
        font-size: 0.8rem;
        color: #6b7280;
    }

    /* ===== Modal Overlay ===== */
    .modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;         /* Use Flexbox to center */
    justify-content: center;
    align-items: flex-start; /* Start at the top... */
    padding: 20px;         /* ...but give it some "breathing room" */
    overflow-y: auto;      /* This allows the OVERLAY to scroll, not just the modal */
    z-index: 1000;
    }

    /* ===== Modal Box ===== */
    .modal-box {
        background: #fff;
        border-radius: 16px;
        padding: 32px;
        width: 100%;
        max-width: 700px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        animation: modalSlideUp 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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

    /* Quick Add Task Form */
    .quick-add-form {
        position: absolute;
        top: 40px;
        right: 8px;
        background: white;
        border-radius: 8px;
        padding: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        border: 1px solid #e5e7eb;
        z-index: 10;
        min-width: 200px;
        display: none;
    }

    .quick-add-form input {
        width: 100%;
        padding: 8px 12px;
        border-radius: 6px;
        border: 1px solid #e5e7eb;
        margin-bottom: 8px;
    }

    .quick-add-form button {
        width: 100%;
        padding: 8px;
        background: #4f46e5;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .month-days .calendar-day {
            min-height: 100px;
        }
        
        .calendar-grid {
            padding: 0 16px 16px;
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
        
        .calendar-nav,
        .calendar-view-options {
            flex-wrap: wrap;
            gap: 8px;
        }
        
        .month-view .calendar-day {
            min-height: 80px;
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
            <a href="#" class="active">
                <span class="sidebar-icon">📅</span>
                <span class="sidebar-text">Calendar</span>
                <span class="icon-tooltip">Calendar</span>
            </a>
            <a href="#" id="listViewBtn">
                <span class="sidebar-icon">📋</span>
                <span class="sidebar-text">List View</span>
                <span class="icon-tooltip">List View</span>
            </a>
            <a href="#">
                <span class="sidebar-icon">⚙️</span>
                <span class="sidebar-text">Settings</span>
                <span class="sidebar-tooltip">Settings</span>
            </a>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="main-content-area">
        <!-- Toolbar -->
        <div class="toolbar">
            <h1>Calendar View</h1>
            <div class="view-toggle">
                <button id="listViewToggle">📋 List</button>
                <button id="calendarViewToggle" class="active">📅 Calendar</button>
            </div>
            <div class="toolbar-actions">
                <button type="button" onclick="openCreateModal()">+ Add Task</button> 
            </div>
        </div>

        <!-- Calendar View Container, week  --> 
        <div class="calendar-view-container">
            <!-- Calendar Header -->
            <div class="calendar-header">
                <div class="calendar-nav">
                    <button id="prev-year" title="Previous Year">«</button>
                    <button id="prev-month" title="Previous Month">‹</button>
                    <div class="calendar-current" id="current-month-year"></div>
                    <button id="next-month" title="Next Month">›</button>
                    <button id="next-year" title="Next Year">»</button>
                    <button id="today-btn" style="margin-left: 12px;">Today</button>
                </div>
                <div class="calendar-view-options">
                    <button id="month-view-btn" class="active">Month</button>
                    <button id="week-view-btn" >Week</button>
                    <button id="day-view-btn">Day</button>
                </div>
            </div>

            <!-- Calendar Grid -->
            <div class="calendar-grid">
                <!-- Month View (Default) -->
                <div class="month-view" id="month-view">
                    <div class="month-weekdays">
                        <div class="month-weekday">Sunday</div>
                        <div class="month-weekday">Monday</div>
                        <div class="month-weekday">Tuesday</div>
                        <div class="month-weekday">Wednesday</div>
                        <div class="month-weekday">Thursday</div>
                        <div class="month-weekday">Friday</div>
                        <div class="month-weekday">Saturday</div>
                    </div>
                    <div class="month-days" id="month-days">
                        <!-- Generated by JavaScript -->
                    </div>
                </div>

                <!-- Week View (Hidden by default) -->
                <div class="week-view" id="week-view" style="display: none;">
                    <div class="week-header" id="week-header">
                        <!-- Generated by JavaScript -->
                    </div>
                    <div class="week-grid" id="week-grid">
                        <!-- Generated by JavaScript -->
                    </div>
                </div>

                <!-- Day View (Hidden by default) -->
                <div class="day-view" id="day-view" style="display: none;">
                    <div class="day-header-view">
                        <div class="day-title" id="day-title"></div>
                        <div class="day-subtitle" id="day-subtitle"></div>
                    </div>
                    <div class="day-grid" id="day-grid">
                        <!-- Generated by JavaScript -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modals -->
<div id="taskModal" class="modal-overlay" style="display:none;">
    <div class="modal-box">
        <h2 id="modalTitle" class="modal-title">New Task</h2>
        <form id="taskForm" method="POST">
            @csrf
            <input type="hidden" id="formMethod" name="_method" value="POST">
            <input type="hidden" id="selectedDate" name="due_date">
            
            <label>Title</label>
            <input type="text" name="title" id="taskTitle" required>
            
            <label>Description</label>
            <textarea name="description" id="taskDescription"></textarea>
            
            <label>Category</label>
            <select name="category" id="taskType" required>
                <option value="chores">Chores</option>
                <option value="exercise">Exercise</option>
                <option value="study">Study</option>
                <option value="assignment">Assignment</option>
                <option value="work">Work</option>
                <option value="personal">Personal</option>
            </select>
            
            <label>Priority</label>
            <select name="priority" id="taskPriority" required>
                <option value="high">High</option>
                <option value="medium" selected>Medium</option>
                <option value="low">Low</option>
            </select>
            
            <label>Status</label>
            <select name="status" id="taskStatus" required>
                <option value="pending" selected>Pending</option>
                <option value="in_progress">In Progress</option>
                <option value="completed">Completed</option>
            </select>
            
            <label>Assignee</label>
            <input type="text" name="assignee" id="taskAssignee">
            
            <label>Start Time (Optional)</label>
            <input type="time" name="start_time" id="taskStartTime">
            
            <label>End Time (Optional)</label>
            <input type="time" name="end_time" id="taskEndTime">
            
            <label>Points</label>
            <input type="number" name="points" id="taskPoints" min="0" value="0">
            
            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeModal()">Cancel</button>
                <button type="submit" class="btn-submit">Save</button>
            </div>

            <form id="deleteForm" method="POST" style="display:none;">
                @csrf
                @method('DELETE')
            </form>

          
    </form>
        </form>
    </div>
</div>

<script>
    // Calendar state
    let currentDate = new Date(); //return today's date
    let currentView = 'month'; // 'month', 'week', or 'day'
    let allTasks = {!! json_encode($tasks) !!}; // Pass tasks from controller, obj -> json 

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        // Sidebar toggle
        const sidebar = document.getElementById('sidebar'); // store ref of an object, so can sidebar.innerHTML, and other HTML obj attributes
        document.getElementById('sidebarToggle').addEventListener('click', () => {
            sidebar.classList.toggle('active'); // in ur css, active means pop up kinda
        });// if active class is not there, add it, if its there, remove it. so no need if else

        // View toggle buttons
        document.getElementById('listViewToggle').addEventListener('click', function() {
            window.location.href = "{{ route('tasks.index') }}?view=list";
        });

        document.getElementById('calendarViewToggle').addEventListener('click', function() {
            // Already on calendar view
        });

        document.getElementById('listViewBtn').addEventListener('click', function(e) {
            e.preventDefault();
            window.location.href = "{{ route('tasks.index') }}?view=list"; //view=list its a query param, neh the stuff in ur url ah in browser, so that it shows list, extra info
        });// tis is basically accessing ur browser's url bar 




        // Calendar navigation of year, month
        document.getElementById('prev-year').addEventListener('click', () => {
            currentDate.setFullYear(currentDate.getFullYear() - 1); //2025, 4 digits year
            renderCalendar(); //after a change in year, need to rerender the view
        });

        document.getElementById('prev-month').addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar();
        });

        document.getElementById('next-month').addEventListener('click', () => {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar();
        });

        document.getElementById('next-year').addEventListener('click', () => {
            currentDate.setFullYear(currentDate.getFullYear() + 1);
            renderCalendar();
        });

        document.getElementById('today-btn').addEventListener('click', () => {
            currentDate = new Date();
            renderCalendar();
        });




        // View options
        document.getElementById('month-view-btn').addEventListener('click', () => {
            switchView('month');
        });

        document.getElementById('week-view-btn').addEventListener('click', () => {
            switchView('week');
        });

        document.getElementById('day-view-btn').addEventListener('click', () => {
            switchView('day');
        });

        // Initial render
        renderCalendar();
    });

    // Switch between views
    function switchView(view) {
        currentView = view;
        
        // Update button states
        document.querySelectorAll('.calendar-view-options button').forEach(btn => {
            btn.classList.remove('active');// loop tru all buttons and remove active
        });
        document.getElementById(`${view}-view-btn`).classList.add('active'); // watever view now, active that button so it lights up purple
        
        // Show/hide views
        document.getElementById('month-view').style.display = view === 'month' ? 'flex' : 'none'; // is the current view === ? yes then flex (display), no the none
        document.getElementById('week-view').style.display = view === 'week' ? 'flex' : 'none';
        document.getElementById('day-view').style.display = view === 'day' ? 'flex' : 'none';
        
        renderCalendar();
    }

    // Render calendar based on current view
    function renderCalendar() {
        if (currentView === 'month') {
            renderMonthView();
        } else if (currentView === 'week') {
            renderWeekView();
        } else {
            renderDayView();
        }
    }

    // Render month view
    function renderMonthView() {
        const monthYearEl = document.getElementById('current-month-year');
        const monthNames = ["January", "February", "March", "April", "May", "June",
                          "July", "August", "September", "October", "November", "December"];
        monthYearEl.textContent = `${monthNames[currentDate.getMonth()]} ${currentDate.getFullYear()}`; // Feb 2026
        //currentDate.getMonth() returns 0-11
        
        const monthDaysEl = document.getElementById('month-days');
        monthDaysEl.innerHTML = '';
        
        const year = currentDate.getFullYear(); //2026
        const month = currentDate.getMonth(); //1 feb
        const today = new Date();
        
        // Get first day of month
        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0); // so im taking march, and 0, so its the last day of feb
        const daysInMonth = lastDay.getDate();
        const startingDay = firstDay.getDay(); // 0 = Sunday 1 = mon
        
        // Create days
        let dayCount = 1;
        
        for (let i = 0; i < 42; i++) { // 6 weeks * 7 days
            const dayEl = document.createElement('div');
            
                        if (i < startingDay) {
                dayEl.classList.add('calendar-day', 'other-month');
                
                // The "Magic" Math: 
                // We take the 1st of the current month and subtract 
                // how many boxes we are away from it.
                const prevMonthDate = new Date(year, month, i - startingDay + 1);
                
                dayEl.innerHTML = `
                    <div class="day-header">
                        <div class="day-number">${prevMonthDate.getDate()}</div>
                    </div>
                `;
                // NO dayCount++ here! We don't want to touch dayCount 
                // until we reach the actual 1st of the month.
            } else if(dayCount > daysInMonth) { // the 1s before and after a month, filler
                // Previous or next month
                dayEl.classList.add('calendar-day', 'other-month');
                const otherMonthDate = new Date(year, month, dayCount - daysInMonth);
                dayEl.innerHTML = `
                    <div class="day-header">
                        <div class="day-number">${otherMonthDate.getDate()}</div>
                    </div>
                `;
                dayCount++;
            }
            else {
                // Current month
                const dayDate = new Date(year, month, dayCount);
                const isToday = dayDate.toDateString() === today.toDateString(); // just to make sure
                const isSelected = false; // Add selection logic if needed
                
                dayEl.className = 'calendar-day';
                if (isToday) dayEl.classList.add('today');
                if (isSelected) dayEl.classList.add('selected');
                
                // Get tasks for this day
                const dayTasks = getTasksForDate(dayDate);
                const maxVisibleTasks = 5;


                
                dayEl.innerHTML = `
                    <div class="day-header">
                        <div class="day-number">${dayCount}</div>
                        <button class="add-task-btn" onclick="openCreateModalForDate('${dayDate.toLocaleDateString('en-CA')}')">+</button>
                    </div>
                    <div class="day-tasks">
                        ${dayTasks.slice(0, maxVisibleTasks).map(task => ` 
                            <div class="calendar-task ${task.priority} ${task.status === 'completed' ? 'completed' : ''}" 
                                 onclick="openEditModal(${JSON.stringify(task).replace(/"/g, '&quot;')})">
                                <div class="task-title">${task.title}</div>
                                ${task.start_time ? `<div class="task-time">🕒 ${task.start_time}</div>` : ''}
                            </div>
                        `).join('')}
                        ${dayTasks.length > maxVisibleTasks ? `
                            <div class="more-tasks" onclick="showAllTasksForDate('${dayDate.toISOString().split('T')[0]}')">
                                +${dayTasks.length - maxVisibleTasks} more
                            </div>
                        ` : ''}
                    </div>
                `;
                
                dayCount++;
            }
            
            monthDaysEl.appendChild(dayEl);
        }
    }

    // Render week view
    async function renderWeekView() {

    const response = await fetch('/api/tasks'); // Your controller route
    const databaseTasks = await response.json();

    const monthYearEl = document.getElementById('current-month-year');
    const today = new Date();
    const weekStart = getWeekStart(new Date(currentDate)); // Cloned to prevent Sunday bug
    const weekEnd = new Date(weekStart);
    weekEnd.setDate(weekEnd.getDate() + 6);
    
    const monthNames = ["January", "February", "March", "April", "May", "June",
                      "July", "August", "September", "October", "November", "December"];
    
    monthYearEl.textContent = `${weekStart.getDate()} ${monthNames[weekStart.getMonth()]} - 
                              ${weekEnd.getDate()} ${monthNames[weekEnd.getMonth()]} ${weekEnd.getFullYear()}`;
    
    // 1. Render week header
    const weekHeaderEl = document.getElementById('week-header');
    weekHeaderEl.innerHTML = '<div class="week-time-label">Time</div>';
    
    for (let i = 0; i < 7; i++) {
        const dayDate = new Date(weekStart);
        dayDate.setDate(dayDate.getDate() + i);
        const isToday = dayDate.toDateString() === today.toDateString();
        
        const dayHeader = document.createElement('div');
        dayHeader.className = 'week-day-header';
        if (isToday) dayHeader.classList.add('today');
        
        const dayNames = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
        dayHeader.innerHTML = `
            <div class="week-day-name">${dayNames[dayDate.getDay()]}</div>
            <div class="week-day-date">${dayDate.getDate()}</div>
        `;
        weekHeaderEl.appendChild(dayHeader);
    }
    
    // 2. Render time grid
    const weekGridEl = document.getElementById('week-grid');
    weekGridEl.innerHTML = '';
    
    for (let hour = 0; hour < 24; hour++) {
        // Time label column
        const timeLabel = document.createElement('div');
        timeLabel.className = 'time-slot';
        timeLabel.innerHTML = `<div class="time-label">${hour.toString().padStart(2, '0')}:00</div>`;
        weekGridEl.appendChild(timeLabel);
        
        // Day columns for this hour
        for (let day = 0; day < 7; day++) {
            const dayDate = new Date(weekStart);
            dayDate.setDate(dayDate.getDate() + day);
            
            const daySlot = document.createElement('div');
            daySlot.className = 'week-day';
            
            // 3. Fetch and Render Tasks
            const tasks = getTasksForDateAndHour(dayDate, hour);
            tasks.forEach(task => {
            const taskEl = document.createElement('div');
            // Add 'completed' class if task.completed is true/1
            const completedClass = (task.completed == true || task.completed == 1) ? 'completed' : '';
            taskEl.className = `week-task ${task.priority} ${completedClass}`;
            
            if (task.start_time && task.end_time) {
                const [startH, startM] = task.start_time.split(':').map(Number);
                const [endH, endM] = task.end_time.split(':').map(Number);
                const duration = ((endH * 60) + endM) - ((startH * 60) + startM);
                
                taskEl.style.top = `${startM * 2}px`;
                taskEl.style.height = `${duration > 0 ? (duration * 2) : 112}px`; // 112 to leave a tiny gap
            }

           

            if (task.status === "completed") 
            taskEl.classList.add('completed');

            // Use innerHTML instead of textContent so we can add the time div
            taskEl.innerHTML = `
                <div class="week-task-title">${task.title}</div>
                <div class="week-task-time" style="font-size: 0.7rem; opacity: 0.8;">
                    ${task.start_time}- ${task.end_time}
                </div>
            `;

            

            taskEl.onclick = (e) => {
                e.stopPropagation();
                openEditModal(task);
            };
            daySlot.appendChild(taskEl);
        });
                    
            weekGridEl.appendChild(daySlot);
        }
    }
}

    // Render day view
    function renderDayView() {
        let currentDate = new Date();
        const dayTitleEl = document.getElementById('day-title');
        const daySubtitleEl = document.getElementById('day-subtitle');
        const dayGridEl = document.getElementById('day-grid');
        
        const dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        const monthNames = ["January", "February", "March", "April", "May", "June",
                          "July", "August", "September", "October", "November", "December"];
        
        dayTitleEl.textContent = dayNames[currentDate.getDay()];
        daySubtitleEl.textContent = `${currentDate.getDate()} ${monthNames[currentDate.getMonth()]} ${currentDate.getFullYear()}`;
        
        // Render time grid
        dayGridEl.innerHTML = '';
        
        // Time column
        const timeColumn = document.createElement('div');
        timeColumn.className = 'day-time-column';
        for (let hour = 0; hour < 24; hour++) {
            const timeSlot = document.createElement('div');
            timeSlot.className = 'day-time-slot';
            timeSlot.textContent = `${hour.toString().padStart(2, '0')}:00`;
            timeColumn.appendChild(timeSlot);
        }
        dayGridEl.appendChild(timeColumn);
        
        // Schedule column
        const scheduleColumn = document.createElement('div');
        scheduleColumn.className = 'day-schedule';
        for (let hour = 0; hour < 24; hour++) {
            const hourSlot = document.createElement('div');
            hourSlot.className = 'day-hour';
            hourSlot.id = `hour-${hour}`;
            scheduleColumn.appendChild(hourSlot);
        }
        dayGridEl.appendChild(scheduleColumn);
        
        // Add tasks to schedule
        const dayTasks = getTasksForDate(currentDate);
        dayTasks.forEach(task => {
    if (task.start_time && task.end_time) {
        const [startH, startM] = task.start_time.split(':').map(Number);
        const [endH, endM] = task.end_time.split(':').map(Number);

        // 1. Calculate duration in minutes
        const startTotalMinutes = (startH * 60) + startM;
        const endTotalMinutes = (endH * 60) + endM;
        const durationMinutes = endTotalMinutes - startTotalMinutes;

        const hourSlot = document.getElementById(`hour-${startH}`);
        if (hourSlot && durationMinutes > 0) {
            const taskEl = document.createElement('div');
            taskEl.className = `day-task ${task.priority}`;
            
            // 2. Position it based on the start minute
            taskEl.style.top = `${startM * 2}px`; 
            
            // 3. Stretch it based on the duration
            // If 1 hour = 60px height, then height = durationMinutes
            taskEl.style.height = `${durationMinutes * 2}px`;

            if (task.status === "completed") {
            taskEl.classList.add('completed');
}
            
            taskEl.innerHTML = `
                <div class="day-task-title">${task.title}</div>
                <div class="day-task-time">${task.start_time} - ${task.end_time}</div>
            `;
            
            taskEl.onclick = () => openEditModal(task);
            hourSlot.appendChild(taskEl);
        }
    }
});
    }

    // Helper functions
    function getWeekStart(date) {
        const day = date.getDay();
        const diff = date.getDate() - day;
        return new Date(date.setDate(diff));
    }

    function getTasksForDate(date) {
        return allTasks.filter(task => {
            if (!task.due_date) return false;
            const taskDate = new Date(task.due_date);
            return taskDate.getDate() === date.getDate() &&
                   taskDate.getMonth() === date.getMonth() &&
                   taskDate.getFullYear() === date.getFullYear();
        });
    }

    function getTasksForDateAndHour(date, hour) {
        return allTasks.filter(task => {
            if (!task.due_date || !task.start_time) return false;
            const taskDate = new Date(task.due_date);
            const [taskHour] = task.start_time.split(':').map(Number);
            return taskDate.getDate() === date.getDate() &&
                   taskDate.getMonth() === date.getMonth() &&
                   taskDate.getFullYear() === date.getFullYear() &&
                   taskHour === hour;
        });
    }

    // Modal functions
    function openCreateModal() {
        document.getElementById("modalTitle").innerText = "Create Task"; 
        document.getElementById("taskForm").action = "{{ route('tasks.store') }}";
        document.getElementById("formMethod").value = "POST";
        document.getElementById("selectedDate").value = "";

        // Clear fields
        document.getElementById("taskTitle").value = "";
        document.getElementById("taskAssignee").value = "";
        document.getElementById("taskStartTime").value = "";
        document.getElementById("taskEndTime").value = "";
        document.getElementById("taskPriority").value = "medium";
        document.getElementById("taskStatus").value = "pending";
        document.getElementById("taskDescription").value = "";
        document.getElementById("taskType").value = "chores";
        document.getElementById("taskPoints").value = "0";

        document.getElementById("taskModal").style.display = "flex";
    }

    function openCreateModalForDate(dateString) {
        openCreateModal();
        document.getElementById("selectedDate").value = dateString;
    }

    function openEditModal(task) {
        
        document.getElementById("modalTitle").innerText = "Edit Task";
        document.getElementById("taskForm").action = "/tasks/" + task.id;
        document.getElementById("formMethod").value = "PUT";
        document.getElementById("selectedDate").value = task.due_date || "";

        

        // Fill fields
        document.getElementById("taskTitle").value = task.title || "";
        document.getElementById("taskDescription").value = task.description || "";
        document.getElementById("taskAssignee").value = task.assignee || "";
        document.getElementById("taskStartTime").value = task.start_time || "";
        document.getElementById("taskEndTime").value = task.end_time || "";
        document.getElementById("taskPriority").value = task.priority || "medium";
        document.getElementById("taskPoints").value = task.points || "0";
        document.getElementById("taskStatus").value = task.status || "pending";
        document.getElementById("taskType").value = task.category || "chores";

        document.getElementById("taskModal").style.display = "flex";
    }

    function closeModal() {
        document.getElementById("taskModal").style.display = "none";
    }

    function showAllTasksForDate(dateString) {
        const date = new Date(dateString);
        const tasks = getTasksForDate(date);
        alert(`Tasks for ${date.toDateString()}:\n\n${tasks.map(t => `• ${t.title} (${t.priority})`).join('\n')}`);
    }

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeModal();
    });

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
</script>
</x-app-layout>