<x-layouts.game-side-bar title="Inventory">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
        }

        .inventory-layout {
            min-height: calc(100vh - 72px);
            display: flex;
            flex-direction: column;
            background: linear-gradient(135deg, #f9fafb 0%, #f0f4f8 100%);
        }

        .inventory-scroll-area {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 28px;
        }

        .page-header-strip {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            padding: 18px 28px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
            flex-shrink: 0;
        }

        .page-header-strip h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .inventory-scroll-area {
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 28px;
        }

        .inventory-page {
            max-width: 1200px;
            margin: 0 auto;
        }

        .inventory-subtitle {
            margin-bottom: 28px;
            font-size: 0.98rem;
            color: #6b7280;
        }

        .inventory-alert {
            margin-bottom: 16px;
            padding: 16px;
            border-radius: 12px;
            font-weight: 500;
        }

        .inventory-alert.success {
            background: #dcfce7;
            color: #15803d;
        }

        .inventory-alert.error {
            background: #fee2e2;
            color: #b91c1c;
        }

        .inventory-section {
            margin-bottom: 40px;
        }

        .inventory-section-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #111827;
            margin-bottom: 16px;
        }

        .inventory-grid {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 16px;
        }

        @media (min-width: 640px) {
            .inventory-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (min-width: 1024px) {
            .inventory-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
        }

        .inventory-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            padding: 16px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
            transition: 0.2s ease;
        }

        .inventory-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
        }

        .inventory-image {
            width: 100%;
            max-height: 170px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 12px;
            border: 1px solid #e5e7eb;
            background: #f9fafb;
        }

        .inventory-card-title {
            font-size: 1rem;
            font-weight: 700;
            color: #111827;
            margin: 0 0 4px 0;
        }

        .inventory-card-subtitle {
            font-size: 0.92rem;
            color: #6b7280;
            margin-bottom: 10px;
        }

        .inventory-meta {
            font-size: 0.95rem;
            color: #374151;
            margin-top: 6px;
        }

        .inventory-meta strong {
            color: #111827;
        }

        .inventory-points {
            font-weight: 700;
            color: #111827;
        }

        .inventory-title-reward {
            color: #6d28d9;
            font-weight: 600;
            margin-top: 8px;
        }

        .inventory-time {
            font-size: 0.78rem;
            color: #9ca3af;
            margin-top: 12px;
        }

        .inventory-actions {
            margin-top: 14px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .inventory-badge {
            display: inline-block;
            background: #dcfce7;
            color: #15803d;
            padding: 8px 14px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 700;
        }

        .inventory-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 9px 14px;
            border-radius: 10px;
            border: none;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .inventory-btn.primary {
            background: #7c3aed;
            color: white;
        }

        .inventory-btn.primary:hover {
            background: #6d28d9;
        }

        .inventory-btn.secondary {
            background: #f3f4f6;
            color: #374151;
        }

        .inventory-btn.secondary:hover {
            background: #e5e7eb;
        }

        .tier-bronze {
            color: #b45309;
            font-weight: 700;
        }

        .tier-silver {
            color: #4b5563;
            font-weight: 700;
        }

        .tier-gold {
            color: #a16207;
            font-weight: 700;
        }

        .inventory-empty {
            background: white;
            border: 1px dashed #d1d5db;
            border-radius: 16px;
            padding: 24px;
            color: #6b7280;
        }
    </style>

        <div class="inventory-scroll-area">
            <div class="inventory-page">
                <p class="inventory-subtitle">
                    View your collected rewards and unlocked achievement titles.
                </p>

                @if(session('success'))
                    <div class="inventory-alert success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="inventory-alert error">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- My Rewards --}}
                <div class="inventory-section">
                    <h2 class="inventory-section-title">My Rewards</h2>

                    @forelse($redemptions as $r)
                        @if($loop->first)
                            <div class="inventory-grid">
                        @endif

                        <div class="inventory-card">
                            @if($r->storeItem && $r->storeItem->image_path)
                                <img
                                    src="{{ asset('storage/' . $r->storeItem->image_path) }}"
                                    alt="{{ $r->storeItem->name }}"
                                    class="inventory-image"
                                >
                            @endif

                            <h3 class="inventory-card-title">{{ $r->storeItem->name ?? 'Reward Item' }}</h3>
                            <div class="inventory-card-subtitle">{{ $r->storeItem->brand ?? '-' }}</div>

                            <div class="inventory-meta">
                                Spent: <span class="inventory-points">⭐ {{ $r->points_spent }} pts</span>
                            </div>

                            <div class="inventory-meta">
                                Status: <strong>{{ $r->status ?? 'Owned' }}</strong>
                               @if(($r->status ?? 'owned') === 'owned')
                                    <button
                                        class="use-voucher-btn"
                                        data-id="{{ $r->id }}"
                                        style="margin-top:10px;background:#7c3aed;color:white;padding:8px 14px;border:none;border-radius:8px;font-weight:600;cursor:pointer;">
                                        Use Voucher
                                    </button>
                                @else
                                    <span style="display:inline-block;margin-top:10px;color:#16a34a;font-weight:600;">
                                        Voucher Used
                                    </span>
                                @endif
                            </div>

                            <div class="inventory-time">
                                Redeemed: {{ $r->created_at->format('d M Y, h:i A') }}
                            </div>
                        </div>

                        @if($loop->last)
                            </div>
                        @endif
                    @empty
                        <div class="inventory-empty">
                            You don’t have any rewards yet.
                        </div>
                    @endforelse
                </div>

                {{-- My Achievements --}}
                <div class="inventory-section">
                    <h2 class="inventory-section-title">My Achievements</h2>

                    @forelse($myAchievements as $ua)
                        @if($loop->first)
                            <div class="inventory-grid">
                        @endif

                        <div class="inventory-card">
                            <h3 class="inventory-card-title">
                                {{ $ua->tier->achievement->name ?? 'Achievement' }}
                            </h3>

                            <div class="inventory-meta">
                                Tier:
                                <span class="
                                    @if(($ua->tier->tier ?? '') === 'bronze') tier-bronze
                                    @elseif(($ua->tier->tier ?? '') === 'silver') tier-silver
                                    @elseif(($ua->tier->tier ?? '') === 'gold') tier-gold
                                    @endif
                                ">
                                    {{ ucfirst($ua->tier->tier ?? '-') }}
                                </span>
                            </div>

                            <div class="inventory-meta">
                                Reward: <span class="inventory-points">⭐ {{ $ua->tier->reward_points ?? 0 }} pts</span>
                            </div>

                            <div class="inventory-title-reward">
                                Title: {{ $ua->tier->reward_title ?? 'No title reward' }}
                            </div>

                            <div class="inventory-actions">
                                @if(!empty($ua->tier->reward_title))
                                    @if(auth()->user()->equipped_user_achievement_tier_id === $ua->id)
                                        <span class="inventory-badge">Equipped</span>

                                        <form action="{{ route('achievements.unequipTitle') }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            <button type="submit" class="inventory-btn secondary">
                                                Unequip
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('achievements.equipTitle', $ua->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            <button type="submit" class="inventory-btn primary">
                                                Equip Title
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            </div>

                            <div class="inventory-time">
                                Claimed:
                                {{ optional($ua->claimed_at)->format('d M Y, h:i A') ?? 'Not claimed yet' }}
                            </div>
                        </div>

                        @if($loop->last)
                            </div>
                        @endif
                    @empty
                        <div class="inventory-empty">
                            You don’t have any achievements yet.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.use-voucher-btn').forEach(button => {
        button.addEventListener('click', async function () {
            const rewardId = this.dataset.id;

            this.disabled = true;
            this.textContent = 'Sending...';

            try {
                const response = await fetch(`/inventory/use-voucher/${rewardId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (response.ok) {
                    this.outerHTML = `<span style="display:inline-block;margin-top:10px;color:#16a34a;font-weight:600;">Voucher Used</span>`;
                    alert(data.message);
                } else {
                    this.disabled = false;
                    this.textContent = 'Use Voucher';
                    alert(data.message || 'Something went wrong.');
                }
            } catch (error) {
                this.disabled = false;
                this.textContent = 'Use Voucher';
                alert('Failed to send voucher email.');
            }
        });
    });
});
</script>
</x-layouts.game-side-bar>