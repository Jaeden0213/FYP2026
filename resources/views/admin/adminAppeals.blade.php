<x-app-layout>
    <style>
        .appeal-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            text-transform: capitalize;
        }
        
        .badge-pending {
            background: #fef3c7;
            color: #92400e;
            border: 1px solid #fde68a;
        }
        
        .badge-approved {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
        
        .badge-rejected {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 16px;
        }
        
        .action-btn {
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        
        .btn-approve {
            background: #10b981;
            color: white;
        }
        
        .btn-approve:hover {
            background: #059669;
            transform: translateY(-1px);
        }
        
        .btn-reject {
            background: #ef4444;
            color: white;
        }
        
        .btn-reject:hover {
            background: #dc2626;
            transform: translateY(-1px);
        }
        
        .appeal-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 20px;
            transition: all 0.2s ease;
            margin-bottom: 16px;
        }
        
        .appeal-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border-color: #d1d5db;
        }
        
        .timestamp {
            font-size: 12px;
            color: #6b7280;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        
        .description-box {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 16px;
            margin: 16px 0;
            font-size: 14px;
            line-height: 1.6;
            color: #374151;
            position: relative;
        }
        
        .description-box:before {
            content: "📝";
            position: absolute;
            left: -12px;
            top: 16px;
            background: white;
            padding: 4px;
            border-radius: 50%;
            border: 1px solid #e5e7eb;
        }
        
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
            border-radius: 16px;
            padding: 32px;
            width: 100%;
            max-width: 480px;
            box-shadow: 0 24px 48px rgba(0, 0, 0, 0.12);
        }
        
        .modal-actions {
            display: flex;
            gap: 12px;
            margin-top: 24px;
        }
        
        .empty-state {
            text-align: center;
            padding: 48px 24px;
        }
        
        .empty-icon {
            font-size: 64px;
            margin-bottom: 16px;
            opacity: 0.5;
        }
    </style>

    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-white p-4 md:p-6">
        <!-- Header -->
        <div class="max-w-7xl mx-auto">
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                    <div>
                        <div class="flex items-center gap-4 mb-2">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-indigo-500 to-purple-500 flex items-center justify-center">
                                <span class="text-2xl text-white">⚖️</span>
                            </div>
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900">Appeals Management</h1>
                                <p class="text-gray-600 mt-1">Review and manage user suspension appeals</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-3">
                        <!-- Stats -->
                        <div class="flex items-center space-x-4">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900">{{ $appeals->where('status', 'pending')->count() }}</div>
                                <div class="text-sm text-gray-600">Pending</div>
                            </div>
                            <div class="h-8 w-px bg-gray-300"></div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900">{{ $appeals->count() }}</div>
                                <div class="text-sm text-gray-600">Total</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filter Tabs -->
                <div class="flex space-x-1 bg-gray-100 p-1 rounded-lg mb-6 max-w-md">
                    <button onclick="filterAppeals('all')" 
                            class="flex-1 px-4 py-2 text-sm font-medium rounded-md bg-white shadow-sm">
                        All Appeals
                    </button>
                    <button onclick="filterAppeals('pending')" 
                            class="flex-1 px-4 py-2 text-sm font-medium rounded-md hover:bg-gray-50">
                        Pending
                    </button>
                    <button onclick="filterAppeals('accepted')" 
                            class="flex-1 px-4 py-2 text-sm font-medium rounded-md hover:bg-gray-50">
                        Approved
                    </button>
                    <button onclick="filterAppeals('denied')" 
                            class="flex-1 px-4 py-2 text-sm font-medium rounded-md hover:bg-gray-50">
                        Rejected
                    </button>
                </div>
            </div>

            <!-- Appeals List -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                @if($appeals->count() > 0)
                    <div class="divide-y divide-gray-100">
                        @foreach($appeals as $appeal)
                        <div class="appeal-card" data-status="{{ $appeal->status }}">
                            <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                                <!-- Left Column: User Info & Appeal -->
                                <div class="flex-1">
                                    <div class="flex items-start gap-4">
                                        <!-- User Avatar -->
                                        <div class="user-avatar">
                                            {{ strtoupper(substr($appeal->user->name ?? 'U', 0, 1)) }}
                                        </div>
                                        
                                        <!-- User Details -->
                                        <div class="flex-1">
                                            <div class="flex flex-wrap items-center gap-3 mb-3">
                                                <h3 class="font-semibold text-gray-900">{{ $appeal->user->name ?? 'Unknown User' }}</h3>
                                                <span class="appeal-badge badge-{{ $appeal->status }}">
                                                    @if($appeal->status === 'pending')
                                                        ⏳ Pending Review
                                                    @elseif($appeal->status === 'accepted')
                                                        ✅ Approved
                                                    @else
                                                        ❌ Rejected
                                                    @endif
                                                </span>
                                            </div>
                                            
                                            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600 mb-4">
                                                <div class="flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                    </svg>
                                                    {{ $appeal->user->email ?? 'No email' }}
                                                </div>
                                                <div class="timestamp">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    {{ $appeal->created_at->format('M d, Y g:i A') }}
                                                </div>
                                            </div>
                                            
                                            <!-- Appeal Description -->
                                            <div class="description-box">
                                                <div class="text-sm font-medium text-gray-700 mb-2">Appeal Message:</div>
                                                <p class="whitespace-pre-line">{{ $appeal->description }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Right Column: Actions -->
                                <div class="flex flex-col items-end gap-3">
                                    @if($appeal->status === 'pending')
                                        <div class="flex items-center gap-2">
                                            <form method="POST" action="{{ route('admin.appeals.approve', $appeal->id) }}"
                                                  onsubmit="return confirm('Are you sure you want to approve this appeal and activate the user?')">
                                                @csrf
                                                <button type="submit" class="action-btn btn-approve">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    Approve
                                                </button>
                                            </form>
                                            
                                            <form method="POST" action="{{ route('admin.appeals.reject', $appeal->id) }}"
                                                  onsubmit="return confirm('Are you sure you want to reject this appeal?')">
                                                @csrf
                                                <button type="submit" class="action-btn btn-reject">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                    Reject
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                    
                                    
                                </div>
                            </div>
                            
                            <!-- Decision Info (if not pending) -->
                            @if($appeal->status !== 'pending')
                                <div class="mt-4 pt-4 border-t border-gray-100">
                                    <div class="flex items-center gap-2 text-sm">
                                        <span class="font-medium text-gray-700">Decision:</span>
                                        <span class="text-gray-600">
                                            Appeal was {{ $appeal->status }} 
                                            @if($appeal->updated_at)
                                                on {{ $appeal->updated_at->format('M d, Y') }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="empty-state">
                        <div class="empty-icon">⚖️</div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">No Appeals Found</h3>
                        <p class="text-gray-600 max-w-md mx-auto">
                            There are currently no suspension appeals to review. 
                            Users will appear here when they submit appeals.
                        </p>
                    </div>
                @endif
            </div>
            
            @if($appeals->hasPages())
                <div class="mt-6">
                    {{ $appeals->links() }}
                </div>
            @endif
        </div>
    </div>

    <script>
        function filterAppeals(status) {
            const appeals = document.querySelectorAll('.appeal-card');
            appeals.forEach(appeal => {
                if (status === 'all' || appeal.dataset.status === status) {
                    appeal.style.display = '';
                } else {
                    appeal.style.display = 'none';
                }
            });
            
            // Update active tab
            document.querySelectorAll('[onclick^="filterAppeals"]').forEach(btn => {
                if (btn.textContent.trim().toLowerCase().includes(status) || (status === 'all' && btn.textContent.includes('All'))) {
                    btn.classList.add('bg-white', 'shadow-sm');
                    btn.classList.remove('hover:bg-gray-50');
                } else {
                    btn.classList.remove('bg-white', 'shadow-sm');
                    btn.classList.add('hover:bg-gray-50');
                }
            });
        }
    </script>
</x-app-layout>