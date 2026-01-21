<x-app-layout>
<style>
    body, html {
        margin: 0;
        padding: 0;
        height: 100%;
    }

    /* ===== Main Layout ===== */
    .app-container {
        display: flex;
        height: 100vh;
        background: #f9fafb;
    }

    /* ===== Sidebar ===== */
    .sidebar {
        width: 70px; /* Slightly wider for icons */
        background-color: #7999d6ff;
        color: white;
        padding-top: 20px;
        box-sizing: border-box;
        transition: width 0.3s ease;
        overflow-x: hidden;
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
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
        padding: 10px 15px;
        margin-bottom: 20px;
        white-space: nowrap;
    }

    .toggle-btn-text {
        margin-left: 15px;
        font-size: 1.2rem;
        font-weight: 600;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .sidebar.active .toggle-btn-text {
        opacity: 1;
    }

    .sidebar-content {
        opacity: 1; /* Always visible */
        transition: opacity 0.3s ease;
        padding: 0 10px;
    }

    .sidebar a {
        display: flex;
        align-items: center;
        padding: 12px 15px;
        margin: 5px 0;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        white-space: nowrap;
        overflow: hidden;
    }

    .sidebar a:hover {
        background-color: #3f75ccff;
    }

    .sidebar-icon {
        font-size: 1.2rem;
        min-width: 30px; /* Fixed width for icons */
        text-align: center;
    }

    .sidebar-text {
        margin-left: 15px;
        opacity: 0;
        transition: opacity 0.3s ease;
        font-size: 0.95rem;
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
        padding: 12px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-shrink: 0;
    }

    .toolbar h1 {
        font-size: 1.2rem;
        font-weight: 600;
        margin: 0;
    }

    .toolbar button,
    .toolbar a {
        padding: 6px 12px;
        border-radius: 6px;
        border: 1px solid #e5e7eb;
        background: white;
        cursor: pointer;
        text-decoration: none;
        font-size: 14px;
    }

    .toolbar a {
        background: #22c55e;
        color: white;
        border: none;
    }

    .toolbar a:hover {
        background: #16a34a;
    }

    /* ===== Scrollable Content ===== 
    so flex 1 so 1 calandar will flex to the right*/
    .scrollable-content {
        flex: 1; 
        overflow-y: auto;
        padding: 20px;
        display: flex;
        align-items: flex-start;
       
    }

    /* ===== Priority Section ===== tis*/
    .priority-section {
        margin-bottom: 24px;
        background: white;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
        overflow: hidden;
          flex: 1;
          min-width: 0;
        
    }

   .calendar {
  width: 320px;
  background: white;
  padding: 10px;
  border-radius: 8px;
  border: 1px solid #e5e7eb;
  user-select: none;
}

.calendar-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 5px;
}

.calendar-header button {
  padding: 4px 8px;
  cursor: pointer;
  border: 1px solid #ccc;
  background: #f9fafb;
  border-radius: 4px;
}

.calendar-weekdays {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
  text-align: center;
  font-weight: 600;
  margin-bottom: 2px;
  color: #6b7280;
}

#calendar-dates {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
  gap: 2px;
}

#calendar-dates div {
  text-align: center;
  padding: 6px;
  cursor: pointer;
  border-radius: 4px;
}

#calendar-dates div.today {
  background-color: #2563eb;
  color: white;
}

#calendar-dates div.selected {
  border: 2px solid #2563eb;
  background-color: #bfdbfe;
}



    .content-layout {
  display: flex;
  align-items: flex-start;
  width: 100%;      /* ✅ important */
  gap: 20px;        /* optional spacing between tasks & calendar */
  box-sizing: border-box;
}

.tasks {
  flex: 1;
  min-width: 0;
}
    

    .priority-header {
        padding: 14px 18px;
        border-bottom: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 600;
    }

    .priority-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }

    .priority-dot.low { background: #22c55e; }
    .priority-dot.medium { background: #f59e0b; }
    .priority-dot.high { background: #ef4444; }

    /* ===== Task Row ===== */
    .task-row {
        padding: 14px 18px;
        border-bottom: 1px solid #f1f5f9;
        cursor: pointer;
    }

    .task-row:last-child {
        border-bottom: none;
    }

    .task-row:hover {
        background: #f9fafb;
    }

    .task-row.completed {
    opacity: 0.5;
    }

    .task-row.completed .task-title {
    text-decoration: line-through;
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
    }

    .task-meta {
        margin-top: 4px;
        font-size: 0.75rem;
        color: #6b7280;
        display: flex;
        gap: 8px;
        align-items: center;
        flex-wrap: wrap;
    }

    .priority-text.low { color: #22c55e; }
    .priority-text.medium { color: #f59e0b; }
    .priority-text.high { color: #ef4444; }

    .empty {
        padding: 16px;
        color: #101113ff;
        font-style: italic;
    }

    /* ===== Edit & Delete Buttons ===== */
    .task-actions {
        display: flex;
        gap: 5px;
        margin-left: auto;
        align-items: center;
    }

    .overdue-label {
    color: red;
    font-weight: bold;
    margin-left: 5px;
    }


    .edit-btn {
        background: none;
        border: none;
        font-size: 18px;
        cursor: pointer;
        padding: 4px;
        border-radius: 10%;
        line-height: 1;
        color: #666;
    }

    .edit-btn:hover {
        background: #f0f0f0;
        color: #333;
    }

    .delete-btn {
        background: none;
        border: none;
        font-size: 18px;
        cursor: pointer;
        padding: 4px;
        border-radius: 10%;
        line-height: 1;
        color: #dc2626;
    }

    .delete-btn:hover {
        background: #fee2e2;
    }

    /* ===== Modal Overlay ===== */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.6);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        padding: 20px;
        overflow-y: auto;
    }

    /* ===== Modal Box ===== */
    .modal-box {
        background: #fff;
        border-radius: 10px;
        padding: 30px 40px;
        width: 100%;
        max-width: 700px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        animation: fadeIn 0.3s ease-out;
        font-family: 'Segoe UI', sans-serif;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .modal-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 16px;
        color: #111827;
    }

    .modal-box label {
        display: block;
        margin-top: 12px;
        font-weight: 600;
        font-size: 0.875rem;
        color: #374151;
    }

    .modal-box input,
    .modal-box select,
    .modal-box textarea {
        width: 100%;
        margin-top: 4px;
        padding: 8px 10px;
        border-radius: 6px;
        border: 1px solid #d1d5db;
        font-size: 0.875rem;
        box-sizing: border-box;
    }

    .modal-box textarea {
        min-height: 80px;
        resize: vertical;
    }

    .modal-box input:focus,
    .modal-box select:focus,
    .modal-box textarea:focus {
        outline: none;
        border-color: #22c55e;
    }

    /* ===== Actions ===== */
    .modal-actions {
        margin-top: 20px;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .modal-actions button {
        padding: 10px 20px;
        font-size: 1rem;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-cancel {
        background-color: #eee;
        border: none;
    }

    .btn-submit {
        background-color: #3498db;
        color: #fff;
        border: none;
    }

    /* Tooltip for collapsed sidebar icons */
    .sidebar a .icon-tooltip {
        position: absolute;
        left: 80px;
        background: #111827;
        color: white;
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 0.8rem;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.2s ease;
        z-index: 1000;
        pointer-events: none;
    }

    .sidebar:not(.active) a:hover .icon-tooltip {
        opacity: 1;
        visibility: visible;
    }

    /* Make icons larger when sidebar is collapsed */
    .sidebar:not(.active) .sidebar-icon {
        font-size: 1.3rem;
    }
</style>

<!-- Single wrapper structure -->
<div class="app-container" style="margin-top: 64px;">
   
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
            <a href="#">
                <span class="sidebar-icon">📅</span>
                <span class="sidebar-text">Planner</span>
                <span class="icon-tooltip">Planner</span>
            </a>
            <a href="#">
                <span class="sidebar-icon">⚙️</span>
                <span class="sidebar-text">Settings</span>
                <span class="icon-tooltip">Settings</span>
            </a>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="main-content-area">
        <!-- Toolbar -->
        <div class="toolbar">
            <h1>Tasks</h1>
              <form method="GET" action="{{ route('tasks.index') }}" class="search-form" style="display:inline-block; margin-left: 20px;">
        <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}" 
            placeholder="Search tasks..."
            style="padding: 5px 10px; border-radius: 4px; border: 1px solid #ccc;"
        >
        <input type="hidden" name="date" value="{{ $date }}">
        <input type="hidden" name="sort" value="{{ $sort }}">
        <input type="hidden" name="status" value="{{ $statusFilter }}">
        <input type="hidden" name="group_by" value="{{ $groupBy }}">
        
        <button type="submit" style="padding: 5px 10px;">Search</button>
    </form>
            <button type="button" onclick="openCreateModal()">+ Add Task</button> 
        </div>

        <!-- Scrollable Content -->
        <div class="scrollable-content">

  <div class="content-layout">

    <!-- LEFT COLUMN (ALL TASKS) -->
    <div class="tasks">
      @foreach($tasksGrouped as $group => $tasks)
        <div class="priority-section">
            

          <div class="priority-header">
               @if($groupBy === 'due_date')
                {{ \Carbon\Carbon::parse($group)->format('M d') }}
            @else
                {{ ucfirst($group) }}
            @endif
          </div>

          @forelse($tasks as $task)
          
            <div class="task-row {{ $task->status === 'completed' ? 'completed' : '' }}" >
              <div class="task-main">

                <div style="flex:1">
                  <div class="task-title">{{ $task->title }} @if($task->status !== 'completed' 
                        && $task->due_date 
                        && \Carbon\Carbon::parse($task->due_date)->startOfDay()->lt(\Carbon\Carbon::today()))
                        <span class="overdue-label">(Incomplete)</span>
                    @endif
                  </div>

                  <div class="task-meta">
                    <span>Assignee: {{ $task->assignee ?? 'Unassigned' }}</span>
                    <span>•</span>
                    <span>
                      due date:
                      {{ $task->due_date
                        ? \Carbon\Carbon::parse($task->due_date)->format('M d')
                        : 'No due date' }}
                    </span>
                    <span>•</span>
                    <span>Priority: {{ $task->priority ?? 'Unassigned' }}</span>
                    <span>•</span>
                    <span>Status: {{ $task->status ?? 'Unassigned' }}</span>
                    <span>•</span>
                    <span>Category: {{ $task->category ?? 'Unassigned' }}</span>
                  </div>
                </div>

                <div class="task-actions">
                  <button class="edit-btn" onclick='openEditModal(@json($task))'>Info ⋮</button>

                  <form action = "{{route('tasks.destroy', $task->id)}}" method = "POST"
                     class="delete-form" onsubmit="return confirm('Delete this task?')" style="display: inline;">
                     @csrf
                     @method('DELETE')
                     <button type="submit" class="delete-btn">🗑</button> 
                  </form>
                    
                </div>

              </div>
            </div>
          @empty
          
            <div class="empty">No tasks in this priority</div>
          @endforelse
          

        </div>
      @endforeach

    </div>

    <!-- RIGHT COLUMN (CALENDAR) -->
    <div class="calendar">
        
  <form method="GET" action="{{ route('tasks.index') }}">
    <label>Select Date:</label>

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

     <!-- Hidden inputs to carry parameters -->
                      <!-- {} prints the value of the vars, thats why we use it in form for value = {variable} -->
    <input type="hidden" name="date" id="selected-date" value="{{ $date }}">
    

    <!-- Sort / Filter / Group UI -->
     
    Sort 
    <select name = "sort"  id="sortSelect">
        <option value="created_at" {{ $sort === 'created_at' ? 'selected' : '' }}>Created At</option>
        <option value="priority" {{ $sort === 'priority' ? 'selected' : '' }}>Priority</option>
        <option value="due_date" {{ $sort === 'due_date' ? 'selected' : '' }}>Due Date</option>
        <option value="status" {{ $sort === 'status' ? 'selected' : '' }}>Status</option>
    </select>

    <br>
    Filter
    <select name = "status"id="filterSelect">
        <option value="" {{ $statusFilter === null ? 'selected' : '' }}>All Status</option>
        <option value="pending" {{ $statusFilter === 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="in_progress" {{ $statusFilter === 'in_progress' ? 'selected' : '' }}>In Progress</option>
        <option value="completed" {{ $statusFilter === 'completed' ? 'selected' : '' }}>Completed</option>
    </select>

    <br>
    Groupby
    <select name = "group_by" id="groupBySelect">
        <option value="priority" {{ $groupBy === 'priority' ? 'selected' : '' }}>Group by Priority</option>
        <option value="status" {{ $groupBy === 'status' ? 'selected' : '' }}>Group by Status</option>
        <option value="category" {{ $groupBy === 'category' ? 'selected' : '' }}>Group by Category</option>
        <option value="due_date" {{ $groupBy === 'due_date' ? 'selected' : '' }}>Group by Due Date</option>
    </select>

    <br>

    
    <button type="submit">Go</button>
  </form>
</div>



  </div>
</div>

    </div>
</div>
</x-app-layout>

<!-- Task Modal (Hidden by default) -->
<div id="taskModal" class="modal-overlay" style="display:none;">
    <div class="modal-box">
        <h2 id="modalTitle" class="modal-title">New Task</h2>

        <form id="taskForm" method="POST">
            @csrf
            <input type="hidden" id="formMethod" name="_method" value="POST">

            <!-- Title -->
            <label>Title</label>
            <input type="text" name="title" id="taskTitle" required>

            <!-- Description -->
            <label>Description</label>
            <textarea name="description" id="taskDescription"></textarea>

            <!-- Type -->
            <label>Category</label>
            <select name="category" id="taskType" required>
                <option value="chores">Chores</option>
                <option value="exercise">Exercise</option>
                <option value="study">Study</option>
                <option value="assignment">Assignment</option>
            </select>

            <!-- Priority Level -->
            <label>Priority</label>
            <select name="priority" id="taskPriority" required>
                <option value="high">High</option>
                <option value="medium" selected>Medium</option>
                <option value="low">Low</option>
            </select>

            <!-- Status -->
            <label>Status</label>
            <select name="status" id="taskStatus" required>
                <option value="pending" selected>Pending</option>
                <option value="in_progress">In Progress</option>
                <option value="completed">Completed</option>
            </select>

            <!-- Assignee -->
            <label>Assignee</label>
            <input type="text" name="assignee" id="taskAssignee">

            <!-- Due Date -->
            <label>Due Date</label>
            <input type="date" name="due_date" id="taskDueDate">

            <!-- Points -->
            <label>Points</label>
            <input type="number" name="points" id="taskPoints" min="0" value="0">

            <!-- Modal actions -->
            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeModal()">Cancel</button>
                <button type="submit" class="btn-submit">Save</button>
            </div>
        </form>
    </div>
</div>



<script>
    // Sidebar toggle
    const sidebar = document.getElementById('sidebar');
    document.getElementById('sidebarToggle').addEventListener('click', () => {
        sidebar.classList.toggle('active');
    });

    // Modal functions
    function openCreateModal() {
        document.getElementById("modalTitle").innerText = "Create Task"; 
        document.getElementById("taskForm").action = "/tasks";
        document.getElementById("formMethod").value = "POST";

        // Clear fields
        document.getElementById("taskTitle").value = "";
        document.getElementById("taskAssignee").value = "";
        document.getElementById("taskDueDate").value = "";
        document.getElementById("taskPriority").value = "medium";
        document.getElementById("taskStatus").value = "pending";
        document.getElementById("taskDescription").value = "";
        document.getElementById("taskType").value = "chores";
        document.getElementById("taskPoints").value = "0";

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
        document.getElementById("taskType").value = task.type;

        document.getElementById("taskModal").style.display = "flex";
    }

    function closeModal() {
        document.getElementById("taskModal").style.display = "none";
    }

    // Tooltip positioning
    document.querySelectorAll('.sidebar a').forEach(link => {
        link.addEventListener('mouseenter', function() {
            const tooltip = this.querySelector('.icon-tooltip');
            if (tooltip) {
                // Position the tooltip
                const rect = this.getBoundingClientRect();
                tooltip.style.top = rect.top + 'px';
            }
        });
    });

    const calendarDates = document.getElementById("calendar-dates");
const monthYearEl = document.getElementById("month-year");
const selectedInput = document.getElementById("selected-date");

let today = new Date();
let selectedDate = selectedInput.value ? new Date(selectedInput.value) : today;

// Track which month/year is being shown
let currentMonth = today.getMonth();
let currentYear = today.getFullYear();

// Render the calendar
function renderCalendar(year, month) {
  calendarDates.innerHTML = "";

  // Set month-year header
  const monthNames = ["January","February","March","April","May","June","July","August","September","October","November","December"];
  monthYearEl.textContent = `${monthNames[month]} ${year}`;

  // First day of month
  const firstDay = new Date(year, month, 1).getDay();
  const daysInMonth = new Date(year, month + 1, 0).getDate();

  // Empty slots for first day
  for (let i = 0; i < firstDay; i++) {
    calendarDates.appendChild(document.createElement("div"));
  }

  // Days
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

      // Set input in local yyyy-mm-dd format
      selectedInput.value = `${selectedDate.getFullYear()}-${String(selectedDate.getMonth()+1).padStart(2,'0')}-${String(selectedDate.getDate()).padStart(2,'0')}`;

      renderCalendar(currentYear, currentMonth);
    });

    calendarDates.appendChild(dayEl);
  }
}

// Navigation
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

function toggleFilterSort() {
    const panel = document.getElementById('filterSortPanel');
    panel.style.display = panel.style.display === 'block' ? 'none' : 'block';
}

// Close if clicked outside
document.addEventListener('click', function(e) {
    const panel = document.getElementById('filterSortPanel');
    const btn = document.querySelector('.filter-sort-btn');
    if (!panel.contains(e.target) && e.target !== btn) {
        panel.style.display = 'none';
    }
});

function applyFilterSort() {
    const form = document.querySelector('form[action="{{ route('tasks.index') }}"]');
    const sortValue = document.getElementById('sortSelect').value;
    const statusValue = document.getElementById('filterSelect').value;
    const groupValue = document.getElementById('groupBySelect').value;

    // Update hidden inputs
    document.getElementById('sort-param').value = sortValue;
    document.getElementById('status-param').value = statusValue;
    document.getElementById('group-param').value = groupValue;

    // Submit form (reload page with all params)
    form.submit();
}







      



</script>