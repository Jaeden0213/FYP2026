{{-- resources/views/store/my-vouchers.blade.php (example) --}}
<x-app-layout>
    <div class="py-6 px-6">
        <div class="max-w-6xl mx-auto">

            <h2 class="text-xl font-bold mb-4">My Vouchers</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse($redemptions as $r)
                    <div class="bg-white border border-gray-200 rounded-xl p-4">
                        @if($r->storeItem->image_path)
                            <img
                                src="{{ asset('storage/' . $r->storeItem->image_path) }}"
                                alt="{{ $r->storeItem->name }}"
                                class="w-full max-h-40 object-cover rounded-lg mb-3 border"
                            >
                        @endif

                        <h3 class="font-bold">{{ $r->storeItem->name }}</h3>
                        <p class="text-gray-500">{{ $r->storeItem->brand }}</p>

                        <p class="mt-2">Spent: ⭐ {{ $r->points_spent }} pts</p>
                        <p>Status: <strong>{{ $r->status ?? 'Owned' }}</strong></p>

                        <p class="text-gray-400 text-xs mt-2">
                            Redeemed: {{ $r->created_at->format('d M Y, h:i A') }}
                        </p>
                    </div>
                @empty
                    <p>You don’t have any vouchers yet.</p>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
