<x-app-layout>
    <div class="flex flex-col h-screen w-full">
        
        <div class="px-8 py-6">
            <h1 class="text-3xl font-bold text-black">Admin Dashboard</h1>
        </div>

        <div class=" flex flex-1 w-full p-6 gap-6">
            
            <a href="{{ route('admin.users') }}" 
               class=" flex-1 bg-white rounded-2xl shadow-sm hover:shadow-2xl transition-all flex flex-col items-center justify-center border-2 border-gray-100 group">
                <span class="text-8xl group-hover:scale-110 transition-transform">👥</span>
                <span class="font-bold text-3xl text-black mt-6">User Data</span>
                <p class="text-gray-500 mt-2">Manage and view all registered accounts</p>
            </a>

            <a href="{{ route('admin.growth') }}" 
               class="flex-1 bg-white rounded-2xl shadow-sm hover:shadow-2xl transition-all flex flex-col items-center justify-center border-2 border-gray-100 group">
                <span class="text-8xl group-hover:scale-110 transition-transform">📈</span>
                <span class="font-bold text-3xl text-black mt-6">User Growth</span>
                <p class="text-gray-500 mt-2">Analyze registration trends and metrics</p>
            </a>
            
        </div>
    </div>
</x-app-layout>