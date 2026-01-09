<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome | JD & Jordan FYP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
        }

        body {
            background: #020617;
            color: white;
            overflow-x: hidden;
            padding-top: 80px; /* adjust to header height */

            
        }

        header {
         position: sticky;
         top: 0;
         z-index: 1000;
        }


        /* ===== NAV ===== */
        .nav {
            position: fixed;
            top: 0;
            width: 100%;
            padding: 16px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 50;
            background: rgba(2, 6, 23, 0.7);
            backdrop-filter: blur(12px);
        }

        .nav h1 {
            font-size: 1.2rem;
            font-weight: 700;
        }

        .nav a {
            margin-left: 12px;
            padding: 8px 16px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
        }

        .btn-login {
            border: 1px solid #22c55e;
            color: #22c55e;
        }

        .btn-register {
            background: #22c55e;
            color: black;
        }

        /* ===== PARALLAX BACKGROUND ===== */
        .parallax-bg {
            position: fixed;
            inset: 0;
          background: radial-gradient(circle at 20% 20%, #0f4b53ff, transparent 40%),
            radial-gradient(circle at 80% 60%, #44073fff, transparent 40%);

            transform: translateY(0);
            z-index: -1;
        }

        /* ===== HERO ===== */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding-top: 80px;
        }

        .hero-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            max-width: 1100px;
            padding: 40px;
            align-items: center;
        }

        /* ===== ANIMATED TEXT ===== */
        .hero-text {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease;
        }

        .hero-text.show {
            opacity: 1;
            transform: translateY(0);
        }

        .hero-text h2 {
            font-size: 3rem;
            line-height: 1.1;
            margin-bottom: 20px;
        }

        .hero-text p {
            font-size: 1.1rem;
            color: #cbd5f5;
            margin-bottom: 30px;
        }

        .hero-buttons a {
            margin-right: 12px;
            padding: 12px 22px;
            border-radius: 12px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
        }

        /* ===== IMAGE + TILT ===== */
        .hero-image-wrapper {
            perspective: 1000px;
            display: flex;
            justify-content: center;
        }

        .hero-image {
            width: 420px;
            transition: transform 0.15s ease-out;
            will-change: transform;
        }

        /* ===== SCROLL SPACE ===== */
        .scroll-space {
            height: 120vh;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 900px) {
            .hero-content {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .hero-image {
                width: 300px;
            }
        }
    </style>
</head>

<body>
    

    <!-- BACKGROUND -->
    <div class="parallax-bg" id="parallaxBg"></div>

    <!-- NAV -->
    <div class="nav">
        <h1>JD & Jordan</h1>
        <div>
            <a href="{{ route('login') }}" class="btn-login">Login</a>
            <a href="{{ route('register') }}" class="btn-register">Register</a>
        </div>
    </div>

    <!-- HERO -->
    <section class="hero">
        
        <div class="hero-content">
            
            <div class="hero-text" id="heroText">
                <h2>Plan smarter.<br>Achieve more.</h2>
                <p>
                    A modern student productivity platform that helps you
                    manage tasks, deadlines, and priorities effortlessly.
                </p>

                <div class="hero-buttons">
                    <a href="{{ route('register') }}" class="btn-register">Get Started</a>
                    <a href="{{ route('login') }}" class="btn-login">Login</a>
                </div>
            </div>

            <div class="hero-image-wrapper">
    <img
        src="{{ asset('images/undraw_completed-tasks_1j9z.svg') }}"
        class="hero-image"
        id="heroImage"
        alt="Completed Tasks Illustration"
    >
</div>

        </div>
    </section>

    <div class="scroll-space"></div>

    <!-- ===== JS EFFECTS ===== -->
    <script>
        const heroText = document.getElementById('heroText');
        const heroImage = document.getElementById('heroImage');
        const bg = document.getElementById('parallaxBg');

        // Fade-in text
        window.addEventListener('load', () => {
            heroText.classList.add('show');
        });

        

        // Mouse tilt effect
        heroImage.addEventListener('mousemove', (e) => {
            const rect = heroImage.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            const rotateX = ((y / rect.height) - 0.5) * -15;
            const rotateY = ((x / rect.width) - 0.5) * 15;

            heroImage.style.transform =
                `rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.05)`;
        });

        heroImage.addEventListener('mouseleave', () => {
            heroImage.style.transform = 'rotateX(0) rotateY(0) scale(1)';
        });
    </script>

</body>
</html>
