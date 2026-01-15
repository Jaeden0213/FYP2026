<x-app-layout>
    <div class="main-content">
        <h2 style="font-size:20px; font-weight:700;">My Vouchers</h2>

        <div style="margin-top:16px; display:grid; grid-template-columns:repeat(auto-fill, minmax(260px, 1fr)); gap:16px;">
            @forelse($redemptions as $r)
                <div style="background:#fff; border:1px solid #e5e7eb; border-radius:12px; padding:16px;">
                    <h3 style="font-weight:700;">{{ $r->storeItem->name }}</h3>
                    <p style="color:#6b7280;">{{ $r->storeItem->brand }}</p>
                    <p style="margin-top:8px;">Spent: ⭐ {{ $r->points_spent }} pts</p>
                    <p>Status: <strong>{{ $r->status ?? 'owned' }}</strong></p>
                    <p style="color:#9ca3af; font-size:12px; margin-top:6px;">
                        Redeemed: {{ $r->created_at->format('d M Y, h:i A') }}
                    </p>
                </div>
            @empty
                <p>You don’t have any vouchers yet.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
