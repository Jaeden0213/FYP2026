<x-app-layout>
    <style>
        .dashboard-container {
            min-height: 100vh;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            padding: 1.5rem;
        }

        .dashboard-header {
            margin-bottom: 2.5rem;
            text-align: center;
        }

        .dashboard-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 0.5rem;
            letter-spacing: -0.02em;
        }

        .dashboard-subtitle {
            font-size: 1rem;
            color: #64748b;
            max-width: 600px;
            margin: 0 auto;
        }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0.5rem;
        }

        .admin-card {
            aspect-ratio: 1 / 1; /* Makes it square */
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.02);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid #e5e7eb;
            overflow: hidden;
            position: relative;
            text-decoration: none;
            display: flex;
            flex-direction: column;
        }

        .admin-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.15);
        }

        .card-gradient-top {
            height: 4px;
            width: 100%;
            transition: all 0.3s ease;
        }

        .card-content {
            flex: 1;
            padding: 1.8rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .icon-wrapper {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .admin-card:hover .icon-wrapper {
            transform: scale(1.1);
        }

        .icon-wrapper span {
            font-size: 2.5rem;
            line-height: 1;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.5rem;
            letter-spacing: -0.01em;
        }

        .card-description {
            font-size: 0.875rem;
            color: #64748b;
            margin-bottom: 1.25rem;
            line-height: 1.5;
            max-width: 180px;
        }

        .card-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.4rem 1rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
            white-space: nowrap;
            max-width: 100%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .badge-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .card-hover-indicator {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            transform: scaleX(0);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .admin-card:hover .card-hover-indicator {
            transform: scaleX(1);
        }

        /* Color variations */
        .card-blue .icon-wrapper { background: #eff6ff; }
        .card-blue .badge-dot { background: #3b82f6; }
        .card-blue .card-badge { background: #eff6ff; color: #1e40af; }

        .card-green .icon-wrapper { background: #f0fdf4; }
        .card-green .badge-dot { background: #22c55e; }
        .card-green .card-badge { background: #f0fdf4; color: #166534; }

        .card-yellow .icon-wrapper { background: #fef3c7; }
        .card-yellow .badge-dot { background: #eab308; }
        .card-yellow .card-badge { background: #fef3c7; color: #854d0e; }

        .card-purple .icon-wrapper { background: #faf5ff; }
        .card-purple .badge-dot { background: #a855f7; }
        .card-purple .card-badge { background: #faf5ff; color: #6b21a8; }

        /* Responsive */
        @media (max-width: 1024px) {
            .cards-grid {
                grid-template-columns: repeat(2, 1fr);
                max-width: 600px;
            }
        }

        @media (max-width: 640px) {
            .cards-grid {
                grid-template-columns: 1fr;
                max-width: 320px;
            }
            
            .dashboard-title {
                font-size: 2rem;
            }
            
            .card-content {
                padding: 1.5rem;
            }
            
            .icon-wrapper {
                width: 70px;
                height: 70px;
            }
            
            .icon-wrapper span {
                font-size: 2rem;
            }
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .admin-card {
            animation: fadeInUp 0.5s ease forwards;
        }

        .admin-card:nth-child(1) { animation-delay: 0.1s; }
        .admin-card:nth-child(2) { animation-delay: 0.2s; }
        .admin-card:nth-child(3) { animation-delay: 0.3s; }
        .admin-card:nth-child(4) { animation-delay: 0.4s; }
    </style>

    <div class="dashboard-container">
        <!-- Header -->
        <div class="dashboard-header">
            <h1 class="dashboard-title">Admin Dashboard</h1>
            <p class="dashboard-subtitle">Manage your application's users, rewards, and appeals from one central location</p>
        </div>

        <!-- Cards Grid -->
        <div class="cards-grid">
            <!-- User Data Card -->
            <a href="{{ route('admin.users') }}" class="admin-card card-blue">
                <div class="card-gradient-top" style="background: linear-gradient(to right, #3b82f6, #06b6d4);"></div>
                <div class="card-content">
                    <div class="icon-wrapper">
                        <span>🗂️</span>
                    </div>
                    <h3 class="card-title">User Data</h3>
                    <p class="card-description">Manage and view all registered accounts</p>
                    <div class="card-badge">
                        <span class="badge-dot"></span>
                        Active Users
                    </div>
                </div>
                <div class="card-hover-indicator" style="background: linear-gradient(to right, #3b82f6, #06b6d4);"></div>
            </a>

            <!-- User Growth Card -->
            <a href="{{ route('admin.growth') }}" class="admin-card card-green">
                <div class="card-gradient-top" style="background: linear-gradient(to right, #22c55e, #10b981);"></div>
                <div class="card-content">
                    <div class="icon-wrapper">
                        <span>📈</span>
                    </div>
                    <h3 class="card-title">User Growth</h3>
                    <p class="card-description">Analyze registration trends and metrics</p>
                    <div class="card-badge">
                        <span class="badge-dot"></span>
                        Analytics
                    </div>
                </div>
                <div class="card-hover-indicator" style="background: linear-gradient(to right, #22c55e, #10b981);"></div>
            </a>

            <!-- Rewards Management Card -->
            <a href="{{ route('admin.rewards.index') }}" class="admin-card card-yellow">
                <div class="card-gradient-top" style="background: linear-gradient(to right, #eab308, #f59e0b);"></div>
                <div class="card-content">
                    <div class="icon-wrapper">
                        <span>🏆</span>
                    </div>
                    <h3 class="card-title">Rewards</h3>
                    <p class="card-description">Create and manage user rewards system</p>
                    <div class="card-badge">
                        <span class="badge-dot"></span>
                        Manage Prizes
                    </div>
                </div>
                <div class="card-hover-indicator" style="background: linear-gradient(to right, #eab308, #f59e0b);"></div>
            </a>

            <!-- Users Appeals Card -->
            <a href="{{ route('admin.appeals') }}" class="admin-card card-purple">
                <div class="card-gradient-top" style="background: linear-gradient(to right, #a855f7, #ec4899);"></div>
                <div class="card-content">
                    <div class="icon-wrapper">
                        <span>⚖️</span>
                    </div>
                    <h3 class="card-title">Users Appeals</h3>
                    <p class="card-description">Approve or Deny appeal requests</p>
                    <div class="card-badge">
                        <span class="badge-dot"></span>
                        Activate suspended users
                    </div>
                </div>
                <div class="card-hover-indicator" style="background: linear-gradient(to right, #a855f7, #ec4899);"></div>
            </a>
        </div>

      
    </div>
</x-app-layout>