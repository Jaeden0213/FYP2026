<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-white p-4 md:p-6">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Admin Dashboard</h1>
            <p class="text-gray-600 mt-2">Manage your application's users, growth, rewards, and logs</p>
        </div>

        <!-- Dashboard Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- User Data Card -->
            <a href="{{ route('admin.users') }}" 
               class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-blue-200">
                <!-- Gradient Top Border -->
                <div class="h-1 bg-gradient-to-r from-blue-500 to-cyan-400"></div>
                
                <div class="p-6 flex flex-col items-center text-center">
                    <!-- Icon Container -->
                    <div class="mb-4 p-4 bg-blue-50 rounded-2xl group-hover:scale-110 transition-transform duration-300">
                        <span class="text-4xl">🗂️</span>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-2">User Data</h3>
                    <p class="text-gray-600 text-sm mb-4">Manage and view all registered accounts</p>
                    
                    <!-- Stats Badge -->
                    <div class="inline-flex items-center px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-sm font-medium">
                        <span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
                        {{-- You can add dynamic count here --}}
                        Active Users
                    </div>
                </div>
                
                <!-- Hover Indicator -->
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-500 to-cyan-400 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
            </a>

            <!-- User Growth Card -->
            <a href="{{ route('admin.growth') }}" 
               class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-green-200">
                <div class="h-1 bg-gradient-to-r from-green-500 to-emerald-400"></div>
                
                <div class="p-6 flex flex-col items-center text-center">
                    <div class="mb-4 p-4 bg-green-50 rounded-2xl group-hover:scale-110 transition-transform duration-300">
                        <span class="text-4xl">📈</span>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-2">User Growth</h3>
                    <p class="text-gray-600 text-sm mb-4">Analyze registration trends and metrics</p>
                    
                    <div class="inline-flex items-center px-3 py-1 rounded-full bg-green-50 text-green-700 text-sm font-medium">
                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                        Analytics
                    </div>
                </div>
                
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-green-500 to-emerald-400 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
            </a>

            <!-- Rewards Management Card -->
            <a href="{{ route('admin.rewards.index') }}"
            class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-yellow-200">
                <div class="h-1 bg-gradient-to-r from-yellow-500 to-amber-400"></div>
                
                <div class="p-6 flex flex-col items-center text-center">
                    <div class="mb-4 p-4 bg-yellow-50 rounded-2xl group-hover:scale-110 transition-transform duration-300">
                        <span class="text-4xl">🏆</span>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Rewards</h3>
                    <p class="text-gray-600 text-sm mb-4">Create and manage user rewards system</p>
                    
                    <div class="inline-flex items-center px-3 py-1 rounded-full bg-yellow-50 text-yellow-700 text-sm font-medium">
                        <span class="w-2 h-2 bg-yellow-500 rounded-full mr-2"></span>
                        Manage Prizes
                    </div>
                </div>
                
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-yellow-500 to-amber-400 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
            </a>

            <!-- App Logs Card -->
            <a href="{{ route('admin.users') }}" 
               class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-purple-200">
                <div class="h-1 bg-gradient-to-r from-purple-500 to-pink-400"></div>
                
                <div class="p-6 flex flex-col items-center text-center">
                    <div class="mb-4 p-4 bg-purple-50 rounded-2xl group-hover:scale-110 transition-transform duration-300">
                        <span class="text-4xl">📋</span>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-2">App Logs</h3>
                    <p class="text-gray-600 text-sm mb-4">Monitor application activity and errors</p>
                    
                    <div class="inline-flex items-center px-3 py-1 rounded-full bg-purple-50 text-purple-700 text-sm font-medium">
                        <span class="w-2 h-2 bg-purple-500 rounded-full mr-2"></span>
                        System Activity
                    </div>
                </div>
                
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-purple-500 to-pink-400 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
            </a>

            <!-- App Logs Card -->
            <a href="{{ route('admin.appeals') }}" 
               class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-purple-200">
                <div class="h-1 bg-gradient-to-r from-purple-500 to-pink-400"></div>
                
                <div class="p-6 flex flex-col items-center text-center">
                    <div class="mb-4 p-4 bg-purple-50 rounded-2xl group-hover:scale-110 transition-transform duration-300">
                        <span class="text-4xl">⚖️</span>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Users appeals</h3>
                    <p class="text-gray-600 text-sm mb-4">Approve or Deny appeal request</p>
                    
                    <div class="inline-flex items-center px-3 py-1 rounded-full bg-purple-50 text-purple-700 text-sm font-medium">
                        <span class="w-2 h-2 bg-purple-500 rounded-full mr-2"></span>
                        Activate suspended users
                    </div>
                </div>
                
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-purple-500 to-pink-400 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300"></div>
            </a>
        </div>

        
        <!-- Recent Activity -->
        <div class="mt-8 bg-white rounded-2xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900">Recent Activity</h2>
                <button class="text-sm text-blue-600 hover:text-blue-800 font-medium">View All →</button>
            </div>
            
            <div class="space-y-4">
                <div class="flex items-center p-3 hover:bg-gray-50 rounded-lg">
                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                        <span class="text-sm">👤</span>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">New user registered</p>
                        <p class="text-xs text-gray-500">john.doe@example.com • 2 minutes ago</p>
                    </div>
                    <span class="text-xs px-2 py-1 bg-green-100 text-green-800 rounded-full">User</span>
                </div>
                
                <div class="flex items-center p-3 hover:bg-gray-50 rounded-lg">
                    <div class="w-8 h-8 rounded-full bg-yellow-100 flex items-center justify-center mr-3">
                        <span class="text-sm">🏆</span>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">Reward claimed by user</p>
                        <p class="text-xs text-gray-500">Premium Subscription • 15 minutes ago</p>
                    </div>
                    <span class="text-xs px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full">Reward</span>
                </div>
                
                <div class="flex items-center p-3 hover:bg-gray-50 rounded-lg">
                    <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                        <span class="text-sm">📋</span>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium text-gray-900">Error logged in API</p>
                        <p class="text-xs text-gray-500">Payment gateway timeout • 1 hour ago</p>
                    </div>
                    <span class="text-xs px-2 py-1 bg-red-100 text-red-800 rounded-full">Error</span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>