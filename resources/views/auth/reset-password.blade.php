
    <style>
         body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .reset-password-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        }

        .reset-password-card {
            max-width: 440px;
            width: 100%;
            background: white;
            border-radius: 24px;
            box-shadow: 0 20px 35px -8px rgba(0, 0, 0, 0.1), 0 10px 15px -6px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            border: 1px solid #e5e7eb;
            animation: slideUp 0.4s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card-gradient {
            height: 4px;
            background: linear-gradient(90deg, #4f46e5, #7c3aed, #c084fc);
        }

        .card-header {
            padding: 2rem 2rem 1rem;
            text-align: center;
        }

        .card-header h2 {
            font-size: 1.875rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .card-header p {
            color: #64748b;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .card-content {
            padding: 1rem 2rem 2rem;
        }

        .info-box {
            background: #f0f9ff;
            border-left: 4px solid #4f46e5;
            padding: 1.25rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .info-icon {
            flex-shrink: 0;
            width: 24px;
            height: 24px;
            background: #4f46e5;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 14px;
        }

        .info-text {
            color: #1e293b;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .input-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 1.1rem;
            z-index: 1;
        }

        .text-input {
            width: 100%;
            padding: 0.875rem 1rem 0.875rem 2.8rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 0.95rem;
            color: #1f2937;
            background: white;
            transition: all 0.2s ease;
        }

        .text-input:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        .text-input::placeholder {
            color: #9ca3af;
        }

        .error-message {
            margin-top: 0.5rem;
            padding: 0.5rem 0.75rem;
            background: #fef2f2;
            border: 1px solid #fee2e2;
            border-radius: 8px;
            color: #dc2626;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .password-requirements {
    margin-top: 1rem;
    display: grid;
    grid-template-columns: 1fr 1fr; /* Two columns */
    gap: 8px;
    padding: 1rem;
    background: #f8fafc;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
}

        .requirement-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #64748b;
            margin-bottom: 0.5rem;
        }

        .requirement-item:last-child {
            margin-bottom: 0;
        }

        .requirement-item.valid {
            color: #10b981;
        }

        .requirement-item i {
            font-size: 14px;
        }

        .btn-primary {
            width: 100%;
            padding: 0.875rem 1.5rem;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(79, 70, 229, 0.3);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 1.5rem;
            color: #6b7280;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .back-link:hover {
            color: #4f46e5;
            text-decoration: underline;
        }

        .back-link span {
            margin-right: 4px;
        }

        @media (max-width: 640px) {
            .reset-password-card {
                max-width: 100%;
                margin: 0 1rem;
            }
            
            .card-header h2 {
                font-size: 1.5rem;
            }
            
            .info-box {
                padding: 1rem;
            }
        }

        /* ===== Password Strength Meter ===== */
.strength-meter-container {
    margin-top: 1rem;
    background: #f1f5f9;
    height: 6px;
    border-radius: 10px;
    overflow: hidden;
    display: flex;
    gap: 4px;
}

.strength-segment {
    flex: 1;
    height: 100%;
    background: #e2e8f0;
    transition: all 0.3s ease;
}

/* Strength Colors */
.strength-weak .segment-1 { background: #ef4444; }
.strength-fair .segment-1, .strength-fair .segment-2 { background: #f59e0b; }
.strength-good .segment-1, .strength-good .segment-2, .strength-good .segment-3 { background: #10b981; }
.strength-strong .strength-segment { background: #059669; }

/* ===== Requirement Checklist ===== */
.password-requirements {
    margin-top: 1rem;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
    padding: 1rem;
    background: #f8fafc;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
}

.requirement-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.75rem;
    color: #94a3b8;
    transition: all 0.2s ease;
}

.requirement-item.valid {
    color: #10b981;
}

.requirement-item i {
    font-size: 10px;
}
    </style>

   
        <div class="reset-password-card">
    <div class="card-gradient"></div>

    <div class="card-header">
        <h2>Reset Password</h2>
        <p>Create a new password for your account</p>
    </div>

    <div class="card-content">
        <div class="info-box">
            <div class="info-icon">🔐</div>
            <div class="info-text">
                {{ __('Choose a strong password that you don\'t use elsewhere. We recommend at least 8 characters with a mix of letters, numbers, and symbols.') }}
            </div>
        </div>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="form-group">
                <label for="email" class="input-label">{{ __('Email Address') }}</label>
                <div class="input-wrapper">
                    <span class="input-icon">📧</span>
                    <input id="email" class="text-input" type="email" name="email"
                        value="{{ old('email', $request->email) }}" placeholder="your@email.com" required autofocus
                        autocomplete="username" readonly />
                </div>
                @error('email')
                    <div class="error-message">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="input-label">{{ __('New Password') }}</label>
                <div class="input-wrapper">
                    <span class="input-icon">🔒</span>
                    <input id="password" class="text-input" type="password" name="password" placeholder="••••••••"
                        required autocomplete="new-password" oninput="checkPasswordStrength(this.value)" />
                </div>

                <div class="strength-meter-container" id="strength-meter">
                    <div class="strength-segment segment-1"></div>
                    <div class="strength-segment segment-2"></div>
                    <div class="strength-segment segment-3"></div>
                    <div class="strength-segment segment-4"></div>
                </div>

                <div class="password-requirements">
                    <div class="requirement-item" id="req-length"><i>●</i> 8+ characters</div>
                    <div class="requirement-item" id="req-upper"><i>●</i> Uppercase (A-Z)</div>
                    <div class="requirement-item" id="req-lower"><i>●</i> Lowercase (a-z)</div>
                    <div class="requirement-item" id="req-number"><i>●</i> Number (0-9)</div>
                    <div class="requirement-item" id="req-special"><i>●</i> Symbol (!@#$)</div>
                </div>

                @error('password')
                    <div class="error-message">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="input-label">{{ __('Confirm New Password') }}</label>
                <div class="input-wrapper">
                    <span class="input-icon">✓</span>
                    <input id="password_confirmation" class="text-input" type="password" name="password_confirmation"
                        placeholder="••••••••" required autocomplete="new-password" />
                </div>
                @error('password_confirmation')
                    <div class="error-message">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
                {{ __('Reset Password') }}
            </button>

            <a href="{{ route('login') }}" class="back-link">
                <span>←</span> {{ __('Back to Login') }}
            </a>
        </form>
    </div>
</div>

        <script>
function checkPasswordStrength(password) {
    const meter = document.getElementById('strength-meter');
    const requirements = {
        length: password.length >= 8,
        upper: /[A-Z]/.test(password),
        lower: /[a-z]/.test(password), // New 5th check
        number: /[0-9]/.test(password),
        special: /[!@#$%^&*(),.?":{}|<>]/.test(password)
    };

    // Update Checklist Colors
    updateRequirement('req-length', requirements.length);
    updateRequirement('req-upper', requirements.upper);
    updateRequirement('req-lower', requirements.lower); // New 5th check
    updateRequirement('req-number', requirements.number);
    updateRequirement('req-special', requirements.special);

    // Calculate Score (Now out of 5)
    let score = Object.values(requirements).filter(Boolean).length;

    // Update Meter Class (Adjusted for 5 points)
    meter.className = 'strength-meter-container'; 
    if (password.length > 0) {
        if (score <= 2) meter.classList.add('strength-weak');
        else if (score === 3) meter.classList.add('strength-fair');
        else if (score === 4) meter.classList.add('strength-good');
        else if (score === 5) meter.classList.add('strength-strong');
    }
}

function updateRequirement(id, isValid) {
    const el = document.getElementById(id);
    if (isValid) {
        el.classList.add('valid');
        el.querySelector('i').innerHTML = '✓';
    } else {
        el.classList.remove('valid');
        el.querySelector('i').innerHTML = '●';
    }
}
</script>
    
