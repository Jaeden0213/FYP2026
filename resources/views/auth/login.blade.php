<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Your App</title>
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* Main Container */
        .login-page {
            width: 100%;
            max-width: 500px;
            animation: fadeIn 0.8s ease-out;
        }

        /* Login Card */
        .login-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            padding: 48px;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        /* Decorative Elements */
        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #667eea, #764ba2);
        }

        /* Header */
        .login-header {
            text-align: center;
            margin-bottom: 48px;
        }

        .login-logo {
            font-size: 32px;
            font-weight: 800;
            background: linear-gradient(90deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 16px;
            letter-spacing: -0.5px;
        }

        .login-title {
            color: #2d3748;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .login-subtitle {
            color: #718096;
            font-size: 16px;
            font-weight: 400;
        }

        /* Session Status */
        .session-status {
            background: linear-gradient(90deg, #ebf8ff, #bee3f8);
            border-left: 4px solid #3182ce;
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 32px;
            color: #2c5282;
            font-size: 14px;
            font-weight: 500;
        }

        /* Form */
        .login-form {
            display: flex;
            flex-direction: column;
            gap: 28px;
        }

        /* Form Groups */
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-label-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .form-label {
            color: #4a5568;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .forgot-password {
            color: #667eea;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .forgot-password:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        /* Input Container */
        .input-container {
            position: relative;
            width: 100%;
        }

        .input-icon {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            z-index: 10;
        }

        .icon {
            width: 20px;
            height: 20px;
            color: #a0aec0;
            transition: color 0.3s ease;
        }

        /* Form Input */
        .form-input {
            width: 100%;
            padding: 18px 20px 18px 56px;
            font-size: 16px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            background: white;
            color: #2d3748;
            transition: all 0.3s ease;
            font-weight: 400;
        }

        .form-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .form-input:focus + .input-icon .icon {
            color: #667eea;
        }

        .form-input::placeholder {
            color: #a0aec0;
        }

        /* Error Messages */
        .error-messages {
            color: #e53e3e;
            font-size: 14px;
            margin-top: 6px;
            list-style: none;
            background: #fff5f5;
            padding: 12px;
            border-radius: 8px;
            border-left: 4px solid #e53e3e;
        }

        .error-messages li {
            margin-bottom: 4px;
        }

        .error-messages li:last-child {
            margin-bottom: 0;
        }

        /* Remember Me */
        .remember-container {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 8px;
        }

        .remember-checkbox {
            width: 20px;
            height: 20px;
            border: 2px solid #cbd5e0;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
        }

        .remember-checkbox:checked {
            background-color: #667eea;
            border-color: #667eea;
        }

        .remember-checkbox:checked::after {
            content: '✓';
            position: absolute;
            color: white;
            font-size: 14px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .remember-label {
            color: #4a5568;
            font-size: 15px;
            cursor: pointer;
            font-weight: 500;
        }

        /* Login Button */
        .button-container {
            margin-top: 16px;
        }

        .login-button {
            width: 100%;
            padding: 18px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.4s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .login-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        .login-button:active {
            transform: translateY(0);
        }

        /* Divider */
        .divider {
            display: flex;
            align-items: center;
            margin: 32px 0;
        }

        .divider-line {
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, #e2e8f0, transparent);
        }

        .divider-text {
            padding: 0 20px;
            color: #a0aec0;
            font-size: 14px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Google Button */
        .google-container {
            margin-bottom: 32px;
        }

        .google-button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            width: 100%;
            padding: 18px;
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            color: #4a5568;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .google-button:hover {
            background: #f8fafc;
            border-color: #667eea;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .google-icon {
            width: 20px;
            height: 20px;
        }

        /* Sign Up Link */
        .signup-container {
            text-align: center;
            margin-top: 32px;
            padding-top: 32px;
            border-top: 1px solid #e2e8f0;
        }

        .signup-text {
            color: #718096;
            font-size: 15px;
        }

        .signup-link {
            color: #667eea;
            font-weight: 600;
            text-decoration: none;
            margin-left: 8px;
            transition: all 0.3s ease;
            position: relative;
        }

        .signup-link:hover {
            color: #764ba2;
        }

        .signup-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            transition: width 0.3s ease;
        }

        .signup-link:hover::after {
            width: 100%;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .login-card {
                padding: 40px;
                border-radius: 20px;
            }

            .login-title {
                font-size: 24px;
            }

            .form-input {
                padding: 16px 16px 16px 52px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 16px;
                background: #667eea;
            }

            .login-card {
                padding: 32px 24px;
                border-radius: 16px;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            }

            .login-header {
                margin-bottom: 36px;
            }

            .login-title {
                font-size: 22px;
            }

            .login-subtitle {
                font-size: 14px;
            }

            .form-input {
                padding: 14px 14px 14px 48px;
                font-size: 15px;
            }

            .login-button,
            .google-button {
                padding: 16px;
                font-size: 15px;
            }

            .divider-text {
                padding: 0 16px;
                font-size: 13px;
            }
        }

        @media (max-width: 360px) {
            .login-card {
                padding: 24px 20px;
            }

            .form-label-container {
                flex-direction: column;
                align-items: flex-start;
                gap: 6px;
            }

            .forgot-password {
                align-self: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="login-page">
        <div class="login-card">
            <!-- Header -->
            <div class="login-header">
                <div class="login-logo">LOGO</div>
                <h1 class="login-title">Welcome Back</h1>
                <p class="login-subtitle">Sign in to your account to continue</p>
            </div>

            <!-- Session Status -->
            @if(session('status'))
                <div class="session-status">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="login-form">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <div class="form-label-container">
                        <label for="email" class="form-label">Email Address</label>
                    </div>
                    <div class="input-container">
                        <div class="input-icon">
                            <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input id="email" class="form-input" 
                               type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                               placeholder="you@example.com" />
                    </div>
                    @if($errors->has('email'))
                        <ul class="error-messages">
                            @foreach($errors->get('email') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <!-- Password -->
                <div class="form-group">
                    <div class="form-label-container">
                        <label for="password" class="form-label">Password</label>
                        @if (Route::has('password.request'))
                            <a class="forgot-password" href="{{ route('password.request') }}">
                                Forgot password?
                            </a>
                        @endif
                    </div>
                    <div class="input-container">
                        <div class="input-icon">
                            <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input id="password" class="form-input"
                               type="password" name="password" required autocomplete="current-password" 
                               placeholder="••••••••" />
                    </div>
                    @if($errors->has('password'))
                        <ul class="error-messages">
                            @foreach($errors->get('password') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                

                <!-- Login Button -->
                <div class="button-container">
                    <button type="submit" class="login-button">
                        Sign In
                    </button>
                </div>
            </form>

            <!-- Divider -->
            <div class="divider">
                <div class="divider-line"></div>
                <span class="divider-text">Or continue with</span>
                <div class="divider-line"></div>
            </div>

            <!-- Google Login -->
            <div class="google-container">
                <a href="{{ url('auth/google') }}" class="google-button">
                    <svg class="google-icon" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    Sign in with Google
                </a>
            </div>

            <!-- Sign up link -->
            @if (Route::has('register'))
                <div class="signup-container">
                    <p class="signup-text">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="signup-link">
                            Sign up
                        </a>
                    </p>
                </div>
            @endif
        </div>
    </div>

    <script>
        // Add some interactivity
        document.addEventListener('DOMContentLoaded', function() {
            // Add focus/blur animations to inputs
            const inputs = document.querySelectorAll('.form-input');
            
            inputs.forEach(input => {
                // Add focus effect
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'scale(1.01)';
                });
                
                // Remove focus effect
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'scale(1)';
                });
            });

            // Add hover effect to card
            const card = document.querySelector('.login-card');
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
                this.style.boxShadow = '0 25px 80px rgba(0, 0, 0, 0.2)';
            });

            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '0 20px 60px rgba(0, 0, 0, 0.15)';
            });

            // Form submission animation
            const form = document.querySelector('.login-form');
            form.addEventListener('submit', function(e) {
                const button = this.querySelector('.login-button');
                button.innerHTML = 'Signing in...';
                button.style.opacity = '0.8';
                button.style.transform = 'scale(0.98)';
            });

            // Error message animation
            const errorMessages = document.querySelectorAll('.error-messages');
            errorMessages.forEach(error => {
                error.style.animation = 'slideIn 0.5s ease-out';
            });
        });
    </script>
</body>
</html>