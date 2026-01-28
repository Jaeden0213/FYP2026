<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email - Your App</title>
    <style>
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

        .verification-container {
            width: 100%;
            max-width: 500px;
        }

        .verification-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            padding: 40px;
            width: 100%;
        }

        .verification-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .verification-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 20px;
            background: #f8f9fa;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .icon-inner {
            width: 35px;
            height: 35px;
            color: #667eea;
        }

        .verification-title {
            color: #2d3748;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .verification-subtitle {
            color: #718096;
            font-size: 15px;
            font-weight: 400;
        }

        .message-box {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
            border-left: 4px solid #667eea;
        }

        .message-text {
            color: #4a5568;
            font-size: 15px;
            line-height: 1.6;
        }

        .success-message {
            background: #d1fae5;
            border-radius: 12px;
            padding: 16px;
            margin-bottom: 20px;
            border-left: 4px solid #10b981;
            display: none;
        }

        .success-message.show {
            display: block;
        }

        .success-text {
            color: #065f46;
            font-size: 14px;
            line-height: 1.5;
            font-weight: 500;
        }

        .actions-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 30px;
        }

        .resend-form {
            width: 100%;
        }

        .resend-button {
            width: 100%;
            padding: 16px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .resend-button:hover {
            background: #5a67d8;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .logout-form {
            width: 100%;
        }

        .logout-button {
            width: 100%;
            padding: 16px;
            background: white;
            color: #4b5563;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .logout-button:hover {
            background: #f9fafb;
            border-color: #667eea;
            color: #667eea;
        }

        .help-section {
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #e5e7eb;
        }

        .help-title {
            color: #4b5563;
            font-size: 15px;
            font-weight: 600;
            margin-bottom: 12px;
            text-align: center;
        }

        .help-list {
            list-style: none;
            padding: 0;
        }

        .help-item {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .help-item:last-child {
            margin-bottom: 0;
        }

        .help-item svg {
            width: 16px;
            height: 16px;
            color: #9ca3af;
        }

        @media (max-width: 480px) {
            .verification-card {
                padding: 30px 24px;
            }
            
            .verification-title {
                font-size: 22px;
            }
            
            .verification-subtitle {
                font-size: 14px;
            }
            
            .message-text {
                font-size: 14px;
            }
            
            .resend-button,
            .logout-button {
                padding: 14px;
                font-size: 15px;
            }
            
            .actions-container {
                gap: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="verification-container">
        <div class="verification-card">
            <!-- Header -->
            <div class="verification-header">
                <div class="verification-icon">
                    <svg class="icon-inner" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <h1 class="verification-title">Verify Your Email</h1>
                <p class="verification-subtitle">Check your inbox to continue</p>
            </div>

            <!-- Main Message -->
            <div class="message-box">
                <p class="message-text">
                    Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
                </p>
            </div>

            <!-- Success Message -->
            @if (session('status') == 'verification-link-sent')
                <div class="success-message show">
                    <p class="success-text">
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                    </p>
                </div>
            @endif

            <!-- Action Buttons -->
            <div class="actions-container">
                <!-- Resend Form -->
                <form method="POST" action="{{ route('verification.send') }}" class="resend-form">
                    @csrf
                    <button type="submit" class="resend-button">
                        {{ __('Resend Verification Email') }}
                    </button>
                </form>

                <!-- Logout Form -->
                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-button">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>

            <!-- Help Section -->
            <div class="help-section">
                <div class="help-title">Tips:</div>
                <ul class="help-list">
                    <li class="help-item">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        Check your spam folder
                    </li>
                    <li class="help-item">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        Verify email address is correct
                    </li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>