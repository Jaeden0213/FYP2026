<x-app-layout>
    <div class="main-content">
        <h2 style="font-size:20px; font-weight:700;">Voucher Store</h2>

        <p style="margin-bottom:16px;">
            Your Points: <strong>{{ auth()->user()->totalPoints() }}</strong>
        </p>

        <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(260px, 1fr)); gap:16px;">
            @forelse($items as $item)
                <div style="background:#fff; border:1px solid #e5e7eb; border-radius:12px; padding:16px;">
                    <h3 style="font-weight:700;">{{ $item->name }}</h3>
                    <p style="color:#6b7280;">{{ $item->brand }}</p>
                    <p style="margin:10px 0;">⭐ <strong>{{ $item->points_cost }}</strong> pts</p>

                    <form method="POST" action="{{ route('store.redeem', $item->id) }}">
                        @csrf
                        <button
                            style="padding:10px 14px; border-radius:10px; border:1px solid #e5e7eb; background:#111827; color:white; cursor:pointer;"
                            @disabled(auth()->user()->totalPoints() < $item->points_cost)
                        >
                            Redeem
                        </button>
                    </form>
                </div>
            @empty
                <p>No vouchers available.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
