<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome | JD & Jordon</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #f1f5f9;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Navigation */
        .nav {
            position: fixed;
            top: 0;
            width: 100%;
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 100;
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #22c55e 0%, #10b981 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
            align-items: center;
        }

        .nav-link {
            text-decoration: none;
            color: #cbd5e1;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .nav-link:hover {
            color: #22c55e;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-login {
            color: #22c55e;
            border: 2px solid rgba(34, 197, 94, 0.3);
            background: rgba(34, 197, 94, 0.1);
        }

        .btn-login:hover {
            background: rgba(34, 197, 94, 0.15);
            border-color: rgba(34, 197, 94, 0.5);
            transform: translateY(-2px);
        }

        .btn-primary {
            background: linear-gradient(135deg, #22c55e 0%, #10b981 100%);
            color: white;
            box-shadow: 0 4px 20px rgba(34, 197, 94, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(34, 197, 94, 0.3);
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 6rem 2rem 4rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .hero-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            width: 100%;
        }

        .hero-text {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeUp 0.8s ease forwards;
        }

        @keyframes fadeUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #ffffff 0%, #cbd5e1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: 1.125rem;
            color: #94a3b8;
            line-height: 1.7;
            margin-bottom: 2.5rem;
            max-width: 500px;
        }

        .hero-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        /* Image Container */
        .hero-image-container {
            position: relative;
        }

        .hero-image {
            width: 100%;
            max-width: 500px;
            filter: drop-shadow(0 20px 40px rgba(0, 0, 0, 0.3));
            transform-style: preserve-3d;
            transition: transform 0.5s ease;
        }

        .hero-image:hover {
            transform: perspective(1000px) rotateY(10deg) rotateX(5deg);
        }

        /* Floating elements */
        .floating {
            position: absolute;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 1rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            animation: float 3s ease-in-out infinite;
        }

        .floating-1 {
            top: -20px;
            right: 30px;
            animation-delay: 0.2s;
        }

        .floating-2 {
            bottom: 40px;
            left: -20px;
            animation-delay: 0.4s;
        }

        .floating-3 {
            top: 120px;
            right: -30px;
            animation-delay: 0.6s;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        /* Features */
        .features {
            padding: 6rem 2rem;
            background: rgba(15, 23, 42, 0.5);
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: white;
        }

        .section-subtitle {
            text-align: center;
            color: #94a3b8;
            font-size: 1.125rem;
            margin-bottom: 4rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            padding: 2rem;
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-8px);
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(34, 197, 94, 0.2);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .feature-icon {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
        }

        .feature-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: white;
        }

        .feature-description {
            color: #94a3b8;
            line-height: 1.6;
        }

        /* Footer */
        .footer {
            padding: 4rem 2rem;
            text-align: center;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            background: rgba(15, 23, 42, 0.8);
        }

        .footer-logo {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #22c55e 0%, #10b981 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .footer-text {
            color: #94a3b8;
            max-width: 400px;
            margin: 0 auto 2rem;
        }

        /* Responsive */
        @media (max-width: 968px) {
            .hero-content {
                grid-template-columns: 1fr;
                text-align: center;
                gap: 3rem;
            }

            .hero-title {
                font-size: 2.75rem;
            }

            .hero-actions {
                justify-content: center;
            }

            .floating {
                display: none;
            }
        }

        @media (max-width: 640px) {
            .nav {
                padding: 1rem;
            }

            .nav-links {
                gap: 1rem;
            }

            .hero {
                padding: 5rem 1rem 3rem;
            }

            .hero-title {
                font-size: 2.25rem;
            }

            .hero-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .features {
                padding: 4rem 1rem;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="nav">
        <div class="logo">JD & Jordon</div>
        <div class="nav-links">
            <a href="{{ route('login') }}" class="nav-link">Features</a>
            <a href="{{ route('login') }}" class="nav-link">About</a>
            <a href="{{ route('login') }}" class="btn btn-login">Login</a>
            <a href="{{ route('register') }}" class="btn btn-primary">Get Started</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <div class="hero-text">
                <h1 class="hero-title">Plan Smarter.<br>Achieve More.</h1>
                <p class="hero-subtitle">
                    A modern student productivity platform that helps you manage tasks, 
                    deadlines, and priorities effortlessly. Stay organized, focused, 
                    and productive with our intuitive tools.
                </p>
                <div class="hero-actions">
                    <a href="{{ route('register') }}" class="btn btn-primary">
                        Get Started Free
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-login">
                        Already have an account?
                    </a>
                </div>
            </div>
            
            <div class="hero-image-container">
                <img 
                    src="{{ asset('images/undraw_completed-tasks_1j9z.svg') }}" 
                    class="hero-image" 
                    alt="Task Management Illustration"
                    onerror="this.src='https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=500&q=60'"
                >
                <!-- Floating elements -->
                <div class="floating floating-1">
                    <div style="font-size: 1.5rem;">✅</div>
                    <div style="font-size: 0.875rem; margin-top: 0.5rem;">Task Done</div>
                </div>
                <div class="floating floating-2">
                    <div style="font-size: 1.5rem;">📅</div>
                    <div style="font-size: 0.875rem; margin-top: 0.5rem;">Schedule</div>
                </div>
                <div class="floating floating-3">
                    <div style="font-size: 1.5rem;">🎯</div>
                    <div style="font-size: 0.875rem; margin-top: 0.5rem;">Goals</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <h2 class="section-title">Everything You Need</h2>
        <p class="section-subtitle">
            Powerful features designed to boost your productivity and help you succeed
        </p>
        
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">📋</div>
                <h3 class="feature-title">Smart Task Management</h3>
                <p class="feature-description">
                    Organize tasks with priority levels, categories, and due dates. 
                    Never miss another deadline with our intelligent reminders.
                </p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">📊</div>
                <h3 class="feature-title">Progress Tracking</h3>
                <p class="feature-description">
                    Visualize your progress with charts and analytics. 
                    See how you're improving over time and stay motivated.
                </p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">🎮</div>
                <h3 class="feature-title">Gamified Productivity</h3>
                <p class="feature-description">
                    Earn points, unlock achievements, and climb leaderboards. 
                    Make productivity fun and rewarding.
                </p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">🤝</div>
                <h3 class="feature-title">Collaboration Tools</h3>
                <p class="feature-description">
                    Share projects, assign tasks, and work together with classmates. 
                    Perfect for group projects and study sessions.
                </p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">📱</div>
                <h3 class="feature-title">Mobile Friendly</h3>
                <p class="feature-description">
                    Access your tasks and schedule from anywhere. 
                    Our platform works perfectly on all your devices.
                </p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">🔒</div>
                <h3 class="feature-title">Secure & Private</h3>
                <p class="feature-description">
                    Your data is protected with enterprise-grade security. 
                    We respect your privacy and keep your information safe.
                </p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-logo">JD & Jordon</div>
        <p class="footer-text">
            A Final Year Project dedicated to helping students achieve their full potential 
            through smart productivity tools.
        </p>
        <div style="margin-bottom: 2rem;">
            <a href="{{ route('register') }}" class="btn btn-primary" style="display: inline-flex;">
                Start Your Journey Today
            </a>
        </div>
        <p style="color: #64748b; font-size: 0.875rem;">
            © 2024 JD & Jordon. All rights reserved.
        </p>
    </footer>

    <script>
        // Smooth scroll animation
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Parallax effect
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const hero = document.querySelector('.hero');
            if (hero) {
                hero.style.transform = `translateY(${scrolled * 0.05}px)`;
            }
        });

        // Intersection observer for fade-in animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                }
            });
        }, observerOptions);

        // Observe feature cards
        document.querySelectorAll('.feature-card').forEach(card => {
            observer.observe(card);
        });
    </script>
</body>
</html>