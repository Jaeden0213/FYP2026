<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">

            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Manage Achievements</h1>

                <a href="{{ route('admin.achievements.create') }}"
                   style="background:#16a34a;color:white;padding:8px 16px;border-radius:6px;display:inline-flex;align-items:center;"
                   onmouseover="this.style.background='#15803d'"
                   onmouseout="this.style.background='#16a34a'">
                    + Add Achievement
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
                            <th class="p-3 text-left">Code</th>
                            <th class="p-3 text-left">Name</th>
                            <th class="p-3 text-left">Category</th>
                            <th class="p-3 text-left">Tier</th>
                            <th class="p-3 text-left">Status</th>
                            <th class="p-3 text-left">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($achievements as $achievement)
                            <tr class="border-t">
                                <td class="p-3">{{ $achievement->code }}</td>

                                <td class="p-3">
                                    <div class="font-medium text-gray-900">{{ $achievement->name }}</div>
                                    @if($achievement->description)
                                        <div class="text-sm text-gray-500 mt-1">
                                            {{ $achievement->description }}
                                        </div>
                                    @endif
                                </td>

                                <td class="p-3">{{ $achievement->category }}</td>

                                <td class="p-3">
                                    @forelse($achievement->tiers->sortBy('tier_order') as $tier)
                                        <div class="mb-2 last:mb-0 text-sm">
                                            <div class="font-medium capitalize
                                                @if($tier->tier === 'bronze') text-amber-700
                                                @elseif($tier->tier === 'silver') text-gray-700
                                                @elseif($tier->tier === 'gold') text-yellow-700
                                                @endif">
                                                {{ $tier->tier }}
                                            </div>
                                            <div class="text-gray-500">
                                                {{ $tier->target_value }} target • {{ $tier->reward_points }} pts
                                            </div>
                                            @if($tier->reward_title)
                                                <div class="text-xs text-indigo-600 mt-1">
                                                    {{ $tier->reward_title }}
                                                </div>
                                            @endif
                                        </div>
                                    @empty
                                        <span class="text-gray-400 text-sm">-</span>
                                    @endforelse
                                </td>

                                <td class="p-3">
                                    @if($achievement->is_active)
                                        <span class="text-green-600 font-medium">Active</span>
                                    @else
                                        <span class="text-red-600 font-medium">Inactive</span>
                                    @endif
                                </td>

                                <td class="p-3">
                                    <div class="flex gap-2 flex-wrap">
                                        <a href="{{ route('admin.achievements.edit', $achievement->id) }}"
                                           class="px-3 py-1 rounded bg-blue-100 text-blue-700 hover:bg-blue-200 text-sm">
                                            Edit
                                        </a>

                                        <form method="POST" action="{{ route('admin.achievements.toggle', $achievement->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="px-3 py-1 rounded bg-gray-100 text-gray-700 hover:bg-gray-200 text-sm">
                                                {{ $achievement->is_active ? 'Disable' : 'Activate' }}
                                            </button>
                                        </form>

                                        <form method="POST" action="{{ route('admin.achievements.destroy', $achievement->id) }}"
                                              onsubmit="return confirm('Delete this achievement?')">
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
                                    No achievements added yet.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>