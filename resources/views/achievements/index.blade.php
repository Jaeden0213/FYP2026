<x-layouts.game-side-bar>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Achievements
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Available Achievements</h3>

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                @if($achievements->isEmpty())
                    <p class="text-gray-500">No achievements available yet.</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($achievements as $achievement)
                            <div class="border rounded-xl p-5 shadow-sm bg-white">
                                <h4 class="text-lg font-semibold mb-2">{{ $achievement->name }}</h4>

                                @if($achievement->description)
                                    <p class="text-sm text-gray-600 mb-3">
                                        {{ $achievement->description }}
                                    </p>
                                @endif

                                <div class="space-y-3">
                                    @foreach($achievement->tiers->sortBy('tier_order') as $tier)
                                        @php
                                            $userTier = $userAchievements[$tier->id] ?? null;
                                        @endphp

                                        <div class="border rounded-lg px-3 py-3">
                                            <div class="flex items-center justify-between mb-2">
                                                <div>
                                                    <span class="font-medium capitalize
                                                        @if($tier->tier === 'bronze') text-amber-700
                                                        @elseif($tier->tier === 'silver') text-gray-700
                                                        @elseif($tier->tier === 'gold') text-yellow-700
                                                        @endif">
                                                        {{ $tier->tier }}
                                                    </span>

                                                    <span class="text-sm text-gray-500">
                                                        - Target: {{ $tier->target_value }}
                                                    </span>
                                                </div>

                                                <div class="text-sm text-gray-600">
                                                    {{ $tier->reward_points }} pts
                                                </div>
                                            </div>

                                            @if($tier->reward_title)
                                                <p class="text-xs text-indigo-600 mb-2">
                                                    Reward Title: {{ $tier->reward_title }}
                                                </p>
                                            @endif

                                            <div class="flex justify-end">
                                            @if(!$userTier)
                                                <span style="padding:6px 12px; border-radius:999px; background:#f3f4f6; color:#6b7280; font-size:14px;">
                                                    Locked
                                                </span>
                                            @elseif($userTier->is_claimed)
                                                <span style="padding:6px 12px; border-radius:999px; background:#dcfce7; color:#15803d; font-size:14px; font-weight:600;">
                                                    Claimed
                                                </span>
                                            @else
                                                <form method="POST" action="{{ route('achievements.claim', $userTier->id) }}">
                                                    @csrf
                                                    <button type="submit"
                                                        style="padding:6px 12px; border-radius:8px; background:#4f46e5; color:white; font-size:14px; border:none; cursor:pointer;">
                                                        Claim
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.game-side-bar>