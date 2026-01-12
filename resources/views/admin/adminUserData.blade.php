<x-app-layout>
    <div class="flex justify-center py-10">
        <div class="w-full max-w-6xl px-4">
            <h1 class="text-3xl font-bold mb-6 text-gray-800 text-center">User Data</h1>

            <div class="overflow-x-auto">
                <table class="min-w-full w-full bg-white border border-gray-300 shadow-md rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-6 text-center text-sm font-medium text-gray-600 uppercase border border-gray-300">ID</th>
                            <th class="py-3 px-6 text-left text-sm font-medium text-gray-600 uppercase border border-gray-300">Name</th>
                            <th class="py-3 px-6 text-left text-sm font-medium text-gray-600 uppercase border border-gray-300">Email</th>
                            <th class="py-3 px-6 text-center text-sm font-medium text-gray-600 uppercase border border-gray-300">Status</th>
                            <th class="py-3 px-6 text-center text-sm font-medium text-gray-600 uppercase border border-gray-300">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-3 px-6 text-center text-sm text-gray-700 border border-gray-300">{{ $user->id }}</td>
                                <td class="py-3 px-6 text-left text-sm text-gray-700 border border-gray-300">{{ $user->name }}</td>
                                <td class="py-3 px-6 text-left text-sm text-gray-700 border border-gray-300">{{ $user->email }}</td>
                                <td class="py-3 px-6 text-center text-sm border border-gray-300">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold 
                                        {{ $user->status === 'inactive' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                                        {{ $user->status ?? 'active' }}
                                    </span>
                                </td>
                                <td class="py-3 px-6 text-center text-sm text-gray-500 border border-gray-300">{{ $user->created_at->format('Y-m-d') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
