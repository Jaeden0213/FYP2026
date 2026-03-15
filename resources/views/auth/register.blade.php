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
            transition: transform 0.3s ease, box-shadow 0.3s ease;
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
        }

        /* Form */
        .register-form {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-label {
            color: #4a5568;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Input Container */
        .input-container {
            position: relative;
            width: 100%;
            transition: transform 0.2s ease;
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

        .form-input {
            width: 100%;
            padding: 18px 20px 18px 56px;
            font-size: 16px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            background: white;
            color: #2d3748;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
        }

        .form-input:focus + .input-icon .icon {
            color: #10b981;
        }

        /* Password Strength UI */
        .password-strength {
            margin-top: 8px;
        }

        .strength-meter {
            height: 6px;
            background: #e2e8f0;
            border-radius: 3px;
            overflow: hidden;
            margin-bottom: 6px;
        }

        .strength-fill {
            height: 100%;
            width: 0%;
            background: #ef4444;
            transition: width 0.4s ease, background-color 0.4s ease;
        }

        .strength-text {
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .strength-requirements {
            padding: 12px;
            background: #f9fafb;
            border-radius: 8px;
            border-left: 3px solid #cbd5e0;
        }

        .requirements-title {
            font-size: 12px;
            font-weight: 700;
            color: #4a5568;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .requirements-list {
            list-style: none;
        }

        .requirement-item {
            font-size: 12px;
            color: #718096;
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: color 0.3s ease;
        }

        .requirement-item::before {
            content: '○';
            font-weight: bold;
        }

        .requirement-item.valid {
            color: #10b981;
        }

        .requirement-item.valid::before {
            content: '✓';
        }

        /* Register Button */
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
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
            text-transform: uppercase;
            margin-top: 10px;
        }

        .register-button:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
        }

        .register-button:disabled {
            background: #cbd5e0;
            cursor: not-allowed;
            box-shadow: none;
        }

        /* Footer */
        .login-container {
            text-align: center;
            margin-top: 32px;
            padding-top: 32px;
            border-top: 1px solid #e2e8f0;
        }

        .login-cta-link {
            color: #3b82f6;
            font-weight: 600;
            text-decoration: none;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(16, 185, 129, 0); }
            100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }
    </style>
</head>
<body>
    <div class="register-page">
        <div class="register-card">
            <div class="register-header">
                <div class="register-logo">YOURAPP</div>
                <h1 class="register-title">Create Account</h1>
                <p class="register-subtitle">Join our community today</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="register-form" id="registerForm">
                @csrf

                <div class="form-group">
    <label for="name" class="form-label">Full Name</label>
    <div class="input-container">
        <div class="input-icon">
            <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
        </div>
        <input id="name" class="form-input @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Jordon Tee" />
    </div>
    @error('name')
        <span class="error-text" style="color: #ef4444; font-size: 12px; margin-top: 5px; font-weight: 600;">{{ $message }}</span>
    @enderror
</div>

                <div class="form-group">
    <label for="email" class="form-label">Email Address</label>
    <div class="input-container">
        <div class="input-icon">
            <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
            </svg>
        </div>
        <input id="email" class="form-input @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required placeholder="Jordon@example.com" />
    </div>
    @error('email')
        <span class="error-text" style="color: #ef4444; font-size: 12px; margin-top: 5px; font-weight: 600;">
            {{ $message }} </span>
    @enderror
</div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-container">
                        <div class="input-icon">
                            <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input id="password" class="form-input" type="password" name="password" required placeholder="••••••••" />
                    </div>

                    <div class="password-strength">
                        <div class="strength-meter">
                            <div id="strengthFill" class="strength-fill"></div>
                        </div>
                        <div id="strengthText" class="strength-text" style="color: #ef4444;">Too short</div>
                        
                        <div class="strength-requirements">
                            <p class="requirements-title">Security Check:</p>
                            <ul class="requirements-list">
                                <li id="reqLength" class="requirement-item">Min. 8 characters</li>
                                <li id="reqUppercase" class="requirement-item">Uppercase (A-Z)</li>
                                <li id="reqLowercase" class="requirement-item">Lowercase (a-z)</li>
                                <li id="reqNumber" class="requirement-item">Number (0-9)</li>
                                <li id="reqSpecial" class="requirement-item">Symbol (!@#$%^&*)</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <div class="input-container">
                        <div class="input-icon">
                            <svg class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <input id="password_confirmation" class="form-input" type="password" name="password_confirmation" required placeholder="••••••••" />
                    </div>
                    <div id="passwordMatch" class="strength-text" style="color: #10b981; display: none; margin-top: 8px;">✓ Passwords match</div>
                    <div id="passwordMismatch" class="strength-text" style="color: #ef4444; display: none; margin-top: 8px;">✗ Passwords do not match</div>
                </div>

                <button type="submit" class="register-button" id="registerButton" disabled>
                    Complete Security Check
                </button>
            </form>

            <div class="login-container">
                <p class="login-text">
                    Already have an account?
                    <a href="{{ route('login') }}" class="login-cta-link">Sign in</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const confirmInput = document.getElementById('password_confirmation');
        const registerButton = document.getElementById('registerButton');

        function updateComplexity() {
            const val = passwordInput.value;
            const checks = {
                length: val.length >= 8,
                upper: /[A-Z]/.test(val),
                lower: /[a-z]/.test(val),
                num: /[0-9]/.test(val),
                spec: /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(val)
            };

            // Update UI Checklist
            document.getElementById('reqLength').className = checks.length ? 'requirement-item valid' : 'requirement-item';
            document.getElementById('reqUppercase').className = checks.upper ? 'requirement-item valid' : 'requirement-item';
            document.getElementById('reqLowercase').className = checks.lower ? 'requirement-item valid' : 'requirement-item';
            document.getElementById('reqNumber').className = checks.num ? 'requirement-item valid' : 'requirement-item';
            document.getElementById('reqSpecial').className = checks.spec ? 'requirement-item valid' : 'requirement-item';

            // Calculate score
            const passedCount = Object.values(checks).filter(Boolean).length;
            const score = (passedCount / 5) * 100;
            
            const fill = document.getElementById('strengthFill');
            const text = document.getElementById('strengthText');
            fill.style.width = score + "%";

            if (score <= 20) {
                fill.style.backgroundColor = '#ef4444';
                text.textContent = "Very Weak";
                text.style.color = '#ef4444';
            } else if (score <= 60) {
                fill.style.backgroundColor = '#f59e0b';
                text.textContent = "Weak";
                text.style.color = '#f59e0b';
            } else if (score <= 80) {
                fill.style.backgroundColor = '#3b82f6';
                text.textContent = "Good";
                text.style.color = '#3b82f6';
            } else {
                fill.style.backgroundColor = '#10b981';
                text.textContent = "Strong Password";
                text.style.color = '#10b981';
            }

            return passedCount === 5;
        }

        function validateForm() {
            const isComplex = updateComplexity();
            const passwordsMatch = passwordInput.value === confirmInput.value && confirmInput.value !== "";
            
            // Show/Hide match text
            if (confirmInput.value !== "") {
                document.getElementById('passwordMatch').style.display = passwordsMatch ? 'block' : 'none';
                document.getElementById('passwordMismatch').style.display = passwordsMatch ? 'none' : 'block';
            }

            if (isComplex && passwordsMatch) {
                registerButton.disabled = false;
                registerButton.textContent = "Create Account";
                registerButton.style.animation = "pulse 2s infinite";
            } else {
                registerButton.disabled = true;
                registerButton.style.animation = "none";
                if (!isComplex) registerButton.textContent = "Password Too Weak";
                else if (!passwordsMatch) registerButton.textContent = "Passwords Must Match";
            }
        }

        passwordInput.addEventListener('input', validateForm);
        confirmInput.addEventListener('input', validateForm);

        // Visual effects
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('focus', () => input.parentElement.style.transform = 'scale(1.02)');
            input.addEventListener('blur', () => input.parentElement.style.transform = 'scale(1)');
        });
    </script>
</body>
</html>