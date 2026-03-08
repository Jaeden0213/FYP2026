<?php


namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\UserAchievementTier;
use App\Services\AchievementService;
use Illuminate\Support\Facades\Auth;

class AchievementController extends Controller
{
    public function index(AchievementService $service)
    {
        $service->checkAndUnlock(auth()->id());

        $achievements = Achievement::with('tiers')
            ->where('is_active', true)
            ->get();

        $userAchievements = UserAchievementTier::where('user_id', auth()->id())
            ->get()
            ->keyBy('achievement_tier_id');

        return view('achievements.index', compact('achievements', 'userAchievements'));
    }

    public function claim(UserAchievementTier $userAchievementTier, AchievementService $service)
    {
        $service->claim(auth()->id(), $userAchievementTier->id);

        return back()->with('success', 'Achievement claimed successfully!');
    }
    
   public function equipTitle(UserAchievementTier $userAchievementTier)
    {
        $user = auth()->user();

        $userAchievementTier->load('tier.achievement');

        if ($userAchievementTier->user_id !== $user->id) {
            abort(403);
        }

        if (!$userAchievementTier->is_claimed) {
            return back()->with('error', 'You must claim this achievement first.');
        }

        if (!$userAchievementTier->tier || !$userAchievementTier->tier->reward_title) {
            return back()->with('error', 'This achievement has no title to equip.');
        }

        $user->equipped_title = $userAchievementTier->tier->reward_title;
        $user->equipped_user_achievement_tier_id = $userAchievementTier->id;
        $user->save();

        return back()->with('success', 'Title equipped successfully!');
    }

    public function unequipTitle()
    {
        $user = auth()->user();
        $user->equipped_title = null;
        $user->equipped_user_achievement_tier_id = null;
        $user->save();

        return back()->with('success', 'Title unequipped successfully!');
    }
}