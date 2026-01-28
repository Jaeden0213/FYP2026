<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">

            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Manage Rewards</h1>
                
                <a href="{{ route('admin.rewards.create') }}"
                style="background:#16a34a;color:white;padding:8px 16px;border-radius:6px;display:inline-flex;align-items:center;"
                onmouseover="this.style.background='#15803d'"
                onmouseout="this.style.background='#16a34a'">
                    + Add Reward
                </a>
            </div>

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 text-left">Image</th>
                            <th class="p-3 text-left">Name</th>
                            <th class="p-3 text-left">Brand</th>
                            <th class="p-3 text-left">Points</th>
                            <th class="p-3 text-left">Stock</th>
                            <th class="p-3 text-left">Status</th>
                            <th class="p-3 text-left">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($items as $item)
                            <tr class="border-t">
                                <td class="p-3">
                                    @if($item->image_path)
                                        <img src="{{ asset('storage/' . $item->image_path) }}"
                                            class="w-12 h-12 object-cover rounded border">
                                    @else
                                        <span class="text-gray-400 text-sm">No image</span>
                                    @endif
                                </td>
                                <td class="p-3">{{ $item->name }}</td>
                                <td class="p-3">{{ $item->brand }}</td>
                                <td class="p-3">{{ $item->points_cost }}</td>
                                <td class="p-3">
                                    {{ $item->stock === null ? 'Unlimited' : $item->stock }}
                                </td>

                                <td class="p-3">
                                    @if($item->is_active)
                                        <span class="text-green-600 font-medium">Active</span>
                                    @else
                                        <span class="text-red-600 font-medium">Inactive</span>
                                    @endif
                                </td>

                                <td class="p-3">
                                    <div class="flex gap-2 flex-wrap">

                                        <a href="{{ route('admin.rewards.edit', $item->id) }}"
                                           class="px-3 py-1 rounded bg-blue-100 text-blue-700 hover:bg-blue-200 text-sm">
                                            Edit
                                        </a>

                                        <form method="POST" action="{{ route('admin.rewards.toggle', $item->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="px-3 py-1 rounded bg-gray-100 text-gray-700 hover:bg-gray-200 text-sm">
                                                {{ $item->is_active ? 'Disable' : 'Activate' }}
                                            </button>
                                        </form>

                                        @if($item->stock !== null)
                                            <form method="POST" action="{{ route('admin.rewards.stock.dec', $item->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="px-3 py-1 rounded bg-yellow-100 text-yellow-700 hover:bg-yellow-200 text-sm">
                                                    -
                                                </button>
                                            </form>

                                            <form method="POST" action="{{ route('admin.rewards.stock.inc', $item->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="px-3 py-1 rounded bg-yellow-100 text-yellow-700 hover:bg-yellow-200 text-sm">
                                                    +
                                                </button>
                                            </form>
                                        @endif

                                        <form method="POST" action="{{ route('admin.rewards.destroy', $item->id) }}"
                                              onsubmit="return confirm('Delete this reward?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1 rounded bg-red-100 text-red-700 hover:bg-red-200 text-sm">
                                                Delete
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-4 text-center text-gray-500">
                                    No rewards added yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
