<x-app-layout>
    <style>
        .page-title { text-align: center; font-size: 2rem; margin-bottom: 30px; }
        .cards { display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; margin-bottom: 50px; }
        .card { flex: 1 1 200px; max-width: 250px; text-align: center; padding: 30px 20px; background: #fff; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); transition: transform 0.2s, box-shadow 0.2s; }
        .card:hover { transform: translateY(-5px); box-shadow: 0 8px 20px rgba(0,0,0,0.15); }
        .card h2 { margin-bottom: 15px; color: #555; font-size: 1.2rem; }
        .card p { font-size: 2rem; font-weight: bold; color: #007BFF; }
    </style>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-white py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="page-title">User Growth Statistics</h1>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-sm text-gray-500">Total Users:</span>
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-medium">
                        {{$totalStudents}}
                        </span>
                    </div>
                </div>

                 <!-- Summary Cards -->
        <div class="cards">
            <div class="card">
                <h2>Active Students</h2>
                <p>{{ $users->where('status', 'active')->count() }}</p>
            </div>
           <div class="card">
                <h2>Suspended Students</h2>
                <p>{{ $users->where('status', 'suspended')->count() }}</p>
            </div>
            <div class="card">
                <h2>Total Admins</h2>
                <p> {{ $users->where('role', 'admin')->count() }}</p>
            </div>
            
        </div>

                
            </div>

            <!-- User Table -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    User
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Role
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Joined
                                </th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($users as $user)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <!-- User Info -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                           
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                                <div class="text-sm text-gray-500">ID: {{ $user->id }}</div>
                                            </div>
                                        </div>
                                    </td>

                                    <!-- Email -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $user->email }}</div>
                                    </td>

                                    <!-- Status -->
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($user->status === 'suspended')
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>
                                                Suspended
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                                Active
                                            </span>
                                        @endif
                                    </td>

                                    <!-- Role -->
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex items-center">
                                            @if($user->role === 'admin')
                                                <span class="px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800 flex items-center">
                                                    👑 Admin
                                                </span>
                                            @else
                                                <span class="px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                    👤 User
                                                </span>
                                            @endif
                                        </div>
                                    </td>

                                    <!-- Created At -->
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $user->created_at->format('M d, Y') }}
                                        <div class="text-xs text-gray-400">
                                            {{ $user->created_at->diffForHumans() }}
                                        </div>
                                    </td>

                                    <!-- Actions -->
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-2">
                                            <!-- Don't show action buttons for current admin user -->
                                            @if(auth()->id() !== $user->id)
                                                <!-- Suspend/Activate Button -->
                                                @if($user->status === 'active')
                                                    <form method="POST" action="{{ route('admin.suspendUser', $user->id) }}" 
                                                          class="inline" 
                                                          onsubmit="return confirm('Are you sure you want to suspend this user?')">
                                                        @csrf
                                                        <button type="submit" 
                                                                class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-yellow-700 bg-yellow-100 hover:bg-yellow-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors">
                                                            ⚠️ Suspend
                                                        </button>
                                                    </form>
                                                @else
                                                    <form method="POST" action="{{ route('admin.activateUser', $user->id) }}" 
                                                          class="inline" 
                                                          onsubmit="return confirm('Are you sure you want to activate this user?')">
                                                        @csrf
                                                        <button type="submit" 
                                                                class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                                            ✅ Activate
                                                        </button>
                                                    </form>
                                                @endif

                                                <!-- Promote Button - Only show for non-admin users -->
                                                @if($user->role !== 'admin')
                                                    <form method="POST" action="{{ route('admin.promoteUser', $user->id) }}" 
                                                          class="inline" 
                                                          onsubmit="return confirm('Are you sure you want to promote this user to admin?')">
                                                        @csrf
                                                        <button type="submit" 
                                                                class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-purple-700 bg-purple-100 hover:bg-purple-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors">
                                                            👑 Promote
                                                        </button>
                                                    </form>
                                                @endif

                                                <!-- Delete Button -->
                                                <form method="POST" action="{{ route('admin.deleteUser', $user->id) }}" 
                                                      class="inline" 
                                                      onsubmit="return confirm('Are you sure you want to permanently delete this user? This action cannot be undone.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                                        🗑️ Delete
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-xs text-gray-400 italic">Current User</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

              
            </div>

            <!-- Legend -->
            <div class="mt-6 flex flex-wrap items-center justify-center gap-4 text-sm text-gray-600">
                <div class="flex items-center">
                    <div class="w-3 h-3 rounded-full bg-green-500 mr-2"></div>
                    <span>Active User</span>
                </div>
                <div class="flex items-center">
                    <div class="w-3 h-3 rounded-full bg-red-500 mr-2"></div>
                    <span>Suspended User</span>
                </div>
                <div class="flex items-center">
                    <div class="w-3 h-3 rounded-full bg-purple-500 mr-2"></div>
                    <span>Admin User</span>
                </div>
                <div class="flex items-center">
                    <div class="text-xs text-gray-400 mr-2">⚠️</div>
                    <span>Action requires confirmation</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal Script -->
    <script>
        // Optional: Add sweetalert for better confirmation dialogs
        document.addEventListener('DOMContentLoaded', function() {
            // You can enhance with sweetalert2 if desired
            // https://sweetalert2.github.io/
        });
    </script>
</x-app-layout>