<style>
    /* ===== RESET & BASE ===== */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background-color: #f9fafb;
        color: #374151;
    }

    /* ===== TOP NAVBAR ===== */
    .top-navbar {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        height: 64px;
        background: white;
        border-bottom: 1px solid #e5e7eb;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        display: flex;
        align-items: center;
        padding: 0 20px;
    }

    /* Logo */
    .nav-logo {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
    }

    .logo-icon {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 18px;
    }

    .app-name {
        font-size: 1.5rem;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    /* Search Bar */
    .nav-search {
        flex: 1;
        max-width: 500px;
        margin: 0 20px;
        position: relative;
    }

    .search-input {
        width: 100%;
        padding: 10px 16px 10px 44px;
        border: 1px solid #e5e7eb;
        border-radius: 24px;
        background: #f9fafb;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }

    .search-input:focus {
        outline: none;
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .search-icon {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
    }

    /* Navigation Icons */
    .nav-icons {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .nav-icon {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 16px;
        border-radius: 8px;
        background: transparent;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        color: #6b7280;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .nav-icon:hover {
        background: #f3f4f6;
        color: #374151;
    }

    .nav-icon.active {
        background: #f3f4f6;
        color: #667eea;
    }

    .nav-icon .icon {
        font-size: 1.2rem;
    }

    /* Right Side */
    .nav-right {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-left: auto;
    }

    /* Notification */
    .notification-btn {
        position: relative;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        border: none;
        background: transparent;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s ease;
    }

    .notification-btn:hover {
        background: #f3f4f6;
    }

    .notification-badge {
        position: absolute;
        top: 6px;
        right: 6px;
        background: #ef4444;
        color: white;
        font-size: 0.7rem;
        font-weight: 600;
        padding: 2px 6px;
        border-radius: 10px;
        min-width: 18px;
        text-align: center;
    }

    /* User Dropdown */
    .user-dropdown {
        position: relative;
    }

    .user-trigger {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 6px 12px;
        border-radius: 24px;
        background: transparent;
        border: 1px solid #e5e7eb;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .user-trigger:hover {
        background: #f9fafb;
    }

    .user-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .user-name {
        font-size: 0.9rem;
        font-weight: 500;
        color: #374151;
    }

    .dropdown-icon {
        color: #9ca3af;
        transition: transform 0.2s ease;
        font-size: 0.8rem;
    }

    .dropdown-menu {
        position: absolute;
        top: 100%;
        right: 0;
        margin-top: 8px;
        width: 200px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        border: 1px solid #e5e7eb;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.2s ease;
        z-index: 100;
    }

    .user-dropdown.open .dropdown-menu {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .user-dropdown.open .dropdown-icon {
        transform: rotate(180deg);
    }

    .dropdown-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 16px;
        color: #374151;
        text-decoration: none;
        transition: background 0.2s ease;
        border-bottom: 1px solid #f3f4f6;
        cursor: pointer;
        width: 100%;
        text-align: left;
        background: none;
        border: none;
        font-size: 0.9rem;
    }

    .dropdown-item:last-child {
        border-bottom: none;
    }

    .dropdown-item:hover {
        background: #f9fafb;
        color: #667eea;
    }

    .dropdown-item .icon {
        width: 20px;
        text-align: center;
    }

    .dropdown-item.logout {
        color: #ef4444;
    }

    /* ===== MAIN CONTENT AREA ===== */
    .main-content {
        margin-top: 64px; /* Height of navbar */
        padding: 20px;
        min-height: calc(100vh - 64px);
    }

    /* ===== NOTIFICATIONS PANEL ===== */
    .notification-panel {
        position: fixed;
        top: 80px;
        right: 20px;
        width: 320px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        border: 1px solid #e5e7eb;
        z-index: 999;
        display: none;
    }

    .notification-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 16px;
        border-bottom: 1px solid #e5e7eb;
    }

    .notification-header h3 {
        margin: 0;
        font-size: 1rem;
        font-weight: 600;
    }

    .notification-header button {
        background: none;
        border: none;
        font-size: 1.2rem;
        cursor: pointer;
        color: #6b7280;
        padding: 4px;
    }

    .notification-list {
        max-height: 400px;
        overflow-y: auto;
        padding: 8px 0;
    }

    .notification-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 12px 16px;
        border-bottom: 1px solid #f3f4f6;
        transition: background 0.2s ease;
    }

    .notification-item:hover {
        background: #f9fafb;
    }

    .notification-item:last-child {
        border-bottom: none;
    }

    .notification-icon {
        font-size: 1.2rem;
        min-width: 24px;
    }

    .notification-content p {
        margin: 0 0 4px 0;
        font-size: 0.9rem;
        line-height: 1.4;
    }

    .notification-content small {
        color: #9ca3af;
        font-size: 0.8rem;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 1024px) {
        .nav-search {
            display: none;
        }
        
        .nav-icons {
            gap: 2px;
        }
        
        .nav-icon {
            padding: 8px 12px;
        }
        
        .nav-icon .text {
            display: none;
        }
    }

    @media (max-width: 768px) {
        .top-navbar {
            padding: 0 16px;
        }
        
        .app-name {
            font-size: 1.25rem;
        }
        
        .nav-icon {
            padding: 8px;
        }
        
        .user-name {
            display: none;
        }
        
        .user-trigger {
            padding: 6px;
        }
        
        .main-content {
            padding: 16px;
        }
    }

    @media (max-width: 480px) {
        .top-navbar {
            padding: 0 12px;
        }
        
        .logo-icon {
            width: 32px;
            height: 32px;
            font-size: 16px;
        }
        
        .app-name {
            font-size: 1.1rem;
        }
        
        .nav-icon .icon {
            font-size: 1.1rem;
        }
        
        .user-avatar {
            width: 32px;
            height: 32px;
            font-size: 0.8rem;
        }
        
        .notification-panel {
            right: 10px;
            left: 10px;
            width: auto;
        }
    }
</style>

<!-- Fixed Top Navbar -->
<div class="top-navbar">
    <!-- Logo -->
    <a href="{{ route('dashboard') }}" class="nav-logo">
        <div class="logo-icon">✓</div>
        <div class="app-name">TaskFlow</div>
    </a>

    <!-- Search -->
    <div class="nav-search">
        <div class="search-icon">🔍</div>
        <input type="text" class="search-input" placeholder="Search tasks...">
    </div>

    <!-- Navigation Icons -->

    @if(auth()->user()->role === 'admin') 
        <div class="nav-icons">
        <a href="{{ route('admin.users') }}" class="nav-icon {{ request()->routeIs('admin.users') ? 'active' : '' }}">
            <span class="icon">📊</span>
            <span class="text">Dashboard</span>
        </a>
        
        <a href="{{ route('admin.users') }}" class="nav-icon {{ request()->routeIs('admin.users') ? 'active' : '' }}">
            <span class="icon">➕</span>
            <span class="text">Create</span>
        </a>
        
        <a href="{{ route('admin.growth') }}" class="nav-icon {{ request()->routeIs('admin.growth') ? 'active' : '' }}">
            <span class="icon">📋</span>
            <span class="text">Tasks</span>
        </a>
        
    </div>
    

    @else 
    <div class="nav-icons">
        <a href="{{ route('dashboard') }}" class="nav-icon {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <span class="icon">📊</span>
            <span class="text">Dashboard</span>
        </a>
        
        <a href="{{ route('tasks.index') }}" class="nav-icon {{ request()->routeIs('tasks.index') ? 'active' : '' }}">
            <span class="icon">➕</span>
            <span class="text">Create</span>
        </a>
        
        <a href="{{ route('tasks.index') }}" class="nav-icon {{ request()->routeIs('tasks.index') ? 'active' : '' }}">
            <span class="icon">📋</span>
            <span class="text">Tasks</span>
        </a>
        
        <a href="#" class="nav-icon">
            <span class="icon">🏆</span>
            <span class="text">Games</span>
        </a>
    </div>
    @endif

    <!-- Right Side -->
    <div class="nav-right">
        <!-- Notification -->
        <button class="notification-btn" onclick="toggleNotifications()">
            <span class="icon">🔔</span>
            <span class="notification-badge">3</span>
        </button>

        <!-- User Dropdown -->
        <div class="user-dropdown" id="userDropdown">
            <button class="user-trigger" onclick="toggleDropdown(event)">
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="user-name">
                    {{ Auth::user()->name }}
                </div>
                <div class="dropdown-icon">▼</div>
            </button>
            
            <div class="dropdown-menu">
                <a href="{{ route('profile.edit') }}" class="dropdown-item">
                    <span class="icon">👤</span>
                    <span>Profile</span>
                </a>
                
                <a href="#" class="dropdown-item">
                    <span class="icon">⚙️</span>
                    <span>Settings</span>
                </a>
                
                <a href="#" class="dropdown-item">
                    <span class="icon">❓</span>
                    <span>Help</span>
                </a>
                
                <form method="POST" action="{{ route('logout') }}" style="display: contents;">
                    @csrf
                    <button type="submit" class="dropdown-item logout">
                        <span class="icon">🚪</span>
                        <span>Log Out</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Notifications Panel -->
<div id="notificationsPanel" class="notification-panel">
    <div class="notification-header">
        <h3>Notifications</h3>
        <button onclick="toggleNotifications()">✕</button>
    </div>
    <div class="notification-list">
        <div class="notification-item">
            <div class="notification-icon">🎯</div>
            <div class="notification-content">
                <p><strong>Task Completed!</strong> You earned 25 points</p>
                <small>2 minutes ago</small>
            </div>
        </div>
        <div class="notification-item">
            <div class="notification-icon">⚠️</div>
            <div class="notification-content">
                <p><strong>Deadline approaching:</strong> "Finish report" due tomorrow</p>
                <small>1 hour ago</small>
            </div>
        </div>
        <div class="notification-item">
            <div class="notification-icon">🏆</div>
            <div class="notification-content">
                <p><strong>Level Up!</strong> You've reached Gold Level</p>
                <small>3 hours ago</small>
            </div>
        </div>
    </div>
</div>



<script>
    // Simple dropdown toggle
    function toggleDropdown(event) {
        event.stopPropagation();
        const dropdown = document.getElementById('userDropdown');
        dropdown.classList.toggle('open');
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', (e) => {
        if (!e.target.closest('.user-dropdown')) {
            document.querySelectorAll('.user-dropdown').forEach(item => {
                item.classList.remove('open');
            });
        }
    });

    // Notifications toggle
    function toggleNotifications() {
        const panel = document.getElementById('notificationsPanel');
        const isVisible = panel.style.display === 'block';
        panel.style.display = isVisible ? 'none' : 'block';
        
        // Close user dropdown
        document.querySelectorAll('.user-dropdown').forEach(item => {
            item.classList.remove('open');
        });
    }

    // Close notifications when clicking outside
    document.addEventListener('click', (e) => {
        const panel = document.getElementById('notificationsPanel');
        const btn = document.querySelector('.notification-btn');
        
        if (panel && panel.style.display === 'block' && 
            !panel.contains(e.target) && 
            !btn.contains(e.target)) {
            panel.style.display = 'none';
        }
    });

    // Active state for current page
    document.addEventListener('DOMContentLoaded', () => {
        // Highlight active link based on current URL
        const currentPath = window.location.pathname;
        document.querySelectorAll('.nav-icon').forEach(link => {
            const href = link.getAttribute('href');
            if (href && href !== '#' && currentPath === href) {
                link.classList.add('active');
            }
        });
    });
</script>