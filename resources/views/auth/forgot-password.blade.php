
    <style>
        .forgot-password-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
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

        .forgot-password-card {
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
        }

        .text-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.8rem;
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

        .session-status {
            margin: 1rem 2rem;
            padding: 0.75rem 1rem;
            background: #f0fdf4;
            border: 1px solid #dcfce7;
            border-radius: 10px;
            color: #166534;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 8px;
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
            .forgot-password-card {
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
    </style>

    <div class="forgot-password-container">
        <div class="forgot-password-card">
            <!-- Header with gradient accent -->
            <div class="h-2 bg-gradient-to-r from-indigo-500 to-purple-500"></div>
            
            <div class="card-header">
                <h2>Forgot Password?</h2>
            </div>

            <!-- Session Status Message -->
            @if (session('status'))
                <div class="session-status">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="M12 16v-4M12 8h.01"></path>
                    </svg>
                    {{ session('status') }}
                </div>
            @endif

            <div class="card-content">
                <!-- Info Box -->
                <div class="info-box">
                    <div class="info-icon">🔐</div>
                    <div class="info-text">
                        {{ __('No problem! Enter your email below and we\'ll send you a link to reset your password.') }}
                    </div>
                </div>

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="form-group">
                        <label for="email" class="input-label">{{ __('Email Address') }}</label>
                        <div class="input-wrapper">
                            <span class="input-icon">📧</span>
                            <input 
                                id="email" 
                                class="text-input" 
                                type="email" 
                                name="email" 
                                :value="old('email')" 
                                placeholder="you@example.com"
                                required 
                                autofocus 
                            />
                        </div>

                        @error('email')
                            <div class="error-message">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="12" y1="8" x2="12" y2="12"></line>
                                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit" class="btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="22" y1="2" x2="11" y2="13"></line>
                                <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                            </svg>
                            {{ __('Send Reset Link') }}
                        </button>
                    </div>

                    <a href="{{ route('login') }}" class="back-link">
                        <span>←</span> {{ __('Back to Login') }}
                    </a>
                </form>
            </div>
        </div>
    </div>
