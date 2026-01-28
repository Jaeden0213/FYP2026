<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Your App</title>
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
        .register-page {
            width: 100%;
            max-width: 500px;
            animation: fadeIn 0.8s ease-out;
        }

        /* Register Card */
        .register-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            padding: 48px;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        /* Decorative Elements */
        .register-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(90deg, #10b981, #3b82f6);
        }

        /* Header */
        .register-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .register-logo {
            font-size: 32px;
            font-weight: 800;
            background: linear-gradient(90deg, #10b981, #3b82f6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 16px;
            letter-spacing: -0.5px;
        }

        .register-title {
            color: #2d3748;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .register-subtitle {
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
        .register-form {
            display: flex;
            flex-direction: column;
            gap: 24px;
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

        .login-link {
            color: #3b82f6;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .login-link:hover {
            color: #1d4ed8;
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
            border-color: #10b981;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }

        .form-input:focus + .input-icon .icon {
            color: #10b981;
        }

        .form-input::placeholder {
            color: #a0aec0;
        }

        /* Password Strength Indicator */
        .password-strength {
            margin-top: 8px;
        }

        .strength-meter {
            height: 6px;
            background: #e2e8f0;
            border-radius: 3px;
            overflow: hidden;
            margin-bottom: 4px;
        }

        .strength-fill {
            height: 100%;
            width: 0%;
            background: #ef4444;
            border-radius: 3px;
            transition: all 0.3s ease;
        }

        .strength-text {
            font-size: 12px;
            color: #6b7280;
            font-weight: 500;
        }

        .strength-requirements {
            margin-top: 12px;
            padding: 12px;
            background: #f9fafb;
            border-radius: 8px;
            border-left: 3px solid #10b981;
        }

        .requirements-title {
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }

        .requirements-list {
            list-style: none;
            padding-left: 0;
        }

        .requirement-item {
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .requirement-item::before {
            content: "•";
            color: #9ca3af;
        }

        .requirement-item.valid {
            color: #10b981;
        }

        .requirement-item.valid::before {
            content: "✓";
            color: #10b981;
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

        /* Terms and Conditions */
        .terms-container {
            margin-top: 8px;
            padding: 16px;
            background: #f8fafc;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
        }

        .terms-checkbox-container {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .terms-checkbox {
            width: 20px;
            height: 20px;
            border: 2px solid #cbd5e0;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .terms-checkbox:checked {
            background-color: #10b981;
            border-color: #10b981;
        }

        .terms-checkbox:checked::after {
            content: '✓';
            position: absolute;
            color: white;
            font-size: 14px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .terms-label {
            color: #4a5568;
            font-size: 14px;
            cursor: pointer;
            font-weight: 500;
            line-height: 1.5;
        }

        .terms-text {
            color: #6b7280;
            font-size: 13px;
            margin-top: 4px;
            line-height: 1.4;
        }

        .terms-link {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 500;
        }

        .terms-link:hover {
            text-decoration: underline;
        }

        /* Register Button */
        .button-container {
            margin-top: 16px;
        }

        .register-button {
            width: 100%;
            padding: 18px;
            background: linear-gradient(90deg, #10b981, #3b82f6);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.4s ease;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .register-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
        }

        .register-button:active {
            transform: translateY(0);
        }

        .register-button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
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

        /* Social Login */
        .social-container {
            margin-bottom: 32px;
        }

        .social-buttons {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-top: 16px;
        }

        .social-button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 14px;
            background: white;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            color: #4a5568;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .social-button:hover {
            background: #f8fafc;
            border-color: #10b981;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }

        .social-icon {
            width: 18px;
            height: 18px;
        }

        /* Login Link Container */
        .login-container {
            text-align: center;
            margin-top: 32px;
            padding-top: 32px;
            border-top: 1px solid #e2e8f0;
        }

        .login-text {
            color: #718096;
            font-size: 15px;
        }

        .login-cta-link {
            color: #3b82f6;
            font-weight: 600;
            text-decoration: none;
            margin-left: 8px;
            transition: all 0.3s ease;
            position: relative;
        }

        .login-cta-link:hover {
            color: #1d4ed8;
        }

        .login-cta-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #3b82f6, #10b981);
            transition: width 0.3s ease;
        }

        .login-cta-link:hover::after {
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

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(16, 185, 129, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .register-card {
                padding: 40px;
                border-radius: 20px;
            }

            .register-title {
                font-size: 24px;
            }

            .form-input {
                padding: 16px 16px 16px 52px;
            }

            .social-buttons {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 16px;
                background: #667eea;
            }

            .register-card {
                padding: 32px 24px;
                border-radius: 16px;
                box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            }

            .register-header {
                margin-bottom: 32px;
            }

            .register-title {
                font-size: 22px;
            }

            .register-subtitle {
                font-size: 14px;
            }

            .form-input {
                padding: 14px 14px 14px 48px;
                font-size: 15px;
            }

            .register-button {
                padding: 16px;
                font-size: 15px;
            }

            .divider-text {
                padding: 0 16px;
                font-size: 13px;
            }
        }

        @media (max-width: 360px) {
            .register-card {
                padding: 24px 20px;
            }

            .form-label-container {
                flex-direction: column;
                align-items: flex-start;
                gap: 6px;
            }

            .login-link {
                align-self: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="register-page">
        <div class="register-card">
            <!-- Header -->
            <div class="register-header">
                <div class="register-logo">LOGO</div>
                <h1 class="register-title">Create Account</h1>
                <p class="register-subtitle">Join our community today</p>
            </div>

            <!-- Session Status -->
            @if(session('status'))
                <div class="session-status">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Register Form -->
            <form method="POST" action="{{ route('register') }}" class="register-form" id="registerForm">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <div class="form-label-container">
                        <label for="name" class="form-label">Full Name</label>
                    </div>
                    <div class="input-container">
                        <div class="input-icon">
                            <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <input id="name" class="form-input" 
                               type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" 
                               placeholder="John Doe" />
                    </div>
                    @if($errors->has('name'))
                        <ul class="error-messages">
                            @foreach($errors->get('name') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>

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
                               type="email" name="email" value="{{ old('email') }}" required autocomplete="email" 
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
                    </div>
                    <div class="input-container">
                        <div class="input-icon">
                            <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input id="password" class="form-input"
                               type="password" name="password" required autocomplete="new-password" 
                               placeholder="••••••••" />
                    </div>
                    
                    <!-- Password Strength Indicator -->
                    <div class="password-strength">
                        <div class="strength-meter">
                            <div class="strength-fill" id="strengthFill"></div>
                        </div>
                        <div class="strength-text" id="strengthText">Password strength: Very weak</div>
                        
                        <div class="strength-requirements">
                            <div class="requirements-title">Password Requirements:</div>
                            <ul class="requirements-list">
                                <li class="requirement-item" id="reqLength">At least 8 characters</li>
                                <li class="requirement-item" id="reqUppercase">One uppercase letter</li>
                                <li class="requirement-item" id="reqLowercase">One lowercase letter</li>
                                <li class="requirement-item" id="reqNumber">One number</li>
                                <li class="requirement-item" id="reqSpecial">One special character</li>
                            </ul>
                        </div>
                    </div>
                    
                    @if($errors->has('password'))
                        <ul class="error-messages">
                            @foreach($errors->get('password') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <div class="form-label-container">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                    </div>
                    <div class="input-container">
                        <div class="input-icon">
                            <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <input id="password_confirmation" class="form-input"
                               type="password" name="password_confirmation" required autocomplete="new-password" 
                               placeholder="••••••••" />
                    </div>
                    <div id="passwordMatch" class="strength-text" style="color: #10b981; display: none;">✓ Passwords match</div>
                    <div id="passwordMismatch" class="strength-text" style="color: #ef4444; display: none;">✗ Passwords do not match</div>
                    
                    @if($errors->has('password_confirmation'))
                        <ul class="error-messages">
                            @foreach($errors->get('password_confirmation') as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                

                <!-- Register Button -->
                <div class="button-container">
                    <button type="submit" class="register-button" id="registerButton">
                        Create Account
                    </button>
                </div>
            </form>

            

           

            <!-- Login Link -->
            <div class="login-container">
                <p class="login-text">
                    Already have an account?
                    <a href="{{ route('login') }}" class="login-cta-link">
                        Sign in
                    </a>
                </p>
            </div>
        </div>
    </div>

    <script>
        // Password Strength Calculator
        function calculatePasswordStrength(password) {
            let strength = 0;
            const requirements = {
                length: password.length >= 8,
                uppercase: /[A-Z]/.test(password),
                lowercase: /[a-z]/.test(password),
                number: /\d/.test(test(password),
                special: /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password)
            };

            // Update requirement indicators
            document.getElementById('reqLength').className = requirements.length ? 'requirement-item valid' : 'requirement-item';
            document.getElementById('reqUppercase').className = requirements.uppercase ? 'requirement-item valid' : 'requirement-item';
            document.getElementById('reqLowercase').className = requirements.lowercase ? 'requirement-item valid' : 'requirement-item';
            document.getElementById('reqNumber').className = requirements.number ? 'requirement-item valid' : 'requirement-item';
            document.getElementById('reqSpecial').className = requirements.special ? 'requirement-item valid' : 'requirement-item';

            // Calculate strength score
            strength += requirements.length ? 20 : 0;
            strength += requirements.uppercase ? 20 : 0;
            strength += requirements.lowercase ? 20 : 0;
            strength += requirements.number ? 20 : 0;
            strength += requirements.special ? 20 : 0;

            // Update strength meter
            const strengthFill = document.getElementById('strengthFill');
            const strengthText = document.getElementById('strengthText');
            
            strengthFill.style.width = `${strength}%`;
            
            if (strength < 40) {
                strengthFill.style.backgroundColor = '#ef4444';
                strengthText.textContent = 'Password strength: Very weak';
                strengthText.style.color = '#ef4444';
            } else if (strength < 60) {
                strengthFill.style.backgroundColor = '#f59e0b';
                strengthText.textContent = 'Password strength: Weak';
                strengthText.style.color = '#f59e0b';
            } else if (strength < 80) {
                strengthFill.style.backgroundColor = '#3b82f6';
                strengthText.textContent = 'Password strength: Good';
                strengthText.style.color = '#3b82f6';
            } else if (strength < 100) {
                strengthFill.style.backgroundColor = '#10b981';
                strengthText.textContent = 'Password strength: Strong';
                strengthText.style.color = '#10b981';
            } else {
                strengthFill.style.backgroundColor = '#10b981';
                strengthText.textContent = 'Password strength: Very strong';
                strengthText.style.color = '#10b981';
                strengthFill.style.animation = 'pulse 2s infinite';
            }
        }

        // Password Match Checker
        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const matchElement = document.getElementById('passwordMatch');
            const mismatchElement = document.getElementById('passwordMismatch');
            
            if (confirmPassword.length === 0) {
                matchElement.style.display = 'none';
                mismatchElement.style.display = 'none';
                return;
            }
            
            if (password === confirmPassword) {
                matchElement.style.display = 'block';
                mismatchElement.style.display = 'none';
            } else {
                matchElement.style.display = 'none';
                mismatchElement.style.display = 'block';
            }
        }

        // Form Validation
        function validateForm() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const termsChecked = document.getElementById('terms').checked;
            const button = document.getElementById('registerButton');
            
            // Check if passwords match
            if (password !== confirmPassword) {
                button.disabled = true;
                button.textContent = 'Passwords must match';
                return false;
            }
            
            // Check terms
            if (!termsChecked) {
                button.disabled = true;
                button.textContent = 'Accept terms to continue';
                return false;
            }
            
            // Enable button
            button.disabled = false;
            button.textContent = 'Create Account';
            return true;
        }

        // Initialize event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Password strength
            const passwordInput = document.getElementById('password');
            passwordInput.addEventListener('input', function() {
                calculatePasswordStrength(this.value);
                checkPasswordMatch();
                validateForm();
            });
            
            // Confirm password
            const confirmInput = document.getElementById('password_confirmation');
            confirmInput.addEventListener('input', function() {
                checkPasswordMatch();
                validateForm();
            });
            
            // Terms checkbox
            const termsCheckbox = document.getElementById('terms');
            termsCheckbox.addEventListener('change', validateForm);
            
            // Form submission animation
            const form = document.getElementById('registerForm');
            form.addEventListener('submit', function(e) {
                if (!validateForm()) {
                    e.preventDefault();
                    return;
                }
                
                const button = this.querySelector('.register-button');
                button.innerHTML = '<span style="display: inline-block; animation: spin 1s linear infinite;">⟳</span> Creating Account...';
                button.style.opacity = '0.8';
                button.disabled = true;
                
                // Add spin animation
                const style = document.createElement('style');
                style.textContent = '@keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }';
                document.head.appendChild(style);
            });
            
            // Card hover effect
            const card = document.querySelector('.register-card');
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
                this.style.boxShadow = '0 25px 80px rgba(0, 0, 0, 0.2)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '0 20px 60px rgba(0, 0, 0, 0.15)';
            });
            
            // Input focus effects
            const inputs = document.querySelectorAll('.form-input');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'scale(1.01)';
                });
                
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'scale(1)';
                });
            });
        });
    </script>
</body>
</html>