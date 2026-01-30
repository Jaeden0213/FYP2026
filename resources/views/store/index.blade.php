<x-layouts.game-side-bar title="Voucher Store">
    <style>
       button {
        padding: 10px 20px;
        border-radius: 8px;
        border: none;
        background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
        white-space: nowrap;
    }

    button:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(16, 185, 129, 0.3);
    }
    </style>


    <p style="margin-bottom:16px;">
        Your Points: <strong>{{ auth()->user()->totalPoints() }}</strong>
    </p>

    <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(260px, 1fr)); gap:16px;">
        @forelse($items as $item)
            <div style="background:#fff; border:1px solid #e5e7eb; border-radius:12px; padding:16px;">
                @if($item->image_path)
                    <img src="{{ asset('storage/' . $item->image_path) }}"
                         alt="{{ $item->name }}"
                         style="width:100%; height:140px; object-fit:cover; border-radius:10px; margin-bottom:12px;">
                @else
                    <div style="width:100%; height:140px; background:#f3f4f6; border-radius:10px;
                                display:flex; align-items:center; justify-content:center;
                                color:#9ca3af; margin-bottom:12px;">
                        No Image
                    </div>
                @endif

                <h3 style="font-weight:700;">{{ $item->name }}</h3>
                <p style="color:#6b7280;">{{ $item->brand }}</p>
                <p style="margin:10px 0;">⭐ <strong>{{ $item->points_cost }}</strong> pts</p>

                <form method="POST" action="{{ route('store.redeem', $item->id) }}">
                    @csrf
                    <button 
                            @disabled(auth()->user()->totalPoints() < $item->points_cost)>
                        Redeem
                    </button>
                </form>
            </div>
        @empty
            <p>No vouchers available.</p>
        @endforelse
    </div>
</x-layouts.game-side-bar>
