<style>
    body {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        min-height: 100vh;
        margin: 0;
        padding: 0;
    }

    .access-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .access-card {
        background: white;
        border-radius: 16px;
        padding: 48px 40px;
        width: 100%;
        max-width: 480px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
        border: 1px solid #e2e8f0;
        text-align: center;
    }

    .icon-container {
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 32px;
        border: 8px solid #fef2f2;
    }

    .icon-container img {
        width: 64px;
        height: 64px;
        filter: invert(27%) sepia(95%) saturate(2878%) hue-rotate(346deg) brightness(104%) contrast(97%);
    }

    .title {
        font-size: 28px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 12px;
        letter-spacing: -0.01em;
    }

    .subtitle {
        font-size: 16px;
        color: #64748b;
        line-height: 1.6;
        margin-bottom: 32px;
        max-width: 320px;
        margin-left: auto;
        margin-right: auto;
    }

    .warning-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #fef3c7;
        color: #92400e;
        padding: 10px 20px;
        border-radius: 50px;
        font-size: 14px;
        font-weight: 500;
        margin-bottom: 32px;
    }

    .warning-badge::before {
        content: "⚠️";
        font-size: 16px;
    }

    .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 16px;
        margin-top: 32px;
    }

    .btn {
        padding: 14px 24px;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .btn-logout {
        background: #4f46e5;
        color: white;
        box-shadow: 0 4px 14px rgba(79, 70, 229, 0.25);
    }

    .btn-logout:hover {
        background: #4338ca;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.35);
    }

    .btn-appeal {
        background: white;
        color: #4f46e5;
        border: 2px solid #e2e8f0;
    }

    .btn-appeal:hover {
        background: #f8fafc;
        border-color: #c7d2fe;
        transform: translateY(-2px);
    }

    /* Modal Styles */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        padding: 20px;
        backdrop-filter: blur(4px);
    }

    .modal-content {
        background: white;
        border-radius: 20px;
        padding: 32px;
        width: 100%;
        max-width: 480px;
        box-shadow: 0 24px 48px rgba(0, 0, 0, 0.12);
        animation: modalSlideIn 0.3s ease;
    }

    @keyframes modalSlideIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .modal-header {
        margin-bottom: 24px;
    }

    .modal-title {
        font-size: 20px;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 8px;
    }

    .modal-subtitle {
        font-size: 14px;
        color: #64748b;
    }

    .form-group {
        margin-bottom: 24px;
    }

    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 500;
        color: #475569;
        margin-bottom: 8px;
        text-align: left;
    }

    textarea {
        width: 100%;
        padding: 14px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 15px;
        font-family: inherit;
        resize: vertical;
        transition: all 0.2s ease;
        background: #f8fafc;
    }

    textarea:focus {
        outline: none;
        border-color: #4f46e5;
        background: white;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    }

    .modal-actions {
        display: flex;
        gap: 12px;
        margin-top: 24px;
    }

    .btn-secondary {
        flex: 1;
        background: white;
        color: #64748b;
        border: 2px solid #e2e8f0;
        padding: 12px 20px;
    }

    .btn-secondary:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
    }

    .btn-primary {
        flex: 1;
        background: #4f46e5;
        color: white;
        border: none;
        padding: 12px 20px;
    }

    .btn-primary:hover {
        background: #4338ca;
    }

    /* Alert Messages */
    .alert {
        padding: 14px 20px;
        border-radius: 12px;
        margin-bottom: 24px;
        font-size: 14px;
        text-align: left;
    }

    .alert-success {
        background: #d1fae5;
        color: #065f46;
        border: 1px solid #a7f3d0;
    }

    .alert-error {
        background: #fee2e2;
        color: #991b1b;
        border: 1px solid #fecaca;
    }

    @media (max-width: 640px) {
        .access-card {
            padding: 32px 24px;
        }
        
        .icon-container {
            width: 100px;
            height: 100px;
        }
        
        .title {
            font-size: 24px;
        }
        
        .action-buttons {
            gap: 12px;
        }
        
        .modal-content {
            padding: 24px;
        }
        
        .modal-actions {
            flex-direction: column;
        }
    }
</style>

<div class="access-wrapper">
    <div class="access-card">
        <!-- Icon -->
        <div class="icon-container">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="8" x2="12" y2="12"></line>
                <line x1="12" y1="16" x2="12.01" y2="16"></line>
            </svg>
        </div>

        <!-- Title & Message -->
        <h1 class="title">Account Suspended</h1>
        <p class="subtitle">
            Your account access has been temporarily restricted. Please review your account status or submit an appeal if you believe this is an error.
        </p>

        <!-- Warning Badge -->
        <div class="warning-badge">
            Account Access Restricted
        </div>

        <!-- Alert Messages -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        <!-- Action Buttons -->
        <div class="action-buttons">
            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="btn btn-logout w-full">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>
                    Switch Account
                </button>
            </form>

            <!-- Appeal Button -->
            <button type="button" onclick="openAppealModal()" class="btn btn-appeal">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 19l7-7 3 3-7 7-3-3z"></path>
                    <path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"></path>
                    <path d="M2 2l7.586 7.586"></path>
                    <circle cx="11" cy="11" r="2"></circle>
                </svg>
                Submit Appeal
            </button>
        </div>
    </div>
</div>

<!-- Appeal Modal -->
<div id="appealModal" class="modal-overlay" onclick="closeAppealModal()">
    <div class="modal-content" onclick="event.stopPropagation()">
        <div class="modal-header">
            <h3 class="modal-title">Submit Appeal</h3>
            <p class="modal-subtitle">Explain why your account should be reinstated</p>
        </div>

        <form method="POST" action="{{ route('appeal.store') }}">
            @csrf
            <div class="form-group">
                <label for="appealDescription" class="form-label">Appeal Details</label>
                <textarea 
                    id="appealDescription" 
                    name="description" 
                    rows="6" 
                    required
                    placeholder="Please provide details about why you believe your account should be reactivated..."
                ></textarea>
            </div>

            <div class="modal-actions">
                <button type="button" onclick="closeAppealModal()" class="btn btn-secondary">
                    Cancel
                </button>
                <button type="submit" class="btn btn-primary">
                    Submit Appeal
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openAppealModal() {
        document.getElementById('appealModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeAppealModal() {
        document.getElementById('appealModal').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    // Close modal on ESC key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeAppealModal();
        }
    });

    // Close modal when clicking outside
    document.getElementById('appealModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeAppealModal();
        }
    });
</script>